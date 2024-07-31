@extends('layouts.app')
@section('content')

<!-- Live Chat -->
@include('pages.home.components.chatwidget')

@include('pages.home.components.mainslider')




<section class="text-gray-600 bg-gray-100 body-font py-16 ">
    <div class="container  m-auto space-y-8 text-gray-500 md:px-12">
        <div class="px-6">
            <span class="text-lg font-semibold text-gray-600">Exclusive Attractions</span>
            <h2 class="mt-4 text-2xl font-bold text-gray-900 md:text-4xl">Select Your Dream Destinations</h2>
        </div>
        <div class="flex flex-wrap" id="buynow">
            <!--start here-->
            @forelse($packages as $key => $package)
            <div class="p-4 md:w-1/2 lg:w-1/3">

                <div class="relative flex flex-col text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">

                    <!-- <div class="p-6 ">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-xl font-black text-gray-800 md:text-xl">
                                    {{ $key + 1 }}
                                    </h3>
                                </div>
                            </div> -->

                    <div>
                        <div id="default-carousel" class="relative w-full " data-carousel="slide">
                            <!-- Carousel wrapper -->
                            <div class="relative h-56 overflow-hidden rounded-xl">

                                @if (isset($package->gallery))
                                @forelse($package->gallery as $image)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <img src="{{ Storage::url($image) }}" class="absolute block object-cover  w-full h-64 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                                </div>
                                @empty
                                @endforelse
                                @endif

                            </div>
                            <!-- Slider indicators -->
                            <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2 rtl:space-x-reverse">

                                @if (isset($package->gallery))
                                @forelse($package->gallery as $key => $imageDots)
                                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" data-carousel-slide-to="{{ $key }}"></button>
                                @empty
                                @endforelse
                                @endif

                            </div>
                            <!-- Slider controls -->
                            <button type="button" class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer start-0 group focus:outline-none" data-carousel-prev>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                                    </svg>
                                    <span class="sr-only">Previous</span>
                                </span>
                            </button>
                            <button type="button" class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer end-0 group focus:outline-none" data-carousel-next>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <span class="sr-only">Next</span>
                                </span>
                            </button>
                        </div>


                    </div>
                    <div class="p-6 ">
                        <div class="flex items-center justify-between mb-2">

                            <h3 class="text-xl font-black text-green-400 md:text-3xl">
                                {{ $package->main_title }}
                            </h3>

                            <p <span class="text-5xl font-bold leading-none align-baseline">
                                {{ env('CURRENCY', '$') . number_format($package->price) }}</span>
                            </p>
                        </div>
                        <div class="flex flex-wrap flex-col  justify-between mb-2">
                            <div class="package-info" style="max-height: 360px !important; min-height: 360px !important;">
                                @if(!empty($package->travel_info))
                                <p class="text-base text-gray-500 md:text-lg">
                                <h1 class="text-lg font-black text-gray-800 md:text-2xl">Travel</h1>
                                {!! $package->travel_info !!}
                                </p>
                                @endif
                                @if(!empty($package->health_info))
                                <p class="text-base text-gray-500 md:text-lg mt-4">
                                <h1 class="text-lg font-black text-gray-800 md:text-2xl">Health</h1>
                                {!! $package->health_info !!}
                                </p>
                                @endif
                            </div>

                            <div>
                                <div class="mt-4">
                                    <h1 class="text-lg font-black text-gray-800 md:text-2xl">Destinations</h1>
                                    <div class="items-center pt-4 pb-4" style="gap: 10px; display: grid;">

                                        @forelse($destinations->shuffle()->take(5) as $destination)
                                        <div class="flex" style="gap: 10px;align-items: center;">
                                            <img style="object-fit: cover" class="transform border border-gray-200 rounded-md w-14 h-14 hover:scale-125" src="{{ Storage::url($destination->image) }}" />
                                            <p class="font-light font-black text-gray-800">
                                                {{ $destination->destination }}
                                            </p>
                                        </div>
                                        @empty
                                        @endforelse

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="p-6 pt-0">
                        @include('pages.home.components.package-info')
                    </div>

                </div>

            </div>
            @empty
            @endforelse

            <!--End here-->
        </div>
    </div>
