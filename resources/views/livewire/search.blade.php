 <div class="relative" x-data="{isVisible:true}" @click.away="isVisible = false">
     <input wire:model.debounce.200ms="search" type="text"
         class="bg-gray-800 text-sm rounded-full border-2 border-transparent focus:outline-none focus:border-2 box-border focus:border-blue-500 w-64 px-3 py-1 pl-8"
         placeholder="Search (Press '/' to focus)..." x-ref="search" @keydown.window="
            if(event.keyCode === 111){
                event.preventDefault();
                $refs.search.focus()
            }
         " @focus="isVisible = true" @keydown.escape.window="isVisible = false" @keydown="isVisible = true"
         @keydown.shift.tab="isVisible=false">

     <div class="absolute top-0 flex items-center h-full ml-2">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
             class="fill-current text-gray-400 w-4 ">>
             <path fill-rule="evenodd"
                 d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                 clip-rule="evenodd" />

         </svg>
     </div>
     <div wire:loading class="spinner top-0 right-0 mt-4 mr-4 px-1" style="position: absolute"></div>
     <div class="absolute z-50 bg-gray-800 text-xs rounded w-64 mt-2"
       x-show="isVisible">
         <ul>
             @forelse ($searchResults as $game)
                 <li class="border-b border-gray-700">
                     <a href="{{ route('games.show', $game['slug']) }}"
                         class="hover:bg-gray-700 flex items-center transition ease-in-out duration-150 p-3"
                         @if ($loop->last) @keydown.tab="isVisible=false" @endif>
                         @if ($game['coverImageUrl'])
                             <img src="{{ $game['coverImageUrl'] }}" class="h-12" alt="cover">
                         @endif
                         <span @class([
                             'ml-4 font-bold' => true,
                             'ml-14' => !$game['coverImageUrl'],
                         ])>{{ $game['name'] }}</span>
                     </a>
                 </li>
             @empty
                 @if (strlen($search) > 2 && $search != '')
                     <li class="border-b border-gray-700">
                         <div class="p-2 font-bold">No results for search</div>
                     </li>
                 @elseif($search != '')
                     <li class="border-b border-gray-700">
                         <div class="p-2 font-bold">You should write more than two characters</div>
                     </li>
                 @endif
             @endforelse

         </ul>
     </div>
 </div>
