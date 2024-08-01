<div>
    <div x-data="{ open: false, searchdestination: '',searchservices: '',searchshops: '', openTab: 1  }" x-effect="document.body.style.overflow = open ? 'hidden' : 'auto'">

        <!-- Sidebar Overlay -->
        <div x-show="open" class="fixed inset-0 z-50 overflow-hidden backdrop-blur">
            <div x-show="open" x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <!-- Sidebar Content -->
            <section class="absolute inset-y-0 right-0 flex" style="z-index: 100;">
                <div x-show="open" x-transition:enter="transition-transform ease-out duration-300" x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0" x-transition:leave="transition-transform ease-in duration-300" x-transition:leave-start="transform translate-x-0" x-transition:leave-end="transform translate-x-full" class="w-screen max-w-md">
                    <div class="h-full flex flex-col py-6 bg-white shadow-xl">
                        <!-- Sidebar Header -->
                        <div class="flex items-center justify-between px-4">
                            <h2 class="text-xl font-semibold text-black">Package Info</h2>
                            <button x-on:click="open = false" class="text-gray-500 hover:text-gray-700">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>


                        <div class="p-4">
                            <div class="mb-4 flex space-x-4 text-sm p-2 bg-white rounded-lg shadow-md font-bold">
                                <button x-on:click="openTab = 1" :class="{ 'bg-green-600 font-bold text-white': openTab === 1 }" class="flex-1 py-2 px-4 rounded-md focus:outline-none font-bold focus:shadow-outline-blue transition-all duration-300">Destinations</button>
                                <button x-on:click="openTab = 2" :class="{ 'bg-green-600 font-bold text-white': openTab === 2 }" class="flex-1 py-2 px-4 rounded-md focus:outline-none font-bold focus:shadow-outline-blue transition-all duration-300">Services</button>
                                <button x-on:click="openTab = 3" :class="{ 'bg-green-600 font-bold text-white': openTab === 3 }" class="flex-1 py-2 px-4 rounded-md focus:outline-none font-bold focus:shadow-outline-blue transition-all duration-300">Shops</button>
                            </div>
                        </div>
                        <div class="mt-4 px-4 h-full overflow-auto">
                            <div x-show="openTab === 1" class="transition-all duration-300">
                                <!-- Search Input -->
                                <div class="mt-4 px-4">
                                    <input type="text" placeholder="Search Destination here" x-model="searchdestination" class="w-full p-2 border font-normal border-green-500 rounded-md focus:border-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-300 transition-colors duration-300">
                                </div>
                                <div class="mt-4 px-4">
                                    <p class="ml-2 text-gray-800 font-bold">Destination List</p>
                                </div>
                                <!-- Sidebar Content -->
                                <div class="mt-4 px-4 h-full overflow-auto">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        @forelse($destinations as $destination)
                                        <template x-if="searchdestination === '' || {{ json_encode($destination->destination) }}.toLowerCase().includes(searchdestination.toLowerCase())">
                                            <div class="bg-gray-50 hover:bg-gray-100 p-4 cursor-pointer rounded-md border border-gray-300 transition-colors duration-300">
                                                <h3 class="text-sm font-semibold text-black mb-2">
                                                    {{ $destination->destination }}
                                                </h3>
                                                <img style="object-fit: cover" class="transform border border-gray-200 rounded-md w-full h-20 object-cover" src="{{ Storage::url($destination->image) }}" />
                                                <br>
                                                @if(!empty($destination->discount_info))
                                                <span class="inline-flex flex-shrink-0 items-center rounded-full bg-red-600 px-1.5 py-0.5 text-xs font-medium text-white ring-1 ring-inset ring-red-600/20">{{$destination->discount_info}}</span>

                                                @endif
                                            </div>
                                        </template>
                                        @empty
                                        <p>No destinations found.</p>
                                        @endforelse
                                    </div>
                                </div>

                            </div>

                            <div x-show="openTab === 2" class="transition-all duration-300">
                                <!-- Search Input -->
                                <div class="mt-4 px-4">
                                    <input type="text" placeholder="Search Services here" x-model="searchservices" class="w-full p-2 border font-normal border-green-500 rounded-md focus:border-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-300 transition-colors duration-300">
                                </div>
                                <div class="mt-4 px-4">
                                    <p class="ml-2 text-gray-800 font-bold">Available services list for this package</p>
                                </div>
                                <!-- Sidebar Content -->
                                <div class="mt-4 px-4 h-full overflow-auto">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        @if(!empty($package->discount_service_list))
                                        @forelse($package->discount_service_list as $serviceId)
                                        @php
                                        $service = \App\Models\DiscountService::find($serviceId);
                                        @endphp
                                        <template x-if="searchservices === '' || {{ json_encode($service?->service_name) }}.toLowerCase().includes(searchservices.toLowerCase())">
                                            <div class="bg-gray-50 hover:bg-gray-100 p-4 cursor-pointer rounded-md border border-gray-300 transition-colors duration-300">
                                                <h3 class="text-sm font-semibold text-black mb-2">
                                                    {{ $service?->service_name }}
                                                </h3>
                                                <img style="object-fit: cover" class="transform border border-gray-200 rounded-md w-full h-20 object-cover" src="{{ Storage::url($service?->image) }}" />
                                                <p class="text-sm mt-2 font-bold text-green-400">
                                                    @if (is_numeric($service?->discount_amount))
                                                    Discount: %{{ $service?->discount_amount }}
                                                    @else
                                                    Discount: {{ $service?->discount_amount }}
                                                    @endif
                                                </p>
                                            </div>
                                        </template>
                                        @empty
                                        <h3 class="my-2 px-4 text-[15px] text-red-400">empty list 😢</h3>
                                        @endforelse
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div x-show="openTab === 3" class="transition-all duration-300">
                                <!-- Search Input -->
                                <div class="mt-4 px-4">
                                    <input type="text" placeholder="Search Shops here" x-model="searchshops" class="w-full p-2 border font-normal border-green-500 rounded-md focus:border-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-300 transition-colors duration-300">
                                </div>
                                <div class="mt-4 px-4">
                                    <p class="ml-2 text-gray-800 font-bold">Available shops list for this package</p>
                                </div>
                                <!-- Sidebar Content -->
                                <div class="mt-4 px-4 h-full overflow-auto">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        @if(!empty($package->discount_shop_list))
                                        @forelse($package->discount_shop_list as $shopId)
                                        @php
                                        $shop = \App\Models\DiscountShop::find($shopId);
                                        @endphp
                                        <template x-if="searchshops === '' || {{ json_encode($shop?->shope_name) }}.toLowerCase().includes(searchshops.toLowerCase())">
                                            <div class="bg-gray-50 hover:bg-gray-100 p-4 cursor-pointer rounded-md border border-gray-300 transition-colors duration-300">
                                                <h3 class="text-sm font-semibold text-black mb-2">
                                                    {{ $shop?->shope_name }}
                                                </h3>
                                                <img style="object-fit: cover" class="transform border border-gray-200 rounded-md w-full h-20 object-cover" src="{{ Storage::url($shop?->image) }}" />
                                                <p class="text-sm mt-2 font-bold text-green-400">
                                                    @if (is_numeric($shop?->discount_amount))
                                                    Discount: %{{ $shop?->discount_amount }}
                                                    @else
                                                    Discount: {{ $shop?->discount_amount }}
                                                    @endif
                                                </p>
                                            </div>
                                        </template>
                                        @empty
                                        <h3 class="my-2 px-4 text-[15px] text-red-400">empty list 😢</h3>
                                        @endforelse
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Sidebar Footer -->
                        <div class="mt-6 px-4">
                            <a href="{{ route('package',['id' => $package->id]) }}" x-on:click="open = true" class="middle none center mr-3 rounded-lg bg-green-500 py-3 px-6 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">
                                Buy Now
                            </a>

                        </div>



                    </div>
                </div>
            </section>
        </div>
        <!-- Your main content goes here -->
        <!-- Open sidebar button -->
        <div>
            <div class="inline-block align-bottom">
                <button x-on:click="open = true" class="middle none center mr-3 rounded-lg bg-green-500 py-3 px-6 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">
                    View More Details
                </button>
            </div>
        </div>
    </div>

</div>