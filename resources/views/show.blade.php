@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="game-datails border-b border-gray-800 px-0 lg:px-12 pb-12 grid  grid-cols-1  lg:grid-cols-6 ">
            <div class="flex-none justify-self-center lg:row-span-2 lg:col-span-2">
                <img src="{{ $game['coverImageUrl'] }}" alt="game cover">
            </div>
            <div class="ml-0 lg:ml-12 text-center lg:text-left mr-64 xs:mt-6 lg:mt xs:w-full sm:col-span-2 lg:col-span-3">
                <h2 class="font-semibold text-2xl md:text-4xl leading-tight mt-1">{{ $game['name'] }}</h2>
                <div class="text-gray-400">
                    <span>
                        {{ $game['genres'] }}
                    </span>
                    &middot;
                    <span>{{ $game['involved_companies'] }}</span>
                    &middot;
                    <span>
                        {{ $game['platforms'] }}
                    </span>
                </div>
                <div class="ml-0 sm:ml-14 md:ml-44 lg:ml-0 xl:ml-12 grid grid-cols-2 md:grid-cols-4 mt-8">
                    <div class="flex items-center sm:justify-self-center md:justify-self-start">
                        <div id="rating" class="w-16 h-16 bg-gray-800 rounded-full">
                            @push('scripts')
                                @include('__rating' ,[
                                'slug'=>'rating',
                                'rating' => $game['rating'],
                                'event' =>null
                                ])
                            @endpush
                        </div>
                        <div class="ml-4 text-xs">Member <br> score</div>
                    </div>
                    <div
                        class="flex items-center justify-self-start lg:ml-12 ml-4 md:mt-0 lg:mt-0">
                        <div id="aggregated_rating" class="w-16 h-16 bg-gray-800 rounded-full">
                            @push('scripts')
                                @include('__rating' ,[
                                'slug'=>'aggregated_rating',
                                'rating' => $game['aggregated_rating'],
                                'event' =>null
                                ])
                            @endpush
                        </div>
                        <div class="ml-4 text-xs">Critic <br> score</div>
                    </div>
                    <div class="flex items-center space-x-4 ml-0 sm:ml-12 md:ml-6 lg:ml-20 mt-6 md:mt-0 xl:mt-0 sm:col-span-2 md:col-span-1">
                        @if ($game['socials']['website'])
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                                <a target="_blank" href="{{ $game['socials']['website']['url'] }}"
                                    class="hover:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                        @if ($game['socials']['instagram'])
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                                <a target="_blank" href="{{ $game['socials']['instagram']['url'] }}"
                                    class="hover:text-gray-400">
                                    <svg class="h-6 w-6 fill-current" version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" width="169.063px" height="169.063px" viewBox="0 0 169.063 169.063"
                                        style="enable-background:new 0 0 169.063 169.063;" xml:space="preserve">
                                        <g>
                                            <path
                                                d="M122.406,0H46.654C20.929,0,0,20.93,0,46.655v75.752c0,25.726,20.929,46.655,46.654,46.655h75.752
                                                                                                                                                                                                                                                                                                                                  c25.727,0,46.656-20.93,46.656-46.655V46.655C169.063,20.93,148.133,0,122.406,0z M154.063,122.407
                                                                                                                                                                                                                                                                                                                                  c0,17.455-14.201,31.655-31.656,31.655H46.654C29.2,154.063,15,139.862,15,122.407V46.655C15,29.201,29.2,15,46.654,15h75.752
                                                                                                                                                                                                                                                                                                                                  c17.455,0,31.656,14.201,31.656,31.655V122.407z" />
                                            <path
                                                d="M84.531,40.97c-24.021,0-43.563,19.542-43.563,43.563c0,24.02,19.542,43.561,43.563,43.561s43.563-19.541,43.563-43.561
                                                                                                                                                                                                                                                                                                                                  C128.094,60.512,108.552,40.97,84.531,40.97z M84.531,113.093c-15.749,0-28.563-12.812-28.563-28.561
                                                                                                                                                                                                                                                                                                                                  c0-15.75,12.813-28.563,28.563-28.563s28.563,12.813,28.563,28.563C113.094,100.281,100.28,113.093,84.531,113.093z" />
                                            <path
                                                d="M129.921,28.251c-2.89,0-5.729,1.17-7.77,3.22c-2.051,2.04-3.23,4.88-3.23,7.78c0,2.891,1.18,5.73,3.23,7.78
                                                                                                                                                                                                                                                                                                                                  c2.04,2.04,4.88,3.22,7.77,3.22c2.9,0,5.73-1.18,7.78-3.22c2.05-2.05,3.22-4.89,3.22-7.78c0-2.9-1.17-5.74-3.22-7.78
                                                                                                                                                                                                                                                                                                                                  C135.661,29.421,132.821,28.251,129.921,28.251z" />
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        @endif
                        @if ($game['socials']['facebook'])
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                                <a target="_blank" href="{{ $game['socials']['facebook']['url'] }}"
                                    class="hover:text-gray-400">
                                    <svg class="h-6 w-6" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" class="bi bi-facebook">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                        @if ($game['socials']['twitter'])
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                                <a target="_blank" href="{{ $game['socials']['twitter']['url'] }}"
                                    class="hover:text-gray-400">
                                    <?xml version="1.0" encoding="iso-8859-1"?>
                                    <!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                    <svg class="w-6 h-6 fill-current" version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" viewBox="0 0 310 310" style="enable-background:new 0 0 310 310;"
                                        xml:space="preserve">
                                        <g id="XMLID_826_">
                                            <path id="XMLID_827_"
                                                d="M302.973,57.388c-4.87,2.16-9.877,3.983-14.993,5.463c6.057-6.85,10.675-14.91,13.494-23.73
                                                                                                                                                                                                                                                                                                                              c0.632-1.977-0.023-4.141-1.648-5.434c-1.623-1.294-3.878-1.449-5.665-0.39c-10.865,6.444-22.587,11.075-34.878,13.783
                                                                                                                                                                                                                                                                                                                              c-12.381-12.098-29.197-18.983-46.581-18.983c-36.695,0-66.549,29.853-66.549,66.547c0,2.89,0.183,5.764,0.545,8.598
                                                                                                                                                                                                                                                                                                                              C101.163,99.244,58.83,76.863,29.76,41.204c-1.036-1.271-2.632-1.956-4.266-1.825c-1.635,0.128-3.104,1.05-3.93,2.467
                                                                                                                                                                                                                                                                                                                              c-5.896,10.117-9.013,21.688-9.013,33.461c0,16.035,5.725,31.249,15.838,43.137c-3.075-1.065-6.059-2.396-8.907-3.977
                                                                                                                                                                                                                                                                                                                              c-1.529-0.851-3.395-0.838-4.914,0.033c-1.52,0.871-2.473,2.473-2.513,4.224c-0.007,0.295-0.007,0.59-0.007,0.889
                                                                                                                                                                                                                                                                                                                              c0,23.935,12.882,45.484,32.577,57.229c-1.692-0.169-3.383-0.414-5.063-0.735c-1.732-0.331-3.513,0.276-4.681,1.597
                                                                                                                                                                                                                                                                                                                              c-1.17,1.32-1.557,3.16-1.018,4.84c7.29,22.76,26.059,39.501,48.749,44.605c-18.819,11.787-40.34,17.961-62.932,17.961
                                                                                                                                                                                                                                                                                                                              c-4.714,0-9.455-0.277-14.095-0.826c-2.305-0.274-4.509,1.087-5.294,3.279c-0.785,2.193,0.047,4.638,2.008,5.895
                                                                                                                                                                                                                                                                                                                              c29.023,18.609,62.582,28.445,97.047,28.445c67.754,0,110.139-31.95,133.764-58.753c29.46-33.421,46.356-77.658,46.356-121.367
                                                                                                                                                                                                                                                                                                                              c0-1.826-0.028-3.67-0.084-5.508c11.623-8.757,21.63-19.355,29.773-31.536c1.237-1.85,1.103-4.295-0.33-5.998
                                                                                                                                                                                                                                                                                                                              C307.394,57.037,305.009,56.486,302.973,57.388z" />
                                        </g>

                                    </svg>

                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2 px-6 flex flex-col items-center justify-center lg:col-span-3">
                <p class="mt-12  px-6 ml-20 lg:ml-0 md:text-start w-96 sm:w-full xl:3/4 ">
                    {{ $game['summary'] }}</p>
                    
                    @if ($game['trailer'])
                        
                <div class="mt-10 ml-20 md:ml-8 self-start" x-data="{ isTrailerModalVisible: false }">
                    <button
                    @click="isTrailerModalVisible = true"
                    class="flex bg-blue-500 text-white font-semibold px-4 py-4 hover:bg-blue-600 rounded transition ease-in-out duration-150"
                    >
                    <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path></svg>
                    <span class="ml-2">Play Trailer</span>
                </button>
                
                <template x-if="isTrailerModalVisible">
                    <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="z-50 fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    >
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button
                                @click="isTrailerModalVisible = false"
                                @keydown.escape.window="isTrailerModalVisible = false"
                                class="text-3xl leading-none hover:text-gray-300"
                                >
                                &times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                <iframe width="560" height="315" class="responsive-iframe absolute top-0 left-0 w-full h-full" src="{{ $game['trailer'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
                    
    </div>
                </div>@endif
        </div><!-- end game details-->
        @if ($game['screenshots'])
            <div class="images-container border-b border-gray-800 pb-12 mt-8"
            x-data="{isImageModalVisible :false,image:''}"
            >
                <h2 class="text-blue-500 uppercase tracking-wide font-semibold">
                    Images
                </h2>
                <div class="grid grid-col-1 md:grid-cols-3 gap-12 mt-8">
                    @foreach ($game['screenshots'] as $screenshot)
                        <div>
                            <a
                             href="#"
                            @click="isImageModalVisible=true;image = '{{$screenshot['huge']}}'"
                             >
                                <img src="{{ $screenshot['big'] }}" alt="screenshot"
                                    class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                        </div>
                    @endforeach

                </div>
                
            <template x-if="isImageModalVisible">
                <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="z-50 fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                >
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button
                                    class="text-3xl leading-none hover:text-gray-300"
                                    @click="isImageModalVisible = false"
                                    @keydown.escape.window="isImageModalVisible = false"
                                >
                                    &times;
                                </button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <img :src="image" alt="screenshot">
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            </div><!-- end images container-->
        @endif

        <div class="smiliar-games  pb-12 mt-8">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold">
                Smiliar Games
            </h2>
            <div
                class="popular-games sm:container sm:px-32 sm:mx-auto text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6 md:gap-12 pb-16">
                @foreach ($game['similar_games'] as $smiliar_game)
                    <x-game-card :game="$smiliar_game" />
                @endforeach
            </div>
        </div><!-- end Smiliar Games-->
    </div>
@endsection
