<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PopularGames extends Component
{

    public $popularGames = [];

    public function loadPopularGames()
    {
        $before = Carbon::now()->subYears(18)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;
        $popularGamesUnformatted = Cache::remember('popular_games', 30, function () use ($before, $after) {
            return
                Http::withHeaders(config('services.igdb'))->withBody(
                    "fields name,slug, cover.*,rating ,total_rating_count, platforms.abbreviation, first_release_date;
                    where platforms  = (6,48,130,49)
                    &(first_release_date > {$before} 
                    & first_release_date < {$after})
                    & rating != null;
                  sort total_rating_count desc;
                   limit 12;",
                    'text/plain'
                )->post(env('IGDB_API'))->json();
        });

        $this->popularGames = $this->formatForView($popularGamesUnformatted);

        collect($this->popularGames)->each(function ($game) {
            $this->emit('gameWithRatingAdded', [
                'slug' => $game['slug'],
                'rating' => $game['rating'] / 100,
            ]);
        });
    }
    private function formatForView(array $games): array
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : null,
                'rating' => isset($game['rating']) ? round($game['rating']) : null,
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(',')
            ]);
        })->toArray();
    }
    public function render()
    {
        return view('livewire.popular-games');
    }
}
