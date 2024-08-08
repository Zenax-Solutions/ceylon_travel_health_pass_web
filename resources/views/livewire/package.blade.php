<div class="pt-0 md:pt-12 lg:pt-0">
    <!-- component -->
    <!-- This is an example component -->
    <div>
        <style>
            [x-cloak] {
                display: none;
            }

            [type="checkbox"] {
                box-sizing: border-box;
                padding: 0;
            }

            .form-checkbox,
            .form-radio {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                display: inline-block;
                vertical-align: middle;
                background-origin: border-box;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                flex-shrink: 0;
                color: currentColor;
                background-color: #fff;
                border-color: #e2e8f0;
                border-width: 1px;
                height: 1.4em;
                width: 1.4em;
            }

            .form-checkbox {
                border-radius: 0.25rem;
            }

            .form-radio {
                border-radius: 50%;
            }

            .form-checkbox:checked {
                background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
                border-color: transparent;
                background-color: currentColor;
                background-size: 100% 100%;
                background-position: center;
                background-repeat: no-repeat;
            }

            .form-radio:checked {
                background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
                border-color: transparent;
                background-color: currentColor;
                background-size: 100% 100%;
                background-position: center;
                background-repeat: no-repeat;
            }
        </style>

        <div x-data="app()" x-cloak>

            <div class="max-w-3xl px-4 py-10 mx-auto">

                <div x-show.transition="step === 'complete'">
                    <div class="flex items-center justify-between p-10 bg-white rounded-lg shadow">
                        <div>
                            <svg class="w-20 h-20 mx-auto mb-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>

                            <h2 class="mb-4 text-2xl font-bold text-center text-gray-800">Registration Success</h2>

                            <div class="mb-8 text-gray-600">
                                Thank you. We have sent you an email to demo@demo.test. Please click the link in the
                                message to activate your account.
                            </div>

                            <button @click="step = 1" class="block w-40 px-5 py-2 mx-auto font-medium text-center text-gray-600 bg-white border rounded-lg shadow-sm focus:outline-none hover:bg-gray-100">Back
                                to home</button>
                        </div>
                    </div>
                </div>

                <div x-show.transition="step != 'complete'">
                    <!-- Top Navigation -->
                    <div class="py-4 border-b-2">
                        <div class="mb-1 text-xs font-bold leading-tight tracking-wide text-gray-500 uppercase" x-text="`Step: ${step} of 3`"></div>
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-1">
                                <div x-show="step === 1">
                                    <div class="text-lg font-bold leading-tight text-gray-700">Package Info</div>
                                </div>

                                <div x-show="step === 2">
                                    <div class="text-lg font-bold leading-tight text-gray-700">Select Your Destinations
                                    </div>
                                </div>

                                <div x-show="step === 3">
                                    <div class="text-lg font-bold leading-tight text-gray-700">Checkout
                                    </div>
                                </div>


                            </div>

                            <div class="flex items-center md:w-64">
                                <div class="w-full mr-2 bg-white rounded-full" style="background-color: #e3efc9">
                                    <div class="h-2 text-xs leading-none text-center text-white bg-green-500 rounded-full" :style="'width: ' + parseInt(step / 3 * 100) + '%'"></div>
                                </div>
                                <div class="w-10 text-xs font-bold text-gray-600" x-text="parseInt(step / 3 * 100) +'%'"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /Top Navigation -->

                    <!-- Step Content -->
                    <div class="py-10">
                        <div x-show.transition.in="step === 1">

                            <div>
                                <div id="default-carousel" class="relative z-0 w-full " data-carousel="slide">
                                    <!-- Carousel wrapper -->
                                    <div class="relative h-56 overflow-hidden rounded">

                                        @if (isset($package?->gallery))
                                        @forelse ($package->gallery as $image)
                                        <div class="hidden duration-700 ease-in-out rounded" data-carousel-item>
                                            <img src="{{ Storage::url($image) }}" class="absolute block object-cover  w-full h-64 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                                        </div>
                                        @empty
                                        @endforelse
                                        @endif

                                    </div>
                                    <!-- Slider indicators -->
                                    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2 rtl:space-x-reverse">

                                        @if (isset($package?->gallery))
                                        @forelse ($package?->gallery as $key => $imageDots)
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
                            <br>

                            <div>
                                <div class="flex items-center justify-between mb-2">

                                    <h3 style="font-size:30px" class="text-xl font-black text-gray-800 md:text-3xl">
                                        {{ $package?->main_title }}
                                    </h3>

                                    @if ($auth_agent != null)
                                    <p style="font-size: 30px" class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900">
                                        {{ config('app.currency') . $package?->price - $discount }}
                                    </p>
                                    @else
                                    <p style="font-size: 30px" class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900">
                                        {{ config('app.currency') . $package?->price }}
                                    </p>
                                    @endif


                                </div>
                                <p class="text-base text-gray-500 md:text-lg">
                                <h1 class="text-lg font-black text-gray-800 md:text-2xl">Travel</h1>
                                {!! $package?->travel_info !!}
                                </p>
                                <p class="text-base text-gray-500 md:text-lg">
                                <h1 class="text-lg font-black text-gray-800 md:text-2xl">Health</h1>
                                {!! $package?->health_info !!}
                                </p>
                            </div>

                            @if (!empty($package->discount_shop_list) || !empty($package->discount_service_list))
                            <div class="w-full px-2 py-4 mt-4 bg-white border border-gray-200 shadow-md rounded-xl shadow-gray-100">
                                <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
                                    <div>Discount Shops & Services</div>

                                </div>
                                <div class="mt-4">
                                    <div class="flex max-h-[400px] w-full flex-col overflow-y-scroll">

                                        @if (!empty($package->discount_shop_list))

                                        <h1 class="my-2 px-4 text-[15px] text-green-400 text-bolder font-bold">
                                            Shop's
                                            List</h1>

                                        @forelse ($package->discount_shop_list as $shopId)
                                        @php
                                        $shop = \App\Models\DiscountShop::find($shopId);
                                        @endphp
                                        <div class="group flex items-center gap-x-5 rounded-md px-2.5 py-2 transition-all duration-75 hover:bg-green-100">
                                            <div class="flex items-center w-12 h-12 text-black bg-gray-200 rounded-lg group-hover:bg-green-200">
                                                <img src="{{ Storage::url($shop?->image) }}" alt="">
                                            </div>
                                            <div class="flex flex-col items-start justify-between font-light text-gray-600">
                                                <p class="text-[15px] text-black font-bold">
                                                    {{ $shop?->shope_name }}
                                                </p>
                                                <span class="text-xs font-light text-black">Area :
                                                    {{ $shop?->area }}</span>

                                                <span class="text-xs font-bold text-black">
                                                    @if (is_numeric($shop?->discount_amount))
                                                    Discount: %{{ $shop?->discount_amount }}
                                                    @else
                                                    Discount: {{ $shop?->discount_amount }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        @empty
                                        <h3 class="my-2 px-4 text-[15px] text-red-400">empty list 😢</h3>
                                        @endforelse
                                        @endif



                                        @if (!empty($package->discount_service_list))
                                        <h3 class="my-2 px-4 text-[15px] text-green-400 font-bold">Service's
                                            List
                                        </h3>
                                        @forelse ($package->discount_service_list as $serviceId)
                                        @php
                                        $service = \App\Models\DiscountService::find($serviceId);
                                        @endphp
                                        <div class="group flex items-center gap-x-5 rounded-md px-2.5 py-2 transition-all duration-75 hover:bg-green-100">
                                            <div class="flex items-center w-12 h-12 text-black bg-gray-200 rounded-lg group-hover:bg-green-200">
                                                <img src="{{ Storage::url($service?->image) }}" alt="">
                                            </div>
                                            <div class="flex flex-col items-start justify-between font-light text-gray-600">
                                                <p class="text-[15px] font-bold text-black">
                                                    {{ $service?->service_name }}
                                                </p>
                                                <span class="text-xs font-light text-black">Area :
                                                    {{ $service?->area }}</span>

                                                <span class="text-xs font-bold text-black">
                                                    @if (is_numeric($service?->discount_amount))
                                                    Discount: %{{ $service?->discount_amount }}
                                                    @else
                                                    Discount: {{ $service?->discount_amount }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        @empty
                                        <h3 class="my-2 px-4 text-[15px] text-red-400">empty list 😢</h3>
                                        @endforelse
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @endif



                        </div>

                        <div x-show.transition.in="step === 2">

                            <div wire:ignore class="w-full px-2 py-4 bg-white border border-gray-200 shadow-md rounded-xl shadow-gray-100">
                                <div class="font-bold text-gray-800 md:flex">
                                    <div class="flex w-full space-x-3 md:w-1/2">
                                        <div class="w-1/2">
                                            <h2 class="text-gray-500">Destinations Count:</h2>
                                            <div wire:transition>
                                                <p class="text-xl text-green-400 text-normal">
                                                    <span id="selectedDestinationsCount"></span>
                                                </p>
                                            </div>
                                        </div>


                                        @if ($auth_agent != null)
                                        <div class="w-1/2">
                                            <h2 class="text-gray-500">Package Price:</h2>
                                            <p wire:transition class="text-xl text-green-400 text-normal">
                                                {{ config('app.currency') . $package->price - $discount }}
                                            </p>
                                        </div>
                                        @else
                                        <div class="w-1/2">
                                            <h2 class="text-gray-500">Package Price:</h2>
                                            <p wire:transition class="text-xl text-green-400 text-normal">
                                                {{ config('app.currency') . $package->price }}
                                            </p>
                                        </div>
                                        @endif


                                    </div>
                                    <div class="flex w-full space-x-3 md:w-1/2">
                                        <div class="w-1/2">
                                            <h2 class="text-gray-500">Total Price:</h2>
                                            <p wire:transition><span id="totalPrice" class="text-xl text-green-400 text-normal"></span>
                                            </p>
                                        </div>
                                        <div class="w-1/2">
                                            <h2 class="text-gray-500">Grand Total:</h2>
                                            <p wire:transition><span id="grandTotal" class="text-xl text-red-400 text-normal"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="w-full px-2 py-4 bg-white border border-gray-200 shadow-md rounded-xl shadow-gray-100">
                                <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
                                    <div>Destination's List</div>

                                </div>
                                <div class="mt-4">
                                    <div class="flex max-h-[400px] w-full flex-col overflow-y-scroll">

                                        @forelse ($citys as $city)
                                        @php $firstCity = true; @endphp
                                        @forelse ($city->destinations as $destination)
                                        @if ($firstCity)
                                        <div class="px-2 text-base font-medium text-black ">
                                            {{ $city->name }}
                                        </div>
                                        @php $firstCity = false; @endphp
                                        @endif
                                        <div class="group flex items-center gap-x-5 rounded-md px-2.5 py-2 transition-all duration-75 hover:bg-green-100">


                                            @php
                                            $ticketCount = $destination
                                            ->destinationStock()
                                            ->orderBy('id', 'desc')
                                            ->first();

                                            @endphp

                                            @if ($ticketCount?->selling_ticket_count < $ticketCount?->ticket_stock_count)

                                                <div class="inline-flex items-center">
                                                    <label class="relative flex items-center p-3 rounded-full cursor-pointer" for="checkbox-{{ $destination->id }}" data-ripple-dark="true">
                                                        <input type="checkbox" class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:bg-pink-500 checked:before:bg-pink-500 hover:before:opacity-10" id="checkbox-{{ $destination->id }}" onchange="calculateTotal()" @if ($auth_customer !=null) @if ($auth_customer->region_type == 'south_asian')

                                                        @if($destination->is_wildlife)
                                                        data-wildlife-price="{{ $destination->south_asian_price + $destination->south_asian_price * (config('app.wild_vat_rate') / 100) }}"
                                                        data-wildlife-child-price="{{ $destination->child_south_asian_price + $destination->child_south_asian_price * (config('app.wild_vat_rate') / 100) }}"
                                                        @else
                                                        data-price="{{ $destination->south_asian_price }}"
                                                        data-child-price="{{ $destination->child_south_asian_price }}"
                                                        @endif
                                                        @elseif ($auth_customer->region_type == 'non_south_asian')

                                                        @if($destination->is_wildlife)
                                                        data-wildlife-price="{{ $destination->non_south_asian_price + $destination->non_south_asian_price * (config('app.wild_vat_rate') / 100) }}"
                                                        data-wildlife-child-price="{{ $destination->child_non_south_asian_price + $destination->child_non_south_asian_price * (config('app.wild_vat_rate') / 100)}}"
                                                        @else
                                                        data-price="{{ $destination->non_south_asian_price }}"
                                                        data-child-price="{{ $destination->child_non_south_asian_price }}"
                                                        @endif
                                                        @endif
                                                        @elseif ($auth_agent != null)

                                                        @if($destination->is_wildlife)
                                                        data-wildlife-price="{{ $destination->non_south_asian_price + $destination->non_south_asian_price * (config('app.wild_vat_rate') / 100)}}"
                                                        data-wildlife-child-price="{{ $destination->child_non_south_asian_price + $destination->child_non_south_asian_price * ( config('app.wild_vat_rate')/ 100)}}"
                                                        @else
                                                        data-price="{{ $destination->non_south_asian_price }}"
                                                        data-child-price="{{ $destination->child_non_south_asian_price }}"
                                                        @endif
                                                        @endif
                                                        />


                                                        <div class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </div>
                                                    </label>
                                                </div>
                                                @endif

                                                <div class="flex items-center text-black bg-gray-200 rounded-lg group-hover:bg-green-200">
                                                    <img style="width: 120px; object-fit: cover; height:80px; border-radius: 8px;" src="{{ Storage::url($destination->image) }}" alt="" srcset="">
                                                </div>
                                                <div class="flex flex-col items-start justify-between font-light text-gray-600">
                                                    <p class="text-[15px] text-bold">
                                                        {{ $destination->destination }}
                                                    </p>
                                                    <span class="text-xs font-light text-gray-400">City :
                                                        {{ $destination->city->name }}</span>
                                                    <p class="text-[15px] text-light text-green-500">

                                                        @php
                                                        $price = null;
                                                        $childPrice = null;

                                                        if ($auth_customer) {
                                                        if ($auth_customer->region_type === 'south_asian') {

                                                        if($destination->is_wildlife)
                                                        {
                                                        $price = $destination->south_asian_price + $destination->south_asian_price * (config('app.wild_vat_rate') / 100);
                                                        $childPrice = $destination->child_south_asian_price + $destination->child_south_asian_price * (config('app.wild_vat_rate') / 100);
                                                        }
                                                        else {
                                                        $price = $destination->south_asian_price;
                                                        $childPrice = $destination->child_south_asian_price;
                                                        }


                                                        } elseif ($auth_customer->region_type === 'non_south_asian') {

                                                        if($destination->is_wildlife)
                                                        {
                                                        $price = $destination->non_south_asian_price + $destination->non_south_asian_price * (config('app.wild_vat_rate') / 100);
                                                        $childPrice = $destination->child_non_south_asian_price + $destination->child_non_south_asian_price * (config('app.wild_vat_rate') / 100);
                                                        }
                                                        else
                                                        {
                                                        $price = $destination->non_south_asian_price;
                                                        $childPrice = $destination->child_non_south_asian_price;

                                                        }

                                                        }
                                                        } elseif ($auth_agent)
                                                        {
                                                        if($destination->is_wildlife)
                                                        {
                                                        $price = $destination->non_south_asian_price + $destination->non_south_asian_price * (config('app.wild_vat_rate') / 100);
                                                        $childPrice = $destination->child_non_south_asian_price + $destination->child_non_south_asian_price * (config('app.wild_vat_rate') / 100);
                                                        }
                                                        else
                                                        {
                                                        $price = $destination->non_south_asian_price;
                                                        $childPrice = $destination->child_non_south_asian_price;

                                                        }
                                                        }
                                                        @endphp

                                                        @if ($price !== null)
                                                        Adult:
                                                        {{ config('app.currency') . $price }}
                                                        <br>
                                                        @if ($childPrice > 0)
                                                        Children:
                                                        {{ config('app.currency') . $childPrice }}
                                                        @endif
                                                        @endif
                                                    </p>
                                                    @if ($ticketCount?->selling_ticket_count == $ticketCount?->ticket_stock_count)
                                                    <div class="center relative inline-block select-none whitespace-nowrap rounded-lg bg-red-500 py-2 px-3.5 align-baseline font-sans text-xs font-bold  leading-none text-white">
                                                        <div class="mt-px">not available</div>
                                                    </div>
                                                    @endif
                                                    @if ($destination->is_wildlife)
                                                    <div class="center mt-2 relative inline-block select-none whitespace-nowrap rounded-lg bg-green-500 py-2 px-3.5 align-baseline font-sans text-xs font-bold  leading-none text-white">
                                                        <div class="mt-px">wildlife 🐘🌲</div>
                                                    </div>
                                                    @endif
                                                </div>
                                        </div>
                                        @empty
                                        @endforelse
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div x-show.transition.in="step === 3">

                            <div x-show="$wire.destinationsCount < 1">
                                <div class="w-full mb-3 text-sm font-bold text-white bg-red-500 rounded-md shadow-lg" role="alert">
                                    <div class="flex p-4">
                                        Please select your destinations !

                                        <div class="ml-auto">
                                            <button type="button" class="inline-flex flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-800 focus:ring-red-500 transition-all text-sm dark:focus:ring-offset-red-500 dark:focus:ring-red-700">
                                                <span class="sr-only">Close</span>
                                                <svg class="w-3.5 h-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z" fill="currentColor" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full p-4 mx-auto bg-gray-500 md:p-8">

                                <form>
                                    @if ($auth_agent == null)
                                    <div class="grid gap-6 mb-6 lg:grid-cols-2">
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First
                                                name</label>
                                            <input type="text" value="{{ $auth_customer?->first_name }}" class="bg-gray-50 border font-bold border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required readonly>
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last
                                                name</label>
                                            <input type="text" class="bg-gray-50 border font-bold border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $auth_customer?->last_name }}" required readonly>
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                            <input type="email" class="bg-gray-50 border font-bold border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $auth_customer?->email }}" readonly required>
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Region</label>
                                            <input type="text" class="bg-gray-50 border border-gray-300 font-bold text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ str_replace('_', ' ', $auth_customer?->region_type) == 'south asian' ? 'SAARC Nations' : 'Non-SAARC Nations' }}" readonly required>
                                        </div>

                                    </div>

                                    @else

                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Please Select The Region Type</label>
                                        <select wire:model="regionality" required class="bg-gray-50 border font-bold border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="">Select One</option>
                                            <option value="south_asian">SAARC Nations ( South Asian )</option>
                                            <option value="non_south_asian">Non-SAARC Nations ( Non South Asian )</option>
                                        </select>
                                        <div class="pt-2">
                                            @error('regionality')
                                            <span class="pt-2 font-bold text-red-400 error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    @endif

                                    <hr>
                                    <div class="flex items-center justify-center pt-4">

                                        <div class="w-full mx-auto">


                                            <div class="mb-5" x-data="{ adultCount: $wire.entangle('adult_count').live, childrenCount: $wire.entangle('children_count').live }">
                                                <label for="adult" class="block mb-3 text-base font-medium text-white">
                                                    Adult Count
                                                </label>
                                                <input type="number" min="1" x-model="adultCount" id="adultCountInput" required class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                                @error('adult_count')
                                                <span class="pt-2 font-bold text-red-400 error">{{ $message }}</span>
                                                @enderror

                                                @if ($package?->child_price == 1)
                                                <label for="children" class="block mt-3 mb-3 text-base font-medium text-white">
                                                    Children Count
                                                </label>
                                                <input type="number" min="0" x-model="childrenCount" id="childrenCountInput"  class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                                @error('children_count')
                                                <span class="pt-2 font-bold text-red-400 error">{{ $message }}</span>
                                                @enderror
                                                @endif

                                            </div>


                                            <div x-data="{ toggal: $wire.entangle('esimOption').live }">

                                                {{-- E-sim Section --}}

                                                {{-- <button x-on:click="toggal = ! toggal" type="button"
                                                    class="middle  none center rounded-lg bg-pink-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                    data-ripple-light="true">
                                                    E-Sim
                                                </button>




                                                <div x-show="toggal" class="mt-4" x-transition>
                                                    <label class="block mb-2 text-sm font-medium text-white">
                                                        E-Sim Count
                                                    </label>
                                                    <input type="number" min="1" wire:model.blur='esimCount'
                                                        class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                                    @error('esimCount')
                                                        <span
                                                            class="pt-2 font-bold text-red-400 error">{{ $message }}</span>
                                                @enderror

                                                <label class="block mt-2 mb-2 text-sm font-medium text-white">Select
                                                    E-Sim Provider</label>
                                                <select wire:model.blur="esimServiceProvider" class="text-black text-sm rounded-lg font-bold block w-full p-2.5">
                                                    <option value="null">select service provider
                                                    </option>
                                                    @forelse ($esimServiceProviderList as $list)
                                                    <option value="{{ $list->id }}">
                                                        {{ $list->service_name }}
                                                    </option>
                                                    @empty
                                                    @endforelse

                                                </select>
                                                @error('esimServiceProvider')
                                                <span class="pt-2 font-bold text-red-400 error">{{ $message }}</span>
                                                @enderror


                                                <div>
                                                    @for ($i = 0; $i < $esimCount; $i++) <div class="w-full pt-4 pb-4">
                                                        <div class="relative grid w-full grid-cols-1 bg-gray-100 border border-gray-300 rounded-lg md:grid-cols-3">
                                                            <div class="flex flex-col items-center justify-center p-4 bg-gray-200 border-0 border-r border-gray-300 rounded-l-lg ">
                                                                <label class="inline-flex items-center px-2 py-2 my-2 text-xs font-semibold tracking-widest uppercase transition duration-150 ease-in-out bg-gray-900 border border-transparent rounded-md shadow-md cursor-pointer hover:opacity-80 text-gray-50 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25" for="passportImages.{{ $i }}">

                                                                    Upload Passport
                                                                    <input id="passportImages.{{ $i }}" wire:model.live="passportImages.{{ $i }}" accept="image/*" class="hidden text-sm cursor-pointer w-36" type="file">
                                                                </label>
                                                                <button type="button" wire:click='removeEsim({{ $i }})' class='inline-flex items-center px-2 py-2 my-2 text-xs font-semibold tracking-widest uppercase transition duration-150 ease-in-out bg-red-400 border border-transparent rounded-md shadow-md text-gray-50 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25'>
                                                                    Remove Passport
                                                                </button>
                                                            </div>
                                                            <div class="relative flex items-center justify-center order-first col-span-2 m-2 bg-center bg-no-repeat bg-cover border border-gray-400 border-dashed rounded-lg md:order-last h-28 md:h-auto bg-origin-padding">

                                                                @if ($passportImages && isset($passportImages[$i]))
                                                                <img style="width:200px" src="{{ $passportImages[$i]->temporaryUrl() }}">
                                                                @endif

                                                                <div wire:loading wire:target="passportImages.{{ $i }}">
                                                                    <div class="flex space-x-2 animate-pulse">
                                                                        <div class="w-3 h-3 bg-green-300 rounded-full">
                                                                        </div>
                                                                        <div class="w-3 h-3 bg-green-500 rounded-full">
                                                                        </div>
                                                                        <div class="w-3 h-3 bg-gray-700 rounded-full">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                @error('passportImages.' . $i)
                                                <span class="pt-2 font-bold text-red-400 error">{{ $message }}</span>
                                                @enderror
                                                @endfor
                                            </div>

                                        </div> --}}


                                        {{-- end-Esim Section --}}

                                        <hr class="mt-4">

                                        <div class="pt-6 text-gray-800">
                                            <div class="flex items-center w-full mb-3">
                                                <div class="flex-grow">
                                                    <span class="font-semibold text-white">Adult</span>
                                                </div>
                                                <div class="pl-3">
                                                    <span class="font-semibold text-white">
                                                        <span wire:ignore id="adult_count"></span>
                                                        <span>x</span>
                                                        {{ config('app.currency') . number_format($totalOfAdultPrice,2) }}</span>
                                                </div>
                                            </div>
                                            @if ($package?->child_price == 1)
                                            <div class="flex items-center w-full mb-3">
                                                <div class="flex-grow">
                                                    <span class="font-semibold text-white">Children</span>
                                                </div>
                                                <div class="pl-3">
                                                    <span class="font-semibold text-white">
                                                        <span wire:ignore id="children_count"></span>
                                                        <span>x</span>
                                                        {{ config('app.currency') . number_format($totalOfChildPrice,2) }}</span>
                                                </div>
                                            </div>
                                            @endif


                                            <div x-show="toggal" class="flex items-center w-full mb-3">
                                                <div class="flex-grow">
                                                    <span class="font-semibold text-white">Esim</span>
                                                </div>
                                                <div class="pl-3">
                                                    <span class="font-semibold text-white">
                                                        {{ $esimCount }}
                                                        <span>x</span>
                                                        {{ config('app.currency') . number_format($esimProviderPrice,2) }}</span>
                                                </div>
                                            </div>


                                            <hr>
                                            @if ($coupon_data != null)
                                            <div wire:transition class="flex items-center w-full mt-2 mb-3">
                                                <div class="flex-grow">
                                                    <span class="font-semibold text-white">Discount</span>
                                                </div>
                                                <div class="pl-3">
                                                    <span class="font-semibold text-white">

                                                        -
                                                        <span>{{ config('app.currency') . number_format($discount,2) }}</span>

                                                </div>
                                            </div>
                                            @endif

                                            @if ($auth_agent != null && $discount > 0)
                                            <div wire:transition class="flex items-center w-full mt-2 mb-3">
                                                <div class="flex-grow">
                                                    <span class="font-semibold text-white">Discount</span>
                                                </div>
                                                <div class="pl-3">
                                                    <span class="font-semibold text-white">

                                                        -
                                                        <span>{{ config('app.currency') . number_format($discount, 2) }}</span>

                                                </div>
                                            </div>
                                            @endif

                                           
                                            <div wire:ignore class="flex items-center w-full mt-2">
                                                <div class="flex-grow">
                                                    <span class="font-semibold text-white">Wildlife Service Charge</span>
                                                </div>

                                                <div class="pl-3">
                                                    <span class="text-lg font-semibold text-red-400" id="wildLifeServiceCharge"></span>
                                                </div>
                                            </div>
                                           

                                            <div class="flex items-center w-full">
                                                <div class="flex-grow">
                                                    <span class="font-semibold text-white">Total</span>
                                                </div>

                                                <div class="pl-3">
                                                    <span class="text-xl font-semibold text-red-400">{{ config('app.currency') . number_format($grandTotal,2) }}</span>
                                                </div>
                                            </div>

                                            @if ($auth_agent == null)
                                            <div class="pt-4 pb-12 w-72">
                                                <div class="relative h-10 w-full min-w-[200px]">
                                                    <div class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                                                        <i class="fas fa-heart" aria-hidden="true"></i>
                                                    </div>
                                                    <input wire:model.live='coupon_code' class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 !pr-9 font-sans text-lg font-bold text-white outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-500 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" placeholder=" " />
                                                    <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-bold leading-tight text-white transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-green-400 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-pink-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-pink-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-green-400">
                                                        Enter Coupon Code
                                                    </label>
                                                </div>
                                            </div>
                                            <p class="pt-2 pb-2 font-bold {{ $coupon_message['color'] }}">
                                                {{ $coupon_message['message'] }}

                                            </p>
                                            @endif




                                            @if ($coupon_data != null)
                                            <div wire:transition class="flex items-center justify-between w-full p-6 space-x-6 bg-white">
                                                <div class="flex-1 truncate">
                                                    <div class="flex items-center space-x-3">
                                                        <h3 class="text-sm font-medium text-green-400 truncate">
                                                            {{ $coupon_data[0]['name'] }}
                                                        </h3>
                                                        <span class="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-blue-600 ring-1 ring-inset ring-green-600/20">Tour
                                                            Agent</span>
                                                    </div>
                                                    <p class="mt-1 text-sm font-light text-gray-500 truncate">
                                                        {{ $coupon_data[0]['license_no'] }}
                                                    </p>
                                                </div>
                                                <img class="flex-shrink-0 w-10 h-10 bg-gray-300 rounded-full" src="{{ isset($coupon_data[0]['profile_image']) ? Storage::url($coupon_data[0]['profile_image']) : 'https://uxwing.com/wp-content/themes/uxwing/download/peoples-avatars/default-avatar-profile-picture-male-icon.png' }}" alt="">
                                            </div>
                                            @endif



                                        </div>

                                    </div>
                            </div>
                        </div>



                        </form>
                    </div>
                </div>

            </div>
            <!-- / Step Content -->
        </div>

    </div>

    <!-- Bottom Navigation -->
    <div wire:ignore class="fixed bottom-0 left-0 right-0 py-5 bg-green-500 shadow-md" x-show="step != 'complete'">
        <div class="max-w-3xl px-4 mx-auto">
            <div class="flex justify-between">
                <div class="w-1/2">
                    <button x-show="step > 1" @click="step--" class="w-32 px-5 py-2 font-medium text-center text-gray-600 bg-white border rounded-lg shadow-sm focus:outline-none hover:bg-gray-100">Previous</button>
                </div>

                <div class="w-full text-right">
                    <button x-show="step < 2" @click="step++" class="px-5 py-2 font-medium text-center text-white bg-blue-500 border border-transparent rounded-lg shadow-sm focus:outline-none hover:bg-blue-600">
                        Select Attractions
                    </button>

                    <button @click="step++" x-show="step == 2" id="checkOutBtn" wire:ignore.self  class="px-5 py-2 font-medium text-center text-white bg-black border border-transparent rounded-lg shadow-sm focus:outline-none hover:bg-white hover:text-green-500"></button>

                    <div x-show="$wire.destinationsCount >= 1" wire:loading.remove>
                        <button wire:click.prevent='submitBooking()' x-show="step === 3" wire:confirm="Are you sure to process the payment? 😊" class="px-5 py-2 font-medium text-center text-white bg-green-800 border border-transparent rounded-lg shadow-sm focus:outline-none hover:text-dark">
                            Pay-Online</button>
                    </div>

                    <div wire:loading wire:target="submitBooking()">
                        <div class="flex space-x-2 animate-pulse">
                            <div class="w-3 h-3 bg-gray-300 rounded-full">
                            </div>
                            <div class="w-3 h-3 bg-gray-500 rounded-full">
                            </div>
                            <div class="w-3 h-3 bg-gray-700 rounded-full">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>




<!-----------Model----------->


<div x-show="$wire.showModal" x-transition.duration.1500ms class="flex items-center justify-center" x-cloak>
    <!-- Background overlay -->
    <div class="fixed inset-0 flex items-center justify-center overflow-hidden bg-gray-500 bg-opacity-90 backdrop-blur">
        <!-- Modal -->
        <div class="fixed inset-0 z-10 flex items-center justify-center overflow-y-auto">
            <!-- Modal panel -->
            <div class="overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <!-- Modal content -->
                    <div>
                        <div class="w-full mb-3 text-sm font-bold text-white bg-red-500 rounded-md shadow-lg" role="alert">
                            <div class="flex p-4">
                                Please Login To Your Account !
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="w-full mt-3 text-center sm:mt-0 sm:text-left">
                            <form action="{{ route('customer.login.validate', ['redirect' => 'package']) }}" method="POST">
                                @csrf
                                <div class="flex flex-col w-full space-y-5">
                                    <input type="text" value="{{ old('email') }}" placeholder="Email" name="email" class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                                    @error('email')
                                    <span wire:transition class="font-light text-red-600 invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <input type="password" placeholder="Password" name="password" class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                                    @error('password')
                                    <span wire:transition class="font-light text-red-600 invalid-feedback">{{ $message }}</span>
                                    @enderror

                                    <p class="mt-4 text-sm font-bold text-black sm:mt-0">
                                        You do not have an account?
                                        <a href="{{ route('customer.register') }}" class="text-gray-700 underline">Register here</a>.
                                    </p>

                                    <button type="submit" class="flex items-center justify-center flex-none px-3 py-2 font-medium text-white bg-green-400 rounded-lg md:px-4 md:py-3">Login</button>

                                    <a href="/" class="flex items-center justify-center flex-none px-3 py-2 font-medium text-white bg-black rounded-lg md:px-4 md:py-3">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!------Script----->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

<script>
    function app() {
        return {
            step: 1,
        }
    }

    var selectedDestinationsCount = document.getElementById('selectedDestinationsCount');
    document.getElementById('checkOutBtn').innerText = '🛒 ( $' + 0 + ' ) ';
    selectedDestinationsCount.innerText = 0;

        var adultCount = parseFloat('{{ $adult_count }}') || 0;
        var childrenCount = parseFloat('{{ $children_count }}') || 0;
        var esimCount = parseFloat('{{ $esimCount }}') || 0;
        var esimProviderPrice = parseFloat('{{ $esimProviderPrice }}') || 0;
        var discount = parseFloat('{{ $discount }}') || 0;


         // Set the values to the number inputs
        document.getElementById('adultCountInput').value = adultCount;
        document.getElementById('childrenCountInput').value = childrenCount;

        document.getElementById('adult_count').innerText = adultCount;
        document.getElementById('children_count').innerText = childrenCount;

        // Optional: Add event listeners if you want to handle changes
        document.getElementById('adultCountInput').addEventListener('input', function() {
            adultCount = parseFloat(this.value);
            document.getElementById('adult_count').innerText = adultCount;
            calculateTotal();
        });

        document.getElementById('childrenCountInput').addEventListener('input', function() {
            childrenCount = parseFloat(this.value);
            document.getElementById('children_count').innerText = childrenCount;
            calculateTotal();
        });

     // Function to calculate total prices
     function calculateTotal() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        var selectedDestinationIds = [];
        var totalPrice = 0;
        var totalOfChildPrice = 0;
        var wildlifePrice = 0;
        var wildlifeChildPrice = 0;
        var wildlifeItemCount = 0; // Counter for wildlife items

        // Iterate over each checked checkbox and sum up the prices
        checkboxes.forEach(function(checkbox) {
            if (checkbox.hasAttribute('data-price')) {
                totalPrice += parseFloat(checkbox.getAttribute('data-price'));
                totalOfChildPrice += parseFloat(checkbox.getAttribute('data-child-price'));
            }

            if (checkbox.hasAttribute('data-wildlife-price')) {
                wildlifePrice += parseFloat(checkbox.getAttribute('data-wildlife-price'));
                wildlifeChildPrice += parseFloat(checkbox.getAttribute('data-wildlife-child-price'));
                wildlifeItemCount++; // Increment counter for wildlife items
            }

            selectedDestinationIds.push(checkbox.id.replace('checkbox-', ''));
        });

        selectedDestinationsCount.innerText = selectedDestinationIds.length;



        var packagePrice = parseFloat('{{ $package?->price }}');
        var grandTotal = packagePrice + totalPrice + wildlifePrice;

        // Display total prices
        document.getElementById('totalPrice').innerText = '$'+ (totalPrice + wildlifePrice).toFixed(2);
        document.getElementById('grandTotal').innerText = grandTotal;

        // Dispatch events to Livewire
        Livewire.dispatch('updatePrice', {
            totalOfAdultPrice:totalPrice + wildlifePrice,
            totalOfChildPrice: totalOfChildPrice +  wildlifeChildPrice,
            wildlifeItemCount: wildlifeItemCount
        });

        Livewire.dispatch('selectedDestinationIds', {
           selectedDestinationIds: selectedDestinationIds
        });

        // Perform client-side calculation for final total price
        calculateFinalPrice(totalPrice, totalOfChildPrice, wildlifePrice, wildlifeChildPrice, wildlifeItemCount);
    }

    // Function to calculate final price including packs and service charge
    function calculateFinalPrice(totalPrice, totalOfChildPrice, wildlifePrice, wildlifeChildPrice, wildlifeItemCount) {
   

        var packagePrice = parseFloat('{{ $package?->price }}');

        var adultPriceTotal = adultCount * (totalPrice + wildlifePrice);
        var childPriceTotal = childrenCount * (totalOfChildPrice + wildlifeChildPrice);
        var esimPriceTotal = esimCount * esimProviderPrice;

        var total = adultPriceTotal + childPriceTotal + esimPriceTotal - discount;

        if (wildlifeItemCount > 0) {
            total += calculatePacksPrice(adultCount, childrenCount);

            document.getElementById('wildLifeServiceCharge').innerText = '$' + calculatePacksPrice(adultCount, childrenCount).toFixed(2);

        }
        else
        {
            document.getElementById('wildLifeServiceCharge').innerText = '$0.00';
        }

        // Update the final total
        document.getElementById('grandTotal').innerText = '$' + (total + packagePrice).toFixed(2);
        document.getElementById('checkOutBtn').innerText = '🛒 ( $' + (total + packagePrice).toFixed(2) + ' ) ';

    }

    // Function to calculate packs price
    function calculatePacksPrice(adultCount, childrenCount) {

        var total = parseInt(adultCount) + parseInt(childrenCount);
        var packs = Math.ceil(total / parseInt('{{ config("app.wild_packs_count") }}'));
        var additionalValue = packs * parseInt('{{ config("app.wild_service_charge") }}');

        return additionalValue;
    }

</script>

@if ($showModal)
<script>
    document.body.style.overflow = 'hidden';
</script>
@else
<script>
    document.body.style.overflow = 'auto';
</script>
@endif


</div>