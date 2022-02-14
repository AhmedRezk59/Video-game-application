 <div class="game flex">
     @if ($game['coverImageUrl'])
         <a href="{{ route('games.show', $game['slug']) }}">
             <img src="{{ $game['coverImageUrl'] }}" alt=""
                 class="w-16 hover:opacity-75 transition ease-in-out duration-150 h-full">
         </a>
     @endif
     <div  @class([
         'ml-4' => true,
         'ml-20' => !$game['coverImageUrl'],
     ])>
         <a href="{{ route('games.show', $game['slug']) }}" class="hover:text-gray-300">{{ $game['name'] }}</a>
         <div class="text-gray-400 text-sm mt-1">
             {{ $game['release_date'] }}</div>
     </div>
 </div>
