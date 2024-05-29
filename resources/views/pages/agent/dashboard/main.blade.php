<!-- component -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="relative antialiased bg-gray-100">
    <!-- Start Nav -->
    <div class="fixed bottom-4 right-4 xl:right-20">
        <a href="https://www.buymeacoffee.com/ejulfaey" target="_blank"
            class="flex items-center justify-between gap-4 px-4 py-3 font-mono font-semibold duration-500 ease-in-out transform bg-yellow-400 rounded-lg shadow animate-bounce hover:shadow-xl">
            <img class="w-8 h-8 rounded"
                src="https://img.buymeacoffee.com/api/?name=Ejul&size=300&bg-image=bmc&background=5F7FFF"
                alt="buymeacoffee">
            Buy Me A Coffee
        </a>
    </div>
    <nav class="p-4 md:py-8 xl:px-0 md:container md:mx-w-6xl md:mx-auto">
        <div class="hidden lg:flex lg:justify-between lg:items-center">
            <a href="#" class="flex items-start gap-2 group">
                <div class="p-2 text-white bg-blue-600 rounded-md group-hover:bg-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-sm font-light uppercase">
                    Dashboard
                    <span class="block text-base font-bold tracking-widest">
                        Atom
                    </span>
                </p>
            </a>
            <ul class="flex items-center space-x-4 text-sm font-semibold">
                <li><a href="#" class="px-2 py-2 text-gray-800 rounded-md xl:px-4 hover:bg-gray-200">My
                        Account</a></li>
                <li class="relative" x-data="{ open: false }">
                    <a x-on:click="open = !open" x-on:click.outside="open = false" href="#"
                        class="flex items-center gap-2 px-2 py-2 text-gray-600 rounded-md xl:px-4 hover:bg-gray-200">
                        Transactions
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 text-gray-800 duration-500 ease-in-out transform stroke-current stroke-2"
                            :class="open ? 'rotate-90' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg> </a>
                    <ul x-cloak x-show="open" x-transition
                        class="absolute left-0 w-64 p-4 overflow-hidden bg-white rounded-md shadow top-10">
                        <li>
                            <a href="#"
                                class="flex items-center block gap-2 p-4 text-sm text-gray-600 rounded hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                Transaction ABC
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center block gap-2 p-4 text-sm text-gray-600 rounded hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                Transaction DEF
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center block gap-2 p-4 text-sm text-gray-600 rounded hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                Transaction GHI
                            </a>
                        </li>
                    </ul>
                </li>
                <li><a href="#" class="px-2 py-2 text-gray-600 rounded-md xl:px-4 hover:bg-gray-200">Cards </a>
                </li>
                <li><a href="#" class="px-2 py-2 text-gray-600 rounded-md xl:px-4 hover:bg-gray-200">Offers</a>
                </li>
            </ul>
            <ul class="flex space-x-2 text-sm font-semibold xl:space-x-4">
                <li>
                    <a href="#">
                        <div class="p-2 rounded hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-800 stroke-current"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="p-2 rounded hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-800 stroke-current"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="p-2 rounded hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-800 stroke-current"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                    </a>
                </li>
            </ul>
            <ul class="flex items-center gap-6">
                <li>
                    <a href="#" class="font-sans text-sm font-semibold tracking-wider text-gray-800">
                        Derol Hakim
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.logout') }}">
                        <div class="p-2 rounded hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-800 stroke-current"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div x-data="{ open: false }" class="relative flex justify-between w-full lg:hidden">
            <a href="#" class="flex items-start gap-2 group">
                <div class="p-3 text-white bg-blue-600 rounded-md group-hover:bg-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-sm font-light uppercase">
                    Dashboard
                    <span class="block text-base font-bold tracking-widest">
                        Atom
                    </span>
                </p>
            </a>
            <button x-on:click="open = !open" type="button" class="p-3 bg-gray-200 rounded-md">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h7" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div x-show="open" x-transition class="absolute left-0 right-0 w-full bg-white border rounded-md top-14">
                <ul class="p-4">
                    <li class="px-4 py-2 rounded hover:bg-gray-200">
                        <a href="#" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            My Account
                        </a>
                    </li>
                    <li class="px-4 py-2 rounded hover:bg-gray-200">
                        <a href="#" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            Transactions
                        </a>
                    </li>
                    <li class="px-4 py-2 rounded hover:bg-gray-200">
                        <a href="#" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            Cards
                        </a>
                    </li>
                    <li class="px-4 py-2 rounded hover:bg-gray-200">
                        <a href="#" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            Offers
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <!-- End Nav -->
    <!-- Start Main -->
    <main class="container py-4 mx-auto mx-w-6xl">
        <div class="flex flex-col space-y-8">
            <!-- First Row -->
            <div class="grid grid-cols-1 px-4 md:grid-cols-4 xl:grid-cols-5 xl:p-0 gap-y-4 md:gap-6">
                <div class="p-6 bg-white border md:col-span-2 xl:col-span-3 rounded-2xl border-gray-50">
                    <div class="flex flex-col space-y-6 md:h-full md:justify-between">
                        <div class="flex justify-between">
                            <span class="text-xs font-semibold tracking-wider text-gray-500 uppercase">
                                Main Account
                            </span>
                            <span class="text-xs font-semibold tracking-wider text-gray-500 uppercase">
                                Available Funds
                            </span>
                        </div>
                        <div class="flex items-center justify-between gap-2 md:gap-4">
                            <div class="flex flex-col space-y-4">
                                <h2 class="font-bold leading-tight tracking-widest text-gray-800">Derol's Savings
                                    Account</h2>
                                <div class="flex items-center gap-4">
                                    <p class="text-lg tracking-wider text-gray-600">**** **** *321</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </div>
                            </div>
                            <h2 class="text-lg font-black tracking-wider text-gray-700 md:text-xl xl:text-3xl">
                                <span class="md:text-xl">$</span>
                                92,817.45
                            </h2>
                        </div>
                        <div class="flex gap-2 md:gap-4">
                            <a href="#"
                                class="w-full px-5 py-3 text-xs font-semibold tracking-wider text-center text-white bg-blue-600 rounded-lg md:w-auto hover:bg-blue-800">
                                Transfer Money
                            </a>
                            <a href="#"
                                class="w-full px-5 py-3 text-xs font-semibold tracking-wider text-center text-blue-600 rounded-lg bg-blue-50 md:w-auto hover:bg-blue-600 hover:text-white">
                                Link Account
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col justify-between col-span-2 p-6 rounded-2xl bg-gradient-to-r from-blue-500 to-blue-800">
                    <div class="flex flex-col">
                        <p class="font-bold text-white">Lorem ipsum dolor sit amet</p>
                        <p class="max-w-sm mt-1 text-xs font-light leading-tight md:text-sm text-gray-50">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio soluta saepe consequuntur
                            facilis ab a. Molestiae ad saepe assumenda praesentium rem dolore? Exercitationem, neque
                            obcaecati?
                        </p>
                    </div>
                    <div class="flex items-end justify-between">
                        <a href="#"
                            class="px-4 py-3 text-xs font-semibold tracking-wider text-white bg-blue-800 rounded-lg hover:bg-blue-600 hover:text-white">
                            Learn More
                        </a>
                        <img src="https://atom.dzulfarizan.com/assets/calendar.png" alt="calendar"
                            class="object-cover w-auto h-24">
                    </div>
                </div>

            </div>
            <!-- End First Row -->
            <!-- Start Second Row -->
            <div class="grid grid-cols-1 gap-4 px-4 md:grid-cols-2 lg:grid-cols-4 xl:p-0 xl:gap-6">
                <div class="flex justify-between col-span-1 md:col-span-2 lg:col-span-4">
                    <h2 class="text-xs font-bold tracking-wide text-gray-700 md:text-sm md:tracking-wider">
                        Expenses By Category</h2>
                    <a href="#" class="text-xs font-semibold text-gray-800 uppercase">More</a>
                </div>
                <div class="p-6 bg-white border rounded-xl border-gray-50">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col">
                            <p class="text-xs tracking-wide text-gray-600">Foods & Beverages</p>
                            <h3 class="mt-1 text-lg font-bold text-blue-500">$ 818</h3>
                            <span class="mt-4 text-xs text-gray-500">Last Transaction 3 Hours ago</span>
                        </div>
                        <div class="p-2 bg-blue-500 rounded-md md:p-1 xl:p-2">
                            <img src="https://atom.dzulfarizan.com/assets/dish-2.png" alt="icon"
                                class="object-cover w-auto h-8 md:h-6 xl:h-8">
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-white border rounded-xl border-gray-50">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col">
                            <p class="text-xs tracking-wide text-gray-600">Groceries</p>
                            <h3 class="mt-1 text-lg font-bold text-green-500">$ 8,918</h3>
                            <span class="mt-4 text-xs text-gray-500">Last Transaction 3 Days ago</span>
                        </div>
                        <div class="p-2 bg-green-500 rounded-md md:p-1 xl:p-2">
                            <img src="https://atom.dzulfarizan.com/assets/grocery.png" alt="icon"
                                class="object-cover w-auto h-8 md:h-6 xl:h-8">
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-white border rounded-xl border-gray-50">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col">
                            <p class="text-xs tracking-wide text-gray-600">Gaming</p>
                            <h3 class="mt-1 text-lg font-bold text-yellow-500">$ 1,223</h3>
                            <span class="mt-4 text-xs text-gray-600">Last Transaction 4 Days ago</span>
                        </div>
                        <div class="p-2 bg-yellow-500 rounded-md md:p-1 xl:p-2">
                            <img src="https://atom.dzulfarizan.com/assets/gaming.png" alt="icon"
                                class="object-cover w-auto h-8 md:h-6 xl:h-8">
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-white border rounded-xl border-gray-50">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col">
                            <p class="text-xs tracking-wide text-gray-600">Trip & Holiday</p>
                            <h3 class="mt-1 text-lg font-bold text-indigo-500">$ 5,918</h3>
                            <span class="mt-4 text-xs text-gray-500">Last Transaction 1 Month ago</span>
                        </div>
                        <div class="p-2 bg-indigo-500 rounded-md md:p-1 xl:p-2">
                            <img src="https://atom.dzulfarizan.com/assets/holiday.png" alt="icon"
                                class="object-cover w-auto h-8 md:h-6 xl:h-8">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Second Row -->
            <!-- Start Third Row -->
            <div class="grid items-start grid-cols-1 px-4 md:grid-cols-5 xl:p-0 gap-y-4 md:gap-6">
                <div class="col-start-1 col-end-5">
                    <h2 class="text-xs font-bold tracking-wide text-gray-800 md:text-sm">Summary Transactions</h2>
                </div>
                <div class="flex flex-col col-span-2 p-6 space-y-6 bg-white border rounded-xl border-gray-50">
                    <div class="flex grid items-center justify-between grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                        <div class="p-4 border cursor-pointer">
                            <span class="text-xs font-semibold text-gray-500">Daily</span>
                            <h2 class="font-bold tracking-wider text-gray-800">$ 27.80</h2>
                        </div>
                        <div class="p-4 border cursor-pointer">
                            <span class="text-xs font-semibold text-gray-500">Weekly</span>
                            <h2 class="font-bold tracking-wider text-gray-800">$ 192.92</h2>
                        </div>
                        <div class="p-4 border cursor-pointer">
                            <span class="text-xs font-semibold text-gray-500">Monthly</span>
                            <h2 class="font-bold tracking-wider text-gray-800">$ 501.10</h2>
                        </div>
                    </div>
                    <canvas id="myChart"></canvas>
                </div>
                <div class="flex flex-col col-span-3 p-6 space-y-6 bg-white border rounded-xl border-gray-50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-bold tracking-wide text-gray-600">Latest Transactions</h2>
                        <a href="#"
                            class="px-4 py-2 text-xs font-semibold tracking-wider text-blue-500 uppercase bg-blue-100 rounded hover:bg-blue-300">More</a>
                    </div>
                    <ul class="w-full overflow-x-auto divide-y-2 divide-gray-100">
                        <li class="flex justify-between py-3 text-sm font-semibold text-gray-500">
                            <p class="px-4 font-semibold">Today</p>
                            <p class="px-4 text-gray-600">McDonald</p>
                            <p class="px-4 tracking-wider">Cash</p>
                            <p class="px-4 text-blue-600">Food</p>
                            <p class="flex items-center gap-2 text-gray-800 md:text-base">
                                16.90
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </p>
                        </li>
                        <li class="flex justify-between py-3 text-sm font-semibold text-gray-500">
                            <p class="px-4 font-semibold">Today</p>
                            <p class="px-4 text-gray-600">McDonald</p>
                            <p class="px-4 tracking-wider">Cash</p>
                            <p class="px-4 text-blue-600">Food</p>
                            <p class="flex items-center gap-2 text-gray-800 md:text-base">
                                16.90
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </p>
                        </li>
                        <li class="flex justify-between py-3 text-sm font-semibold text-gray-500">
                            <p class="px-4 font-semibold">Today</p>
                            <p class="px-4 text-gray-600">McDonald</p>
                            <p class="px-4 tracking-wider">Cash</p>
                            <p class="px-4 text-blue-600">Food</p>
                            <p class="flex items-center gap-2 text-gray-800 md:text-base">
                                16.90
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </p>
                        </li>
                        <li class="flex justify-between py-3 text-sm font-semibold text-gray-500">
                            <p class="px-4 font-semibold">Today</p>
                            <p class="px-4 text-gray-600">McDonald</p>
                            <p class="px-4 tracking-wider">Cash</p>
                            <p class="px-4 text-blue-600">Food</p>
                            <p class="flex items-center gap-2 text-gray-800 md:text-base">
                                16.90
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </p>
                        </li>
                        <li class="flex justify-between py-3 text-sm font-semibold text-gray-500">
                            <p class="px-4 font-semibold">Today</p>
                            <p class="px-4 text-gray-600">McDonald</p>
                            <p class="px-4 tracking-wider">Cash</p>
                            <p class="px-4 text-blue-600">Food</p>
                            <p class="flex items-center gap-2 text-gray-800 md:text-base">
                                16.90
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </p>
                        </li>
                        <li class="flex justify-between py-3 text-sm font-semibold text-gray-500">
                            <p class="px-4 font-semibold">Today</p>
                            <p class="px-4 text-gray-600">McDonald</p>
                            <p class="px-4 tracking-wider">Cash</p>
                            <p class="px-4 text-blue-600">Food</p>
                            <p class="flex items-center gap-2 text-gray-800 md:text-base">
                                16.90
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End Third Row -->
        </div>
    </main>
    <!-- End Main -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        const data = {
            labels: [
                'Food & beverages',
                'Groceries',
                'Gaming',
                'Trip & holiday',
            ],
            datasets: [{
                label: 'Total Expenses',
                data: [148, 150, 130, 170],
                backgroundColor: [
                    '#3B82F6',
                    '#10B981',
                    '#6366F1',
                    '#F59E0B'
                ]
            }]
        };

        const config = {
            type: 'polarArea',
            data: data,
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                }
            }
        };

        const chart = new Chart(ctx, config);
    </script>

</body>

</html>
