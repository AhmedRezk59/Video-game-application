<div wire:init="loadPopularGames">
    <h2 class="text-blue-500 uppercase tracking-wide font-semibold">
        Popular Games
    </h2>
    <div
        class="popular-games sm:container sm:px-32 sm:mx-auto text-sm grid grid-cols-1  md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6 md:gap-12 border-b border-gray-800 pb-16">
        @forelse ($popularGames as $game)
            <x-game-card :game="$game" />
        @empty
            @foreach (range(1, 12) as $game)
                <div class="game mt-8 pb-12">
                    <div class="relative inline-block">
                        <div class="bg-gray-800 w-56 h-64"></div>
                    </div>
                    <div class="absolute">
                        <div
                            class="block text-transparent text-lg bg-gray-700 leading-tight hover:text-gray-400 mt-4 w-56 h-6">
                        </div>
                        <div class="text-transparent text-lg bg-gray-700 rounded mt-3 mb-2 w-1/2 inline-block h-6">
                        </div>
                    </div>
                </div>
            @endforeach
        @endforelse

    </div>
</div>
@push('scripts')
    @include('__rating',[
    'event' => 'gameWithRatingAdded'
    ])
@endpush