</section>
<div class="py-16 overflow-hidden">
    <div class="container px-6 m-auto space-y-8 text-gray-500 md:px-12">
        <div>
            <span class="text-lg font-semibold text-gray-600">Discount Shops</span>
            <h2 class="mt-4 text-2xl font-bold text-gray-900 md:text-4xl">Top Savings Spots to Explore</h2>
        </div>
        <div class="grid mt-16 overflow-hidden border divide-x divide-y rounded-xl sm:grid-cols-2 lg:divide-y-0 lg:grid-cols-3 xl:grid-cols-4">

            @forelse($discountShops as $shop)
            <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                <div class="relative p-8 space-y-8 text-center">
                    <div style="height: 200px; display:flex; justify-content:center">
                        <img style="object-fit: contain;" src="{{ Storage::url($shop->image) }}" alt="burger illustration">
                    </div>


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
                <div class="relative p-8 space-y-8 transition duration-300 border-dashed rounded-lg group-hover:bg-white group-hover:border group-hover:scale-90">

                    <div class=" flex justify-center md:justify-start lg:justify-start">
                        <img width="50" height="50" src="https://img.icons8.com/ios-glyphs/90/shop.png" alt="shop" />

                    </div>

                    <div class="space-y-2 text-center md:text-left lg:text-left">
                        <h5 class="text-xl font-medium text-gray-800 transition group-hover:text-green-400">Find More
                            Shop's</h5>

                    </div>
                    <a href="{{ route('shops') }}" class="flex items-center group-hover:text-green-400 justify-center md:justify-start lg:justify-start">
                        <span class="text-sm font-bold">View More</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-16 overflow-hidden ">
    <div class="container px-6 m-auto space-y-8 text-gray-500 md:px-12">
        <div>
            <span class="text-lg font-semibold text-gray-600">Discount Services</span>
            <h2 class="mt-4 text-2xl font-bold text-gray-900 md:text-4xl">Top Savings Services</h2>
        </div>
        <div class="grid mt-16 overflow-hidden border divide-x divide-y rounded-xl sm:grid-cols-2 lg:divide-y-0 lg:grid-cols-3 xl:grid-cols-4">

            @forelse($discountServices as $service)
            <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                <div class="relative p-8 space-y-8 text-center">

                    <div style="height: 200px; display:flex; justify-content:center">
                        <img style="object-fit: contain;" src="{{ Storage::url($service->image) }}" alt="burger illustration">
                    </div>
                    <div class="space-y-2">
                        <a href="{{ $service->location }}" target="_blank" rel="noopener noreferrer">
                            <h5 class="text-xl font-medium text-gray-800 transition group-hover:text-yellow-600">
                                {{ $service->service_name }}
                            </h5>
                        </a>
                        <p class="text-sm font-bold text-green-400">Discount: %{{ $service->discount_amount }}</p>
                        <p class="text-sm font-bold text-gray-600">Area: {{ $service->area }}</p>
                    </div>

                </div>
            </div>
            @empty
            @endforelse



            <div class="relative group bg-gray-100 transition hover:z-[1] hover:shadow-2xl lg:hidden xl:block">
                <div class="relative p-8 space-y-8 transition duration-300 border-dashed rounded-lg group-hover:bg-white group-hover:border group-hover:scale-90">

                    <div class="flex justify-center md:justify-start lg:justify-start">
                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/service.png" alt="service" />
                    </div>


                    <div class="space-y-2 text-center md:text-left lg:text-left">
                        <h5 class="text-xl font-medium text-gray-800 transition  group-hover:text-green-400">Find More
                            Service's</h5>

                    </div>
                    <a href="{{ route('services') }}" class="flex items-center group-hover:text-green-400 justify-center md:justify-start lg:justify-start">
                        <span class="text-sm font-bold">View More</span>

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($blogs->count() > 0)
<div class="py-16 overflow-hidden ">
    <div class="container px-6 m-auto space-y-8 text-gray-500 md:px-12">
        <div>
            <h2 class="mt-4 text-2xl font-bold text-gray-900 md:text-4xl">Our Blogs</h2>
        </div>


        <section class="mt-6 grid md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8">

            @forelse($blogs as $blog)
            <article class="bg-white group relative rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transform duration-200">
                <div class="relative w-full h-80 md:h-64 lg:h-44">
                    <img src="{{ Storage::url($blog->image) }}" alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." class="w-full h-full object-center object-cover">
                </div>
                <div class="px-3 py-4">
                    <h3 class="text-lg font-bold text-white pb-2">
                        <a class="text-green-400 rounded-lg" href="{{ route('blogs.page', ['slug' => $blog->slug]) }}">
                            {{ $blog->title }}
                        </a>
                    </h3>
                    <p class="text-sm font-bold text-black group-hover:text-black">
                        {{ Str::limit($blog->seo_description, 100) }}
                    </p>
                </div>
            </article>

            @empty
            @endforelse

        </section>




    </div>
</div>
@endif


@if ($reviews->count() > 0)
@include('pages.home.components.testimonials')
@endif





<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

@endsection