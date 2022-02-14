<div class="game mt-8 relative">
    <div class="relative inline-block">
        <a href="{{ route('games.show', $game['slug']) }}">
            <img src="{{ $game['coverImageUrl'] }}" alt=""
                class="hover:opacity-75 transition ease-in-out duration-150">
        </a>
        @if ($game['rating'])
            <div id="{{ $game['slug'] }}" class="relative bottom-10 left-56 md:left-44 xl:left-56  w-16 h-16 bg-gray-800 rounded-full"
                >
            </div>
            @push('scripts')
                @include('__rating' ,[
                'slug'=>$game['slug'] ,
                'rating' => $game['rating'] ,
                'event' =>null
                ])
            @endpush
        @endif
    </div>
    <div class="absolute bottom-0">
        <a href="{{ route('games.show', $game['slug']) }}"
            class="block text-base font-semibold leading-tight hover:text-gray-400 mt-0 ">
            {{ $game['name'] }}
        </a>
        <div class="text-gray-400 mt-1">
            {{ $game['platforms'] }}
        </div>
    </div>



</div>
