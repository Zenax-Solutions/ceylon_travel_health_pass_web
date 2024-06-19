<div>
    <div wire:ignore>

        <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-green-400 to-green-500">
            <div
                class="w-full max-w-md p-8 transition-all duration-500 ease-in-out transform bg-white rounded-lg shadow-lg hover:scale-105 hover:shadow-2xl">
                <div class="mb-2" style="display: flex; justify-content: center;">

                    <img style="width: 200px" src="{{ asset('images/logo.png') }}">

                </div>
                <h2 class="mb-4 text-3xl font-bold text-center text-gray-800">QR Ticket Scanner</h2>
                <div style="display: flex; justify-content: center;">
                    <img style="width: 50%" src="{{ Storage::url($agent?->profile_image) }}" alt=""
                        srcset="">

                </div>
                <p class="mt-4 text-sm text-gray-500 sm:mt-0" style="text-align: center">
                    <a href="{{ route('agent.dashboard') }}" class="font-bold text-red-700 underline">Back To
                        Dashboard</a>.
                </p>

                <div class="p-4">

                    <label for="countries"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Selections</label>
                    <select wire:model = "selection"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>select here</option>
                        @foreach ($selectionList as $list)
                            <option value="{{ $list->id }}"> {{ $list->shope_name ?? $list->service_name }}</option>
                        @endforeach

                    </select>
                </div>
                <div id="result"
                    class="mt-4 mb-4 font-bold text-center text-gray-600 transition duration-500 ease-in-out">
                </div>

                <div id="qr-reader" class="overflow-hidden border-4 border-gray-300 border-dashed rounded-lg "
                    style="width: 100%; height: auto;"></div>

                <audio id="beepSound" src="{{ asset('sounds/beep.mp3') }}" preload="auto"></audio>

            </div>
        </div>

    </div>

    <!-- Modal -->
    <div wire:ignore>
        <!-- Your existing HTML code -->

        <!-- Modal -->
        <div id="QrModal" class="fixed inset-0 z-10 hidden overflow-y-auto transition-opacity"
            aria-labelledby="userModalLabel" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Modal overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <!-- Modal content -->
                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-labelledby="modal-headline">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div>

                            <div class="mt-3 text-center">
                                <!-- Modal title -->

                                <!-- Display user information -->
                                <!-- Example of displaying user name and email -->
                                <div class="mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-16 h-16 mx-auto mt-8 text-green-400" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <h1 class="mt-2 text-2xl font-bold text-center text-gray-500">Valid QR Code</h1>
                                    <div class="mt-3">
                                        <div class="pt-2">
                                            <p class="text-sm font-medium leading-none text-gray-800">
                                                Booking No
                                            </p>
                                            <p class="text-xs font-bold text-green-500" id="bookingId"></p>
                                        </div>
                                        <div class="pt-2">
                                            <p class="text-sm font-medium leading-none text-gray-800">
                                                Ticket No
                                            </p>
                                            <p class="text-xs font-bold text-green-500" id="ticketNo"></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button onclick="closeModal()"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        let html5QrCodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10, // Lower the fps to reduce the frequency of scans
                qrbox: {
                    width: 250,
                    height: 250
                },
                rememberLastUsedCamera: true,
                supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA],
                formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE],
                showTorchButtonIfSupported: true,
            });

        html5QrCodeScanner.render(onScanSuccess);

        let debounceTimeout;
        const debounceDelay = 1000; // 1 second delay to prevent multiple submissions

        async function onScanSuccess(decodedText, decodedResult) {
            if (debounceTimeout) {
                clearTimeout(debounceTimeout);
            }

            debounceTimeout = setTimeout(async () => {
                try {
                    if (decodedText) {
                        // Play sound
                        let beepSound = document.getElementById('beepSound');
                        if (beepSound) {
                            beepSound.play();
                        }

                        // Asynchronously send QR code to Livewire component
                        if (typeof Livewire !== 'undefined') {
                            await Livewire.dispatch('scanQrCode', {
                                decodedText: decodedText
                            });
                        } else {
                            console.error('Livewire is not available');
                        }
                    }
                } catch (error) {
                    console.error('Error in onScanSuccess:', error);
                }
            }, debounceDelay);
        }

        window.addEventListener('qrCodeValidated', event => {
            let resultElement = document.getElementById('result');
            const modal = document.getElementById('QrModal');

            let bookigId = document.getElementById('bookingId');

            let ticketNo = document.getElementById('ticketNo');

            if (resultElement && modal) {
                if (event.detail.status === 'valid') {
                    resultElement.textContent = 'QR Code is valid!';
                    resultElement.classList.remove('text-red-500', 'text-yellow-500');
                    resultElement.classList.add('text-green-500', 'animate-bounce');
                    modal.classList.remove('hidden');

                    bookigId.textContent = event.detail.data.booking_id;
                    ticketNo.textContent = event.detail.data.ticket_id;



                } else if (event.detail.status === 'used') {
                    resultElement.textContent = 'This ticket has already been used.';
                    resultElement.classList.remove('text-green-500', 'text-red-500');
                    resultElement.classList.add('text-yellow-500', 'animate-shake');


                } else if (event.detail.status === 'expired') {
                    resultElement.textContent = 'This ticket has expired!.';
                    resultElement.classList.remove('text-green-500', 'text-red-500');
                    resultElement.classList.add('text-yellow-500', 'animate-shake');

                } else {
                    resultElement.textContent = 'QR Code is invalid';
                    resultElement.classList.remove('text-green-500', 'text-yellow-500');
                    resultElement.classList.add('text-red-500', 'animate-shake');
                }
            } else {
                console.error('Result element or modal not found');
            }
        });

        function closeModal() {
            const modal = document.getElementById('QrModal');
            let resultElement = document.getElementById('result');
            let bookigId = document.getElementById('bookingId');
            let ticketNo = document.getElementById('ticketNo');

            if (resultElement && modal) {
                resultElement.textContent = '';
                bookigId.textContent = '';
                ticketNo.textContent = '';
                modal.classList.add('hidden');
            } else {
                console.error('Result element or modal not found');
            }
        }
    </script>




</div>
