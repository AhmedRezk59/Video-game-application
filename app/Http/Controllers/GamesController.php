<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * shpow a game
     *
     * @param string $slug
     * @return void
     */
    public function show($slug)
    {
        $game = Http::withHeaders(config('services.igdb'))->withBody(
            "fields name,cover.url,first_release_date,platforms.abbreviation,rating,slug,involved_companies.company.name,genres.name,aggregated_rating,summary,websites.*,videos.*,screenshots.*,similar_games.cover.url,similar_games.name,similar_games.rating,similar_games.platforms.abbreviation,similar_games.slug;where slug = \"$slug\";",
            'text/plain'
        )->post(env('IGDB_API'))->json();
        abort_if(empty($game), 404);

        return view('show', ['game' => $this->formatForView($game[0])]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function formatForView($game)
    {
        return collect($game)->merge([
            'genres' => isset($game['genres']) ? collect($game['genres'])->pluck('name')->implode(',') : null,
            'coverImageUrl' => isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : null,
            'platforms' =>  collect($game['platforms'])->pluck('abbreviation')->implode(','),
            'rating' => (isset($game['rating']) ? round($game['rating'])  : 0),
            'aggregated_rating' => (isset($game['aggregated_rating']) ? round($game['aggregated_rating'])  : 0),
            'socials' =>  isset($game['websites']) ? [
                'website' => collect($game['websites'])->first(),
                'facebook' => collect($game['websites'])->filter(fn ($link) => Str::contains($link['url'], 'facebook'))->first(),
                'twitter' => collect($game['websites'])->filter(fn ($link) => Str::contains($link['url'], 'twitter'))->first(),
                'instagram' => collect($game['websites'])->filter(fn ($link) => Str::contains($link['url'], 'instagram'))->first(),
            ] : [
                'website' => null,
                'instagram' => null,
                'facebook' => null,
                'twitter' => null,
            ],
            'screenshots' => isset($game['screenshots']) ? collect($game['screenshots'])->map(function ($screenshot) {
                return [
                    'huge' => Str::replaceFirst('thumb', 'screenshot_huge', $screenshot['url']),
                    'big' => Str::replaceFirst('thumb', 'screenshot_big', $screenshot['url']),
                ];
            }) : [],
            'similar_games' => collect($game['similar_games'])->map(function ($game) {
                return collect($game)->merge([
                    'coverImageUrl' => isset($game['rating']) ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : null,
                    'rating' => isset($game['rating']) ? round($game['rating']) : null,
                    'platforms' => isset($game['platforms']) ? collect($game['platforms'])->pluck('abbreviation')->implode(',') : null
                ]);
            }),
            'trailer' => isset($game['videos']) ? 'https://www.youtube.com/embed/' . $game['videos'][0]['video_id'] : null,
            'involved_companies' => isset($game['involved_companies']) ? collect($game['involved_companies'])->pluck('company.name')->implode(',') : null
        ]);
    }
}
