<div class="p-6 bg-white border md:col-span-2 xl:col-span-2 rounded-2xl border-gray-50">

    <div class="flex flex-col justify-between col-span-2 p-6 rounded-2xl bg-gradient-to-r from-green-500 to-green-800">
        <div class="flex flex-col">
            <p class="font-bold text-white">Ticket Scan</p>
        </div>
        <div class="flex items-end justify-between">
            <a href="{{ route('agent.qrscan') }}"
                class="px-4 py-3 text-xs font-semibold tracking-wider text-white bg-gray-800 rounded-lg hover:bg-green-600 hover:text-white">
                open the scanner
            </a>
            <img src="{{ asset('images/qr-image.png') }}" alt="calendar" class="object-cover" style="width: 50%">
        </div>
    </div>

</div>
