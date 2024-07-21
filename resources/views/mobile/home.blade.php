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


        <div class="flex flex-col justify-center min-h-screen bg-white sm:py-12">
            <div class="p-10 mx-auto xs:p-0 md:w-full md:max-w-md">
                <div class="flex justify-center mb-4">

                    <x-logo></x-logo>

                </div>
                <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                    <div class="sm:mx-auto sm:w-full sm:max-w-sm pb-2">
                        <img class="mx-auto w-auto" style="width: 60%;" src="{{asset('images/icons/agent.png')}}">
                       
                        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight to-blue-500">Agent Portal</h2>
                    </div>
                    <a href="{{ route('agent.login') }}"
                                class="middle none center mr-3 text-center rounded-lg bg-green-500 py-3 px-6 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true">
                               Log-In
                            </a>
                    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm pb-2">
                        <img class="mx-auto " style="width: 60%;" src="{{asset('images/icons/destination.png')}}" >
                        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight to-blue-500">Destination Portal</h2>
                    </div>
                    <a href="{{ route('destination.login') }}"
                                class="middle none center mr-3 text-center rounded-lg bg-green-500 py-3 px-6 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true">
                               Log-In
                            </a>

                </div>
            </div>

        </div>


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