<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Developed By ZENAX -->
    {!! SEO::generate(true) !!}

    @laravelPWA

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/favicon/site.webmanifest')}}">




    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
    @livewireStyles
</head>

<body class="bg-white">

    <div x-data="{ open: false }"  class="container flex flex-col mx-auto bg-white rounded-md" style="padding: 10px">
        
        <div style="background-color: #e3efc9; padding:10px" class="relative flex flex-wrap items-center justify-between w-full rounded-md group py-7 shrink-0">
            <div>
                <a href="/">
                    <x-logo></x-logo>
                </a>
            </div>
            <div class="items-center justify-between hidden text-black md:flex">
                <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('/') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="/">Home</a>
                <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('shops') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('shops') }}">Shops</a>
                <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('services') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('services') }}">Services</a>
                <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('services') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('blogs') }}">Blogs</a>
            </div>

            <button x-on:click="open = !open" class="flex md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M3 8H21C21.2652 8 21.5196 7.89464 21.7071 7.70711C21.8946 7.51957 22 7.26522 22 7C22 6.73478 21.8946 6.48043 21.7071 6.29289C21.5196 6.10536 21.2652 6 21 6H3C2.73478 6 2.48043 6.10536 2.29289 6.29289C2.10536 6.48043 2 6.73478 2 7C2 7.26522 2.10536 7.51957 2.29289 7.70711C2.48043 7.89464 2.73478 8 3 8ZM21 16H3C2.73478 16 2.48043 16.1054 2.29289 16.2929C2.10536 16.4804 2 16.7348 2 17C2 17.2652 2.10536 17.5196 2.29289 17.7071C2.48043 17.8946 2.73478 18 3 18H21C21.2652 18 21.5196 17.8946 21.7071 17.7071C21.8946 17.5196 22 17.2652 22 17C22 16.7348 21.8946 16.4804 21.7071 16.2929C21.5196 16.1054 21.2652 16 21 16ZM21 11H3C2.73478 11 2.48043 11.1054 2.29289 11.2929C2.10536 11.4804 2 11.7348 2 12C2 12.2652 2.10536 12.5196 2.29289 12.7071C2.48043 12.8946 2.73478 13 3 13H21C21.2652 13 21.5196 12.8946 21.7071 12.7071C21.8946 12.5196 22 12.2652 22 12C22 11.7348 21.8946 11.4804 21.7071 11.2929C21.5196 11.1054 21.2652 11 21 11Z" fill="black"></path>
                </svg>
            </button>

            <div x-show="open" x-transition style="margin-top: 5px;" class="w-full flex md:hidden transition-all duration-300 ease-in-out flex-col items-start shadow-main justify-center w-full overflow-hidden bg-white group-[.open]:py-4 rounded-2xl top-full">
                <div class="p-2" style="    display: flex;
                flex-direction: column;
            ">
                    <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('/') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="/">Home</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('shops') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('shops') }}">Shops</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('services') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('services') }}">Services</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('services') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('blogs') }}">Blogs</a>
                </div>

            </div>
        </div>
            
        @if(config('app.demo_mode'))
                   @include('pages.home.components.demowidget')
             @endif
    

    </div>



    <!-- Example -->
    <div class="flex ">

        @yield('content')


    </div>
    <!-- Example -->


    @livewireScripts
    
    
</body>

</html>