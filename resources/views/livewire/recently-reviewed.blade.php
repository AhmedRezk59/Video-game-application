<div wire:init="loadRecentlyReviwedGames">
    <div class="recently-viewed w-full mr-0 xl:w-3/4 lg:mr-32">
        <h2 class="text-blue-500 uppercase tracking-wide font-semibold">
            Recently Reviewed
        </h2>
        <div class="recently-viewed-container space-y-12 mt-8">
            @forelse ($recentlyReviewed as $game)
                <div
                    class="game  bg-gray-800 rounded-lg shadow-md flex xs:flex-col md:flex-row px-5 py-6 xs:items-center md:items-start">
                    <div class="relative flex-none">
                        <a href="{{ route('games.show', $game['slug']) }}" class="">
                            <img src="{{ $game['coverImageUrl'] }}" alt=""
                                class="w-48 hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        @if ($game['rating'])
                            <div 
                                class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full"
                                style="right:-20px; bottom:-20px">
                                <div id="review_{{ $game['slug'] }}" class="font-semibold text-xs flex justify-center items-center h-full">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class=" xs:mt-6 sm:mt-0 text-center">
                        <a href="{{ route('games.show', $game['slug']) }}"
                            class="block text-lg font-semibold leading-tight hover:text-gray-400 mt-0 lg:mt-4 ">
                            {{ $game['name'] }}
                        </a>
                        <div class="text-gray-00 mt-1">
                            {{ $game['platforms'] }}
                        </div>
                        <p class="mt-6 text-gray-400 hidden sm:block">
                            {{ $game['summary'] }}
                        </p>
                    </div>
                </div>

            @empty
                @foreach (range(1, 3) as $game)
                    <div
                        class="game bg-gray-800 rounded-lg shadow-md flex xs:flex-col md:flex-row px-60 py-6 xs:items-center md:items-start">
                        <div class="relative flex-none">
                            <div class="bg-gray-700 w-56 h-64"></div>
                        </div>
                        <div class="ml-0 md:ml-12 xs:mt-6 sm:mt-0 text-center inline-block">
                            <div class="block text-lg font-semibold leading-tight hover:text-gray-400 mt-0 lg:mt-4 ">
                                <div
                                    class="block mx-auto  text-transparent text-lg bg-gray-700 leading-tight hover:text-gray-400 mt-4 w-56 h-6">
                                </div>
                            </div>
                            <div class="text-transparent text-lg bg-gray-700 rounded mt-3 mb-2 w-1/2 inline-block h-6">
                            </div>
                            <div class="mt-6 text-gray-400 hidden sm:block">
                                <div class="bg-gray-700 sm:w-96 md:w-128  h-6 rounded mt-4"></div>
                                <div class="bg-gray-700 sm:w-96 md:w-128 h-6 rounded mt-4"></div>
                                <div class="bg-gray-700 sm:w-96 md:w-128 h-6 rounded mt-4"></div>
                                <div class="bg-gray-700 sm:w-64 mx-auto h-6 rounded mt-4"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforelse

        </div>
    </div>
</div>

@push('scripts')
    @include('__rating',[
    'event' => 'reviewGameWithRatingAdded'
    ])
@endpush
