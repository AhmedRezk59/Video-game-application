<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MostAnticipated extends Component
{
    public $mostAnticipated = [];

    public function loadMostAnticipatedGames()
    {
        $current = Carbon::now()->timestamp;
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
        $mostAnticipatedUnformatted = Cache::remember('most_anticipated', 30, function () use ($current, $afterFourMonths) {
            return
                Http::withHeaders(config('services.igdb'))->withBody("
            fields name,slug,cover.url,first_release_date,total_rating_count;
            where platforms = (6,48,130,49)
            &(first_release_date >= {$current} & first_release_date < {$afterFourMonths});
            sort total_rating_count desc;
            limit 4;
        ", 'text/plain')->post(env('IGDB_API'))->json();
        });
        $this->mostAnticipated = $this->formatForView($mostAnticipatedUnformatted);
    }
    private function formatForView(array $games): array
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) : null,
                'release_date' => \Carbon\Carbon::parse($game['first_release_date'])->toDateString(),
            ]);
        })->toArray();
    }
    public function render()
    {
        return view('livewire.most-anticipated');
    }
}
