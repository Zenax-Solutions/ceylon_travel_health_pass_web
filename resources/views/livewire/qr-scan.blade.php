<div wire:ignore>

    <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-400 to-purple-500">
        <div
            class="w-full max-w-md p-8 transition-all duration-500 ease-in-out transform bg-white rounded-lg shadow-lg hover:scale-105 hover:shadow-2xl">
            <div>

                <img style="width: 200px" src="{{ asset('images/logo.png') }}">

            </div>
            <h2 class="mb-4 text-3xl font-bold text-center text-gray-800">QR Ticket Scanner</h2>
            <div id="qr-reader" class="overflow-hidden border-4 border-gray-300 border-dashed rounded-lg "
                style="width: 100%; height: auto;"></div>
            <div id="result" class="mt-4 font-bold text-center text-gray-600 transition duration-500 ease-in-out">
            </div>
            <audio id="beepSound" src="{{ asset('sounds/beep.mp3') }}" preload="auto"></audio>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            async function onScanSuccess(decodedText, decodedResult) {
                if (decodedText) {
                    // Play sound
                    document.getElementById('beepSound').play();

                    // Asynchronously send QR code to Livewire component
                    await Livewire.dispatch('scanQrCode', {
                        decodedText: decodedText
                    });

                    // Update result text
                    //document.getElementById('result').textContent = `Scanned QR Code: ${decodedText}`;
                }
            }

            let html5QrCodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 60,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                });
            html5QrCodeScanner.render(onScanSuccess);

            window.addEventListener('qrCodeValidated', event => {
                let resultElement = document.getElementById('result');


                if (event.detail.status === 'valid') {
                    resultElement.textContent = 'QR Code is valid!';
                    resultElement.classList.remove('text-red-500');
                    resultElement.classList.add('text-green-500');
                    resultElement.classList.add('animate-bounce');
                } else {
                    resultElement.textContent = 'QR Code is invalid';
                    resultElement.classList.remove('text-green-500');
                    resultElement.classList.add('text-red-500');
                    resultElement.classList.add('animate-shake');
                }
            });
        });
    </script>


</div>
