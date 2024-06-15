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
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
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
    <div class="flex flex-col justify-between col-span-2 p-6 rounded-2xl bg-gradient-to-r from-blue-500 to-blue-800">
        <div class="flex flex-col">
            <p class="font-bold text-white">Ticket Scan</p>
        </div>
        <div class="flex items-end justify-between">
            <a href="{{ route('agent.qrscan') }}"
                class="px-4 py-3 text-xs font-semibold tracking-wider text-white bg-blue-800 rounded-lg hover:bg-blue-600 hover:text-white">
                open the scanner
            </a>
            <img src="{{ asset('images/qr-image.png') }}" alt="calendar" class="object-cover w-auto h-56">
        </div>
    </div>

</div>
