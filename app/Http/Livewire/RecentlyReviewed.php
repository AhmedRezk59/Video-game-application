<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];

    public function loadRecentlyReviwedGames()
    {
        $current = Carbon::now()->timestamp;
        $before = Carbon::now()->subYears(18)->timestamp;
        $recentlyReviewedUnformatted = Cache::remember('recently_reviewed', 30, function () use ($before, $current) {
            return
                Http::withHeaders(config('services.igdb'))->withBody(
                    "fields name,slug,summary, cover.*,rating ,total_rating_count, platforms.abbreviation, first_release_date;
                    where platforms  = (6,48,130,49)
                    &(first_release_date > {$before}
                    & first_release_date < {$current}
                    & rating_count > 5);
                  sort total_rating_count desc;
                   limit 3 ;",
                    'text/plain'
                )->post(env('IGDB_API'))->json();
        });
        $this->recentlyReviewed = $this->formatForView($recentlyReviewedUnformatted);

        collect($this->recentlyReviewed)->each(function ($game) {
            $this->emit('reviewGameWithRatingAdded', [
                'slug' => 'review_' . $game['slug'],
                'rating' => $game['rating'] / 100,
            ]);
        });
    }

    private function formatForView(array $games): array
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => isset($game['cover']) ?  Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : null,
                'rating' => isset($game['rating']) ? round($game['rating']) : null,
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(',')
            ]);
        })->toArray();
    }
    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
