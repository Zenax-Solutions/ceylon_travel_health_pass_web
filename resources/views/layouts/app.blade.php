<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ceylon Travel & health pass web</title>

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Styles -->

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


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

<body>


    <div class="container flex flex-col mx-auto bg-white rounded-md" style="padding: 10px">
        <div style="background-color: #e3efc9; padding:10px"
            class="relative flex flex-wrap items-center justify-between w-full rounded-md group py-7 shrink-0">
            <div>
                <a href="/">
                    <img style="width: 200px" src="{{ asset('images/logo.png') }}">
                </a>
            </div>
            <div class="items-center justify-between hidden text-black md:flex">
                <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('/') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                    href="/">Home</a>
                <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('shops') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                    href="{{ route('shops') }}">Shops</a>
                <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('services') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                    href="{{ route('services') }}">Services</a>
                @if (session()->has('auth_customer'))
                    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        href="{{ route('customer.dashboard') }}">My Account</a>
                @else
                    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        href="{{ route('customer.login') }}">Login</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        href="{{ route('customer.register') }}">Register</a>
                @endif

            </div>

            <button onclick="(() => { this.closest('.group').classList.toggle('open')})()" class="flex md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M3 8H21C21.2652 8 21.5196 7.89464 21.7071 7.70711C21.8946 7.51957 22 7.26522 22 7C22 6.73478 21.8946 6.48043 21.7071 6.29289C21.5196 6.10536 21.2652 6 21 6H3C2.73478 6 2.48043 6.10536 2.29289 6.29289C2.10536 6.48043 2 6.73478 2 7C2 7.26522 2.10536 7.51957 2.29289 7.70711C2.48043 7.89464 2.73478 8 3 8ZM21 16H3C2.73478 16 2.48043 16.1054 2.29289 16.2929C2.10536 16.4804 2 16.7348 2 17C2 17.2652 2.10536 17.5196 2.29289 17.7071C2.48043 17.8946 2.73478 18 3 18H21C21.2652 18 21.5196 17.8946 21.7071 17.7071C21.8946 17.5196 22 17.2652 22 17C22 16.7348 21.8946 16.4804 21.7071 16.2929C21.5196 16.1054 21.2652 16 21 16ZM21 11H3C2.73478 11 2.48043 11.1054 2.29289 11.2929C2.10536 11.4804 2 11.7348 2 12C2 12.2652 2.10536 12.5196 2.29289 12.7071C2.48043 12.8946 2.73478 13 3 13H21C21.2652 13 21.5196 12.8946 21.7071 12.7071C21.8946 12.5196 22 12.2652 22 12C22 11.7348 21.8946 11.4804 21.7071 11.2929C21.5196 11.1054 21.2652 11 21 11Z"
                        fill="black"></path>
                </svg>
            </button>

            <div style="margin-top: 20px;"
                class="w-full flex md:hidden transition-all duration-300 ease-in-out flex-col items-start shadow-main justify-center w-full overflow-hidden bg-white max-h-0 group-[.open]:py-4 rounded-2xl group-[.open]:max-h-64 top-full">
                <div class="p-2" style="    display: flex;
                flex-direction: column;
            ">
                    <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('/') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        href="/">Home</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('shops') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        href="{{ route('shops') }}">Shops</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold {{ request()->is('services') ? 'bg-green-200' : 'bg-transparent' }}  rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        href="{{ route('services') }}">Services</a>

                    @if (session()->has('auth_customer'))
                        <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                            href="{{ route('customer.dashboard') }}">Dashboard</a>
                    @else
                        <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                            href="{{ route('customer.login') }}">Login</a>
                        <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-green-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                            href="{{ route('customer.register') }}">Register</a>
                    @endif



                </div>

            </div>
        </div>

    </div>
    <main>



        @yield('content')


    </main>

    <!-- component -->
    <footer class="font-sans bg-gray-900 dark:bg-gray-900">
        <div class="container px-6 py-12 mx-auto">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-y-10 lg:grid-cols-4">

                <div>
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}">
                    </a>
                </div>

                <div>
                    <p class="font-semibold text-gray-800 dark:text-white">Contact Us</p>

                    <div class="flex flex-col items-start mt-5 space-y-2">
                        <p
                            class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">
                            Colombo,Sri Lanka <br>
                            0706997999 <br>
                            info@ceylontravel.com
                        </p>

                    </div>
                </div>

                <div>
                    <p class="font-semibold text-gray-800 dark:text-white">Quick Link</p>

                    <div class="flex flex-col items-start mt-5 space-y-2">
                        <a href="/"
                            class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Home</a>

                        <a href="{{ route('shops') }}"
                            class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Shops</a>

                        <a href="{{ route('services') }}"
                            class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Services</a>

                    </div>
                </div>

                <div>
                    <p class="font-semibold text-gray-800 dark:text-white">More Information</p>

                    <div class="flex flex-col items-start mt-5 space-y-2">
                        <a href="#"
                            class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Privacy
                            Policy</a>

                        <a href="#"
                            class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Terms
                            and Conditions</a>

                        <a href="#"
                            class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Refund
                            Policy</a>
                    </div>
                </div>

                <div>
                    <p class="font-semibold text-gray-800 dark:text-white">Agent Program</p>

                    <div class="flex flex-col items-start mt-5 space-y-2">
                        <a href="{{ route('agent.login') }}"
                            class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Agent
                            Portal</a>

                        <a href="#"
                            class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Destination
                            Portal</a>


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
            <p class="p-8 font-sans text-white text-start md:text-center md:text-lg md:p-4">© {{ now()->year }}
                Ceylon
                Travel. All rights
                reserved. Developed By <a href="https://zenax.info/" target="_blank">ZENAX</a></p>
        </div>
    </footer>


    @livewireScripts


</body>

</html>
