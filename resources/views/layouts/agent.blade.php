<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
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

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])





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


<body class="container flex flex-col mx-auto bg-white bg-gray-100 rounded-md" style="padding: 10px">

    <nav style="background-color: #e3efc9; padding:10px" class="relative flex flex-wrap items-center justify-between w-full rounded-md group py-7 shrink-0">
        <div class="hidden lg:flex lg:justify-between lg:items-center">
            <a href="#" class="flex items-start gap-2 group">
                <x-logo></x-logo>
            </a>
            <ul class="flex items-center ml-4 space-x-4 text-sm font-semibold">
                {{-- <li><a href="/" class="px-2 py-2 text-gray-800 rounded-md xl:px-4 hover:bg-gray-200">Home</a>
                </li> --}}

                @php
                $authAgentEmail = session('auth_agent');
                $agent = \App\Models\Agent::where('email', $authAgentEmail)->firstOrFail();
                @endphp


                <li><a href="{{ route('agent.dashboard') }}" class="px-2 py-2 text-gray-800 rounded-md xl:px-4 hover:bg-gray-200">Dashboard</a>
                </li>

                @if ($agent->type != 'tour_agent')
                <li><a href="{{ route('agent.records') }}" class="px-2 py-2 text-gray-800 rounded-md xl:px-4 hover:bg-gray-200">Records</a>
                </li>
                <li><a href="{{ route('agent.services') }}" class="px-2 py-2 text-gray-800 rounded-md xl:px-4 hover:bg-gray-200">Our Services</a>
                </li>
                @endif

                @if ($agent->type == 'tour_agent')
                <li><a href="{{ route('agent.packages') }}" class="px-2 py-2 text-gray-800 rounded-md xl:px-4 hover:bg-gray-200">Packages</a>
                </li>
                @endif

                <li><a href="{{ route('agent.profile') }}" class="px-2 py-2 text-gray-800 rounded-md xl:px-4 hover:bg-gray-200">My Profile</a>
                </li>

            </ul>

            <ul class="flex items-center gap-6">

                <li>
                    <a href="{{ route('agent.logout') }}">
                        <div class="p-2 rounded hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-800 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div x-data="{ open: false }" class="relative flex justify-between w-full lg:hidden">
            <a href="#" class="flex items-start gap-2 group">
                <x-logo></x-logo>
            </a>
            <button x-on:click="open = !open" type="button" class="p-3 bg-gray-200 rounded-md">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div x-show="open" x-transition class="absolute left-0 right-0 w-full bg-white border rounded-md top-14" style="z-index: 1;">
                <ul class="p-4">
                    <li class="px-4 py-2 font-bold rounded hover:bg-gray-200">
                        <a href="{{ route('agent.dashboard') }}" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    @if ($agent->type != 'tour_agent')
                    <li class="px-4 py-2 font-bold rounded hover:bg-gray-200">
                        <a href="{{ route('agent.records') }}" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Records
                        </a>
                    </li>
                    <li class="px-4 py-2 font-bold rounded hover:bg-gray-200">
                        <a href="{{ route('agent.services') }}" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Our Services
                        </a>
                    </li>
                    @endif

                    @if ($agent->type == 'tour_agent')
                    <li class="px-4 py-2 font-bold rounded hover:bg-gray-200">
                        <a href="{{ route('agent.packages') }}" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Packages
                        </a>
                    </li>
                    @endif

                    <li class="px-4 py-2 font-bold rounded hover:bg-gray-200">
                        <a href="{{ route('agent.profile') }}" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            My Profile
                        </a>
                    </li>

                    <li class="px-4 py-2 font-bold rounded hover:bg-gray-200">
                        <a href="{{ route('agent.logout') }}">
                            <div class="p-2 rounded hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-800 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </div>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
        @if(env('DEMO_MODE', true))
                   @include('pages.home.components.demowidget')
        @endif
    </nav>
    <!-- End Nav -->
    <!-- Start Main -->
    <main class="container py-4 mx-auto mx-w-6xl">
        @yield('content')
    </main>

   

</body>

</html>