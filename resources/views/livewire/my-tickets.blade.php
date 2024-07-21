<div>
    <div>
        <div class="w-full mx-auto">
            <div class="grid w-full gap-6 sm:grid-cols-2 xl:grid-cols-4">
                @forelse ($tickets as $key => $ticket)
                    <div
                        class="relative flex flex-col max-w-sm overflow-hidden transition-all duration-300 shadow-md rounded-xl hover:shadow-lg hover:-translate-y-1">

                        <div class="h-auto overflow-hidden bg-white">
                            <div class="p-2 mb-2" style="display: flex; justify-content: center;">

                                <x-logo/>

                            </div>
                            <div class="relative overflow-hidden"
                                style="display: flex; justify-content: center;padding: 10px; margin-bottom: 20px;">

                                <img src="{{ asset('storage/tickets/' . $ticket->ticket_id . '.png') }}" alt="QR Code">
                            </div>
                        </div>
                        <div class="px-3 py-4 " style="text-align: center; background-color:#e3efc9">

                            <div class="pb-4">
                                <p <span class="text-3xl font-bold leading-none align-baseline">
                                    {{ $ticket->booking->package->main_title }}</span>
                                </p>
                            </div>

                            <div class="pb-2">

                                @if ($ticket->is_adult)
                                    <div
                                        class="relative inline-block p-4 font-sans text-lg font-bold leading-none text-white bg-green-500 rounded-lg center ">
                                        <div class="mt-px">Adult Pass</div>
                                    </div>
                                @else
                                    <div
                                        class="relative inline-block p-4 font-sans text-lg font-bold leading-none text-white bg-yellow-500 rounded-lg e center ">
                                        <div class="mt-px">Child Pass</div>
                                    </div>
                                @endif

                            </div>
                            <h3 class="mb-2 text-lg font-medium">Ticket No.</h3>
                            <h3 class="mb-2 text-lg font-bold text-black">{{ $key + 1 }}</h3>
                            <h3 class="mb-2 text-lg font-medium">Bookig ID</h3>
                            <h3 class="mb-2 text-xs font-bold text-red-500">#{{ $ticket->booking_id }}</h3>
                            <h3 class="mb-2 text-lg font-medium">Ticket ID</h3>
                            <h3 class="p-4 mb-2 text-xs font-bold text-red-500">{{ $ticket->ticket_id }}</h3>
                            <h3 class="mb-2 text-lg font-medium">Expiry Date</h3>
                            <h3 class="mb-2 text-xs font-bold text-red-500">
                                {{ $ticket->expiry_date == null ? '-' : $ticket->expiry_date->format('Y/m/d') }}</h3>

                            <div class="flex items-center justify-end">

                                <div class="relative z-40 flex items-center gap-2">

                                    <button class="text-blue-600 capture-btn hover:text-orange-500"
                                        onclick="captureCard(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>


        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>



    <script>
        function captureCard(button) {
            // Find the card element
            const card = button.closest('.flex.flex-col');

            // Ensure all images are loaded before capturing
            const images = card.getElementsByTagName('img');
            const imageLoadPromises = Array.from(images).map(img => {
                if (img.complete) {
                    return Promise.resolve();
                } else {
                    return new Promise(resolve => {
                        img.onload = img.onerror = resolve;
                    });
                }
            });

            Promise.all(imageLoadPromises).then(() => {
                // Use html2canvas to take a screenshot of the card
                html2canvas(card, {
                    scale: 4
                }).then(canvas => {
                    // Convert the canvas to an image
                    const imgData = canvas.toDataURL('image/png');

                    // Create a temporary link element
                    const link = document.createElement('a');
                    link.href = imgData;
                    link.download = 'HealthPass.png';

                    // Append the link to the body
                    document.body.appendChild(link);

                    // Programmatically click the link to trigger the download
                    link.click();

                    // Remove the link from the document
                    document.body.removeChild(link);
                });
            });
        }

        // Ensure the function is available in the Livewire context
        document.addEventListener('livewire:load', function() {
            window.captureCard = captureCard;
        });
    </script>




</div>
