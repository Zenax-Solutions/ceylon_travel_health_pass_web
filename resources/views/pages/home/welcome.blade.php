@extends('layouts.app')
@section('content')

    <!-- Live Chat -->
    @include('pages.home.components.chatwidget')

    <div class="container flex flex-col mx-auto bg-white" style="padding: 10px">
        <div class="grid w-full grid-cols-1 my-auto mt-12 mb-8 md:grid-cols-3 ">
            <div class="flex flex-col justify-center text-center lg:text-start">

                <h1 class="mb-4 text-4xl font-extrabold leading-tight lg:text-6xl text-dark-grey-900">Ceylon Travel
                    & Health Pass</h1>
                <p class="text-base font-normal leading-7 lg:w-3/4 text-grey-900">
                <div class="p-6 mb-8 space-y-6 border-l-2 border-dashed">
                    <div class="relative w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="absolute -top-0.5 z-10 -ml-3.5 h-7 w-7 rounded-full text-green-500">
                            <path fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="ml-6">

                            <p class="max-w-screen-sm mt-2 text-sm font-bold text-gray-500">Skip the Lines with One Digital
                                Pass – No
                                Waiting at Ticket Counters. </p>

                        </div>
                    </div>
                    <div class="relative w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="absolute -top-0.5 z-10 -ml-3.5 h-7 w-7 rounded-full text-green-500">
                            <path fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="ml-6">

                            <p class="max-w-screen-sm mt-2 text-sm font-bold text-gray-500">Plan your trip from our huge
                                selection of
                                attractions.</p>

                        </div>
                    </div>
                    <div class="relative w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="absolute -top-0.5 z-10 -ml-3.5 h-7 w-7 rounded-full text-green-500">
                            <path fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="ml-6">

                            <p class="max-w-screen-sm mt-2 text-sm font-bold text-gray-500">Download your digital pass and
                                start
                                exploring. There are no additional entry fees to pay. </p>

                        </div>
                    </div>

                </div>
                </p>

            </div>
            <div class="items-center justify-end hidden md:flex">
                <img class="rounded-md w-100" src="{{ asset('images/mobile.png') }}" alt="header image">
            </div>
            <div class="items-center justify-end md:flex">
                <img class="rounded-md" style="height: 100%;
            object-fit: cover;"
                    src="https://miro.medium.com/v2/resize:fit:1200/0*Xe9F6yINuszQazSX.jpg" alt="header image">
            </div>
        </div>

    </div>


    <section class="text-gray-600 bg-gray-100 body-font">
        <div class="container mx-auto">
            <div class="flex flex-wrap">
                <!--start here-->

                @forelse ($packages as $key => $package)
                    <div class="p-4 md:w-1/2 lg:w-1/4">

                        <div class="relative flex flex-col text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">

                            <div class="p-6 ">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-xl font-black text-gray-800 md:text-xl">
                                        <span class="font-normal">{{ $key + 1 }}.</span> Choose Your Attractions
                                    </h3>
                                </div>
                            </div>

                            <div>
                                <div id="default-carousel" class="relative w-full" data-carousel="slide">
                                    <!-- Carousel wrapper -->
                                    <div class="relative h-56 overflow-hidden ">

                                        @if (isset($package->gallery))
                                            @forelse ($package->gallery as $image)
                                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                                    <img src="{{ Storage::url($image) }}"
                                                        class="absolute block object-cover w-40 w-full h-64 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                            @empty
                                            @endforelse
                                        @endif

                                    </div>
                                    <!-- Slider indicators -->
                                    <div
                                        class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2 rtl:space-x-reverse">

                                        @if (isset($package->gallery))
                                            @forelse ($package->gallery as $key => $imageDots)
                                                <button type="button" class="w-3 h-3 rounded-full" aria-current="true"
                                                    data-carousel-slide-to="{{ $key }}"></button>
                                            @empty
                                            @endforelse
                                        @endif

                                    </div>
                                    <!-- Slider controls -->
                                    <button type="button"
                                        class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer start-0 group focus:outline-none"
                                        data-carousel-prev>
                                        <span
                                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M5 1 1 5l4 4" />
                                            </svg>
                                            <span class="sr-only">Previous</span>
                                        </span>
                                    </button>
                                    <button type="button"
                                        class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer end-0 group focus:outline-none"
                                        data-carousel-next>
                                        <span
                                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 9 4-4-4-4" />
                                            </svg>
                                            <span class="sr-only">Next</span>
                                        </span>
                                    </button>
                                </div>


                            </div>
                            <div class="p-6 ">
                                <div class="flex items-center justify-between mb-2">

                                    <h3 class="text-xl font-black text-green-400 md:text-3xl">
                                        {{ $package->main_title }}</h3>

                                    <p
                                        class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900">
                                        ${{ number_format($package->price) }}
                                    </p>
                                </div>
                                <p class="text-base text-gray-500 md:text-lg">
                                <h1 class="text-lg font-black text-gray-800 md:text-2xl">Travel</h1>
                                {!! $package->travel_info !!}
                                </p>
                                <p class="text-base text-gray-500 md:text-lg">
                                <h1 class="text-lg font-black text-gray-800 md:text-2xl">Health</h1>
                                {!! $package->health_info !!}
                                </p>
                            </div>

                            <div class="pl-6">
                                <h1 class="text-lg font-black text-gray-800 md:text-2xl">Destinations</h1>
                                <div class="flex items-center pt-4 pb-4">

                                    @forelse ($destinations as $destination)
                                        <img style="object-fit: cover"
                                            class="transform border border-gray-200 rounded-full w-14 h-14 hover:scale-125"
                                            src="{{ Storage::url($destination->image) }}" />
                                    @empty
                                    @endforelse

                                </div>
                            </div>


                            <div class="p-6 pt-0">
                                <div>
                                    <div class="inline-block mr-5 align-bottom">
                                        <span class="text-5xl leading-none align-baseline">$</span>
                                        <span
                                            class="text-5xl font-bold leading-none align-baseline">{{ number_format($package->price) }}</span>
                                    </div>
                                    <div class="inline-block align-bottom">
                                        <a href="{{ route('package', ['id' => $package->id]) }}"
                                            class="px-10 font-semibold text-white bg-green-500 rounded-full opacity-75 hover:opacity-100 hover:text-gray-900"><i
                                                class="mr-2 -ml-2 mdi mdi-cart"></i>More Details</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                @empty
                @endforelse

                <!--End here-->
            </div>
        </div>
    </section>
    <div class="py-16 overflow-hidden bg-gray-50">
        <div class="container px-6 m-auto space-y-8 text-gray-500 md:px-12">
            <div>
                <span class="text-lg font-semibold text-gray-600">Discount Shops</span>
                <h2 class="mt-4 text-2xl font-bold text-gray-900 md:text-4xl">Best Discount Shop's</h2>
            </div>
            <div
                class="grid mt-16 overflow-hidden border divide-x divide-y rounded-xl sm:grid-cols-2 lg:divide-y-0 lg:grid-cols-3 xl:grid-cols-4">

                @forelse ($discountShops as $shop)
                    <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                        <div class="relative p-8 space-y-8">
                            <img src="{{ Storage::url($shop->image) }}" alt="burger illustration">

                            <div class="space-y-2">
                                <a href="{{ $shop->location }}" target="_blank" rel="noopener noreferrer">
                                    <h5 class="text-xl font-medium text-gray-800 transition group-hover:text-yellow-600">
                                        {{ $shop->shope_name }}
                                    </h5>
                                </a>
                                <p class="text-sm font-bold text-green-400">Discount: %{{ $shop->discount_amount }}</p>
                                <p class="text-sm font-bold text-gray-600">Area: {{ $shop->area }}</p>
                            </div>

                        </div>
                    </div>
                @empty
                @endforelse



                <div class="relative group bg-gray-100 transition hover:z-[1] hover:shadow-2xl lg:hidden xl:block">
                    <div
                        class="relative p-8 space-y-8 transition duration-300 border-dashed rounded-lg group-hover:bg-white group-hover:border group-hover:scale-90">
                        <img width="50" height="50" src="https://img.icons8.com/ios-glyphs/90/shop.png"
                            alt="shop" />

                        <div class="space-y-2">
                            <h5 class="text-xl font-medium text-gray-800 transition group-hover:text-green-400">Find More
                                Shop's</h5>

                        </div>
                        <a href="{{ route('shops') }}"
                            class="flex items-center justify-between group-hover:text-green-400">
                            <span class="text-sm font-bold">View More</span>
                            <span
                                class="text-2xl transition duration-300 -translate-x-4 opacity-0 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-16 overflow-hidden bg-gray-50">
        <div class="container px-6 m-auto space-y-8 text-gray-500 md:px-12">
            <div>
                <span class="text-lg font-semibold text-gray-600">Discount Services</span>
                <h2 class="mt-4 text-2xl font-bold text-gray-900 md:text-4xl">Best Discount Services</h2>
            </div>
            <div
                class="grid mt-16 overflow-hidden border divide-x divide-y rounded-xl sm:grid-cols-2 lg:divide-y-0 lg:grid-cols-3 xl:grid-cols-4">

                @forelse ($discountServices as $service)
                    <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                        <div class="relative p-8 space-y-8">
                            <img src="{{ Storage::url($service->image) }}" alt="burger illustration">

                            <div class="space-y-2">
                                <h5 class="text-xl font-medium text-gray-800 transition group-hover:text-yellow-600">
                                    {{ $service->service_name }}
                                </h5>
                                <p class="text-sm font-bold text-green-400">Discount: %{{ $service->discount_amount }}</p>
                                <p class="text-sm font-bold text-gray-600">Area: {{ $service->area }}</p>
                            </div>

                        </div>
                    </div>
                @empty
                @endforelse



                <div class="relative group bg-gray-100 transition hover:z-[1] hover:shadow-2xl lg:hidden xl:block">
                    <div
                        class="relative p-8 space-y-8 transition duration-300 border-dashed rounded-lg group-hover:bg-white group-hover:border group-hover:scale-90">
                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/service.png"
                            alt="service" />

                        <div class="space-y-2">
                            <h5 class="text-xl font-medium text-gray-800 transition group-hover:text-green-400">Find More
                                Service's</h5>

                        </div>
                        <a href="{{ route('services') }}"
                            class="flex items-center justify-between group-hover:text-green-400">
                            <span class="text-sm font-bold">View More</span>
                            <span
                                class="text-2xl transition duration-300 -translate-x-4 opacity-0 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

@endsection
