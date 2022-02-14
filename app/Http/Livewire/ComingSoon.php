<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ComingSoon extends Component
{
    public $comingSoon = [];
    public function loadComingSoonGames()
    {
        $current = Carbon::now()->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;
        $comingSoonUnformatted = Cache::remember('coming_soon', 30, function () use ($current, $after) {
            return
                Http::withHeaders(config('services.igdb'))->withBody("
            fields name,slug,cover.url,first_release_date,total_rating_count;
            where platforms = (48,49,130,6)
            &(first_release_date >= {$current} & first_release_date < {$after}) ;
            sort first_release_date asc;
            limit 4;
        ", 'text/plain')->post(env('IGDB_API'))->json();
        });
        $this->comingSoon = $this->formatForView($comingSoonUnformatted);
    }

    private function formatForView(array $games): array
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => isset($game['cover']) ?  Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) : null,
                'release_date' => \Carbon\Carbon::parse($game['first_release_date'])->toDateString(),
            ]);
        })->toArray();
    }

    public function render()
    {
        return view('livewire.coming-soon');
    }
}
