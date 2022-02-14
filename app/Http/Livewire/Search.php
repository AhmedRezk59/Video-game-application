<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class Search extends Component
{
    public $search = "";
    public $searchResults = [];


    public function updated($search)
    {
        if (strlen($this->search) > 2) {
            $games = Http::withHeaders(config('services.igdb'))->withBody(
                "search \"{$this->search}\" ;fields name,slug, cover.url; limit 6;",
                'text/plain'
            )->post(env('IGDB_API'))->json();

            $this->searchResults = $this->formatForView($games);
        } else $this->searchResults = [];
    }
    private function formatForView(array $games): array
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) : null,
            ]);
        })->toArray();
    }
    public function render()
    {

        return view('livewire.search');
    }
}
