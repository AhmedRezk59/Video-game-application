<div wire:init="loadComingSoonGames">
    <div class="coming-soon">
        <h2 class="text-blue-500 uppercase tracking-wide font-semibold">
            Coming Soon
        </h2>
        <div class="coming-soon-container space-y-10 mt-8">
            @forelse ($comingSoon as $game)
                <x-game-card-small :game="$game" />
            @empty
                <x-game-card-small-skeleton />
            @endforelse
        </div>
    </div>
</div>
