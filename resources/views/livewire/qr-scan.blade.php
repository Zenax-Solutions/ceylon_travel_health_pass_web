<div wire:ignore>

    <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-green-400 to-green-500">
        <div
            class="w-full max-w-md p-8 transition-all duration-500 ease-in-out transform bg-white rounded-lg shadow-lg hover:scale-105 hover:shadow-2xl">
            <div>

                <img style="width: 200px" src="{{ asset('images/logo.png') }}">

            </div>
            <h2 class="mb-4 text-3xl font-bold text-center text-gray-800">QR Ticket Scanner</h2>

            <div class="p-4">

                <label for="countries"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Selections</label>
                <select wire:model = "selection"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    @foreach ($selectionList as $list)
                        <option value="{{ $list->id }}"> {{ $list->shope_name ?? $list->service_name }}</option>
                    @endforeach

                </select>
            </div>

            <div id="qr-reader" class="overflow-hidden border-4 border-gray-300 border-dashed rounded-lg "
                style="width: 100%; height: auto;"></div>
            <div id="result" class="mt-4 font-bold text-center text-gray-600 transition duration-500 ease-in-out">
            </div>
            <audio id="beepSound" src="{{ asset('sounds/beep.mp3') }}" preload="auto"></audio>
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
                        <div class="sm:flex sm:items-start">
                            <div
                                class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-green-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                <!-- Icon or indicator (e.g., checkmark) -->
                                <!-- Adjust based on your design -->
                                <!-- For example, using Heroicons -->
                                <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <!-- Modal title -->
                                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                                    Valid User Information
                                </h3>
                                <!-- Display user information -->
                                <!-- Example of displaying user name and email -->
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Name: <span id="userName"></span>
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Email: <span id="userEmail"></span>
                                    </p>
                                    <!-- Add more user details as needed -->
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
        document.addEventListener('DOMContentLoaded', function() {
            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText) {
                    // Play sound
                    document.getElementById('beepSound').play();

                    // Asynchronously send QR code to Livewire component
                    Livewire.dispatch('scanQrCode', {
                        decodedText: decodedText
                    });
                }
            }

            let html5QrCodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 60,
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

            window.addEventListener('qrCodeValidated', event => {
                let resultElement = document.getElementById('result');
                const modal = document.getElementById('QrModal');
                const cameraContainer = document.getElementById('qr-reader');


                if (event.detail.status === 'valid') {
                    resultElement.textContent = 'QR Code is valid!';
                    resultElement.classList.remove('text-red-500');
                    resultElement.classList.remove('text-yellow-500');
                    resultElement.classList.add('text-green-500');
                    resultElement.classList.add('animate-bounce');
                } else if (event.detail.status === 'used') {
                    resultElement.textContent = 'This ticket has already been used.';
                    resultElement.classList.remove('text-green-500');
                    resultElement.classList.add('text-yellow-500');
                    resultElement.classList.add('animate-shake');


                    modal.classList.remove('hidden');

                    setTimeout(() => {
                        modal.classList.remove('opacity-0');
                    }, 50);
                } else {
                    resultElement.textContent = 'QR Code is invalid';
                    resultElement.classList.remove('text-green-500');
                    resultElement.classList.remove('text-yellow-500');
                    resultElement.classList.add('text-red-500');
                    resultElement.classList.add('animate-shake');
                }
            });



        });

        function closeModal() {
            const modal = document.getElementById('QrModal');
            const cameraContainer = document.getElementById('qr-reader');

            // Hide modal with animation
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 550); // Adjust timing based on your transition duration


        }
    </script>


</div>
