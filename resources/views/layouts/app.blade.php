<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Video game aggragator</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
</head>

<body class="bg-gray-900 text-white">
    <header class="border-b border-gray-800">
        <nav class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4 py-6">
            <div>
                <a href="/">
                    <img src="{{ asset('images/laracasts-logo.svg') }}" alt="" class="w-32 flex-none">
                </a>
            </div>
            <div class="flex items-center mt-6 lg:mt-0">
               @livewire('search')
                <div class="ml-6 xs:w-8 xs:h-8">
                    <a href="#"><img src="{{ asset('images/avatar.jpg') }}" alt="" class="rounded-full w-8"></a>
                </div>
            </div>
        </nav>
    </header>
    <main class="py-8">
        @yield('content')
    </main>
    <footer class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-6">
            Powered By <a href="#" class="underline hover:text-gray-400">IGDB API</a>
        </div>
    </footer>
    @livewireScripts
    <script src="{{asset('js/app.js')}}"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('scripts')
</body>

</html>
