<div wire:init="loadMostAnticipatedGames">
    <div class="most-anticipated mt-12 md:mt-0">
        <h2 class="text-blue-500 uppercase tracking-wide font-semibold">
            Most Anticipated
        </h2>
        <div class="most-anticipated-container space-y-10 mt-8">
            @forelse ($mostAnticipated as $game)
                <x-game-card-small :game="$game" />

            @empty
            <x-game-card-small-skeleton />
            @endforelse
        </div>
    </div>
</div>
