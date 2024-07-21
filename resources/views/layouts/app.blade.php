<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
@laravelPWA
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Developed By ZENAX -->
    {!! SEO::generate(true) !!}


    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/favicon/site.webmanifest')}}">



    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Styles -->

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">


    @livewireStyles


    <style>
        body {
            font-family: "Poppins", sans-serif;
            font-weight: 100;


        }

        .edited-list ul {
            list-style-type: disc !important;
        }
    </style>


</head>

<body x-data="{ isLoading: true }" x-init="window.addEventListener('load', () => isLoading = true)">

    @include('pages.home.components.preloader')

    <div id="main-content" style="display:none;">



        <div x-data="{ open: false }" style="background-color: #e3efc9; position: fixed;width: 100%; z-index: 100; align-items: center;"  class="flex flex-col mx-auto justify-center">
            <div style="padding: 10px;"  class="container  relative gap-4 flex flex-wrap items-center justify-between md:justify-center lg:justify-between w-full rounded-md group py-7 shrink-0">
                <div>
                    <a href="/">
                        <x-logo></x-logo>
                    </a>
                </div>
                <div class="items-center  justify-between hidden text-black md:flex">
                    <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('/') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="/">Home</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('shops') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('shops') }}">Shops</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('services') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('services') }}">Services</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('blogs') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('blogs') }}">Blogs</a>
                    @if(session()->has('auth_customer'))
                    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('customer.dashboard') }}">My Account</a>
                    @else
                    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('customer.login') }}">Login</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('customer.register') }}">Register</a>
                    @endif
                    

                </div>

                <button x-on:click="open = !open" class="flex md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3 8H21C21.2652 8 21.5196 7.89464 21.7071 7.70711C21.8946 7.51957 22 7.26522 22 7C22 6.73478 21.8946 6.48043 21.7071 6.29289C21.5196 6.10536 21.2652 6 21 6H3C2.73478 6 2.48043 6.10536 2.29289 6.29289C2.10536 6.48043 2 6.73478 2 7C2 7.26522 2.10536 7.51957 2.29289 7.70711C2.48043 7.89464 2.73478 8 3 8ZM21 16H3C2.73478 16 2.48043 16.1054 2.29289 16.2929C2.10536 16.4804 2 16.7348 2 17C2 17.2652 2.10536 17.5196 2.29289 17.7071C2.48043 17.8946 2.73478 18 3 18H21C21.2652 18 21.5196 17.8946 21.7071 17.7071C21.8946 17.5196 22 17.2652 22 17C22 16.7348 21.8946 16.4804 21.7071 16.2929C21.5196 16.1054 21.2652 16 21 16ZM21 11H3C2.73478 11 2.48043 11.1054 2.29289 11.2929C2.10536 11.4804 2 11.7348 2 12C2 12.2652 2.10536 12.5196 2.29289 12.7071C2.48043 12.8946 2.73478 13 3 13H21C21.2652 13 21.5196 12.8946 21.7071 12.7071C21.8946 12.5196 22 12.2652 22 12C22 11.7348 21.8946 11.4804 21.7071 11.2929C21.5196 11.1054 21.2652 11 21 11Z" fill="black"></path>
                    </svg>
                </button>

                <div  x-show="open" x-transition style="margin-top: 5px;" class="w-full flex md:hidden transition-all duration-300 ease-in-out flex-col items-start shadow-main justify-center w-full overflow-hidden bg-white  group-[.open]:py-4 rounded-2xl  top-full">
                    <div class="p-2" style="    display: flex;
                flex-direction: column; align-self: center;text-align: center;
            ">
                        <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('/') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="/">Home</a>
                        <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('shops') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('shops') }}">Shops</a>
                        <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('services') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('services') }}">Services</a>
                        <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('blogs') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('blogs') }}">Blogs</a>
                        @if(session()->has('auth_customer'))
                        <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('customer.dashboard') }}">Dashboard</a>
                        @else
                        <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('customer.login') }}">Login</a>
                        <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('customer.register') }}">Register</a>
                        @endif
                       
                      



                    </div>

                </div>
            </div>

        </div>
        <main>

        <div class="pt-12 sm:pt-12 md:pt-24 lg:pt-12">
        @yield('content')
        </div>

        </main>

        <!-- component -->
        <footer class="font-sans bg-gray-900 dark:bg-gray-900">
            <div class="container px-6 py-12 mx-auto">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-y-10 lg:grid-cols-4 text-center md:text-left lg:text-left">

                    <div class="flex justify-center md:justify-start lg:justify-start">
                        <a href="/">
                            <x-logo></x-logo>
                        </a>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-800 dark:text-white">Contact Us</p>

                        <div class="flex flex-col items-center md:items-start lg:items-start mt-5 space-y-2">
                            <p class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">
                                Colombo,Sri Lanka <br>
                                0706997999 <br>
                                info@ceylontravel.com
                            </p>

                        </div>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-800 dark:text-white">Quick Link</p>

                        <div class="flex flex-col items-center md:items-start lg:items-start mt-5 space-y-2">
                            <a href="/" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Home</a>

                            <a href="{{ route('shops') }}" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Shops</a>

                            <a href="{{ route('services') }}" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Services</a>

                            <a href="{{ route('blogs') }}" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Blogs</a>

                        </div>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-800 dark:text-white">More Information</p>

                        <div class="flex flex-col items-center md:items-start lg:items-start mt-5 space-y-2">
                            <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Privacy
                                Policy</a>

                            <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Terms
                                and Conditions</a>

                            <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Refund
                                Policy</a>

                                @include('components.language-switcher')
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-800 dark:text-white">Agent Program</p>

                        <div class="flex flex-col items-center md:items-start lg:items-start mt-5 space-y-2">
                            <a href="{{ route('agent.login') }}" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Agent
                                Portal</a>

                            <a href="{{ route('destination.login') }}" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Destination
                                Portal</a>
                            <button id="pwa-download-btn" style="display: none;" class="middle none center mr-3 rounded-lg bg-green-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">
                                Download Agent App
                            </button>

                        </div>
                    </div>
                </div>

                <hr class="h-2 my-6 border-gray-200 md:my-8 dark:border-gray-700" />

                {{-- <div class="sm:flex sm:items-center sm:justify-between">
                <div class="flex flex-1 gap-4 hover:cursor-pointer">
                    <img src="https://www.svgrepo.com/show/303139/google-play-badge-logo.svg" width="130"
                        height="110" alt="" />
                    <img src="https://www.svgrepo.com/show/303128/download-on-the-app-store-apple-logo.svg"
                        width="130" height="110" alt="" />
                </div>

                <div class="flex gap-4 hover:cursor-pointer">
                    <img src="https://www.svgrepo.com/show/303114/facebook-3-logo.svg" width="30" height="30"
                        alt="fb" />
                    <img src="https://www.svgrepo.com/show/303115/twitter-3-logo.svg" width="30" height="30"
                        alt="tw" />
                    <img src="https://www.svgrepo.com/show/303145/instagram-2-1-logo.svg" width="30" height="30"
                        alt="inst" />
                    <img src="https://www.svgrepo.com/show/94698/github.svg" class="" width="30"
                        height="30" alt="gt" />
                    <img src="https://www.svgrepo.com/show/22037/path.svg" width="30" height="30"
                        alt="pn" />
                    <img src="https://www.svgrepo.com/show/28145/linkedin.svg" width="30" height="30"
                        alt="in" />
                    <img src="https://www.svgrepo.com/show/22048/dribbble.svg" class="" width="30"
                        height="30" alt="db" />
                </div>
            </div> --}}
                <p class="p-8 font-sans text-white text-center md:text-start lg:text-start md:text-center md:text-lg md:p-4">
                    © {{ now()->year }}
                    Ceylon
                    Travel. All rights
                    reserved. Developed By <a href="https://zenax.info/" target="_blank">ZENAX</a></p>
            </div>
        </footer>
    </div>

    @livewireScripts


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var preloader = document.getElementById('preloader');
            var mainContent = document.getElementById('main-content');

            // Simulating content load with a timeout
            setTimeout(function() {
                preloader.style.display = 'none';
                mainContent.style.display = 'block';
            }, 1500); // You can adjust the delay as needed or use an actual event like 'load'
        });
    </script>

    <script>
        let deferredPrompt;

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            document.getElementById('pwa-download-btn').style.display = 'block';
        });

        document.addEventListener('DOMContentLoaded', () => {
            const installButton = document.getElementById('pwa-download-btn');
            if (installButton) {
                installButton.addEventListener('click', () => {
                    if (deferredPrompt) {
                        deferredPrompt.prompt();
                        deferredPrompt.userChoice.then((result) => {
                            if (result.outcome === 'accepted') {
                                console.log('User accepted the install prompt');
                            } else {
                                console.log('User dismissed the install prompt');
                            }
                            deferredPrompt = null;
                        });
                    }
                });
            }
        });
    </script>

</body>

</html>