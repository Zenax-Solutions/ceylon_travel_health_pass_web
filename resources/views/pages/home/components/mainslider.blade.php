<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<style>
    .swiper-slide {
        position: relative;
    }

    /* Swiper Navigation Buttons */
    .swiper-button-next,
    .swiper-button-prev {
        color: #fff;
        width: 50px;
        height: 50px;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 20px;
    }

    .swiper-pagination-bullets {
        bottom: 10px;
    }

    .swiper-pagination-bullet {
        background: #fff;
    }
</style>



<div id="default-carousel" class="relative w-full">
    <div class="relative overflow-hidden">
        <!-- Swiper -->
        <div class="swiper-container">
            <div class="swiper-wrapper" style="z-index: -1;">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="overlay">
                        <img src="https://images.unsplash.com/photo-1651264042792-78a19a6abbf1?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="slide-images absolute block object-cover object-center w-full h-lvh md:h-lvh lg:h-lvh"
                            alt="...">
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="overlay">
                        <img src="https://images.unsplash.com/photo-1711100360031-24aaccbcd408?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="slide-images absolute block w-full object-cover object-center h-lvh md:h-lvh lg:h-lvh"
                            alt="...">
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="overlay">
                        <img src="https://images.unsplash.com/photo-1701544872167-7f5ee73cb435?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="slide-images absolute block w-full object-cover object-center h-lvh md:h-lvh lg:h-lvh"
                            alt="...">
                    </div>
                </div>
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Navigation Buttons -->
            <!-- Uncomment these lines to add navigation buttons
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            -->
        </div>

        <div class="container flex flex-col mx-auto" style="padding: 10px;">
            <div class="grid w-full grid-cols-1 my-auto mt-12 mb-8 md:grid-cols-2">
                <div class="flex flex-col justify-center text-center md:text-left lg:text-left lg:text-start">
                    <h1 class="mb-4 text-5xl font-extrabold leading-tight lg:text-7xl text-white">Ceylon Travel Pass
                    </h1>
                    <p class="text-base font-normal leading-7 lg:w-3/4 text-white">
                    <div class="p-6 mb-8 md:pl-0 lg:pl-0 space-y-4">
                        <div
                            class="relative w-full grid justify-items-center md:justify-items-start md:flex md:items-center md:gap-7">
                            <img width="48" height="48" src="https://img.icons8.com/pulsar-gradient/48/skip.png"
                                alt="skip" />
                            <div>
                                <p class="max-w-screen-sm mt-2 text-sm font-bold text-white">Skip the Lines with One
                                    Digital Pass – No Waiting at Ticket Counters. </p>
                            </div>
                        </div>
                        <div
                            class="relative w-full grid justify-items-center md:justify-items-start md:justify-items-start md:flex md:items-center md:gap-7">
                            <img width="48" height="48"
                                src="https://img.icons8.com/pulsar-gradient/48/roadmap.png" alt="roadmap" />
                            <div>
                                <p class="max-w-screen-sm mt-2 text-sm font-bold text-white">Plan your trip from our
                                    huge selection of attractions.</p>
                            </div>
                        </div>
                        <div
                            class="relative w-full grid justify-items-center md:justify-items-start md:justify-items-start md:flex md:items-center md:gap-7">
                            <img width="48" height="48" src="https://img.icons8.com/pulsar-gradient/48/pass.png"
                                alt="pass" />
                            <div>
                                <p class="max-w-screen-sm mt-2 text-sm font-bold text-white">Download your digital
                                    pass and start exploring. There are no additional entry fees to pay. </p>
                            </div>
                        </div>
                    </div>
                    </p>
                    <div class="flex justify-center md:justify-start lg:justify-start pb-8">
                        <a href="#buynow"
                            class="flex w-40 select-none items-center gap-3 rounded-lg bg-green-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button" data-ripple-light="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z">
                                </path>
                            </svg>
                            Buy Now
                        </a>
                    </div>
                </div>
                <div class="items-center justify-end md:flex">
                    <img class="rounded-md w-100 md:w-96" src="{{ asset('images/mobile.png') }}" alt="header image">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                disableOnInteraction: false,
            },
            speed: 2000,
            spaceBetween: 30,
            effect: "fade",
            fadeEffect: {
                crossFade: true
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
