@extends('layouts.app')
@section('content')
    <script>
        (function(global) {
            if (typeof(global) === "undefined") {
                throw new Error("window is undefined");
            }

            var _hash = "!";
            var noBackPlease = function() {
                global.location.href += "#";

                // Making sure we have the fruit available for juice (^__^)
                global.setTimeout(function() {
                    global.location.href += "!";
                }, 50);
            };

            // Earlier we had setInerval here....
            global.onhashchange = function() {
                if (global.location.hash !== _hash) {
                    global.location.hash = _hash;
                }
            };

            global.onload = function() {
                noBackPlease();

                // Disables backspace on page except on input fields and textarea..
                document.body.onkeydown = function(e) {
                    var elm = e.target.nodeName.toLowerCase();
                    if (e.which === 8 && (elm !== 'input' && elm !== 'textarea')) {
                        e.preventDefault();
                    }
                    // Stopping the event bubbling up the DOM tree...
                    e.stopPropagation();
                };
            };
        })(window);
    </script>
    <!-- component -->
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="px-16 rounded-lg bg-gray-50 py-14">
            <div class="flex justify-center">
                <div class="p-6 bg-green-200 rounded-full">
                    <div class="flex items-center justify-center w-16 h-16 p-4 bg-green-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                </div>
            </div>
            <h3 class="my-4 text-3xl font-semibold text-center text-gray-700">Congratuation!!!</h3>
            <p class="w-[230px] text-center font-normal text-gray-600">Payment Complete</p>
            <a href="/"
                class="block px-6 py-3 mx-auto mt-10 text-base font-medium text-center text-orange-100 bg-orange-400 border-4 border-transparent rounded-xl outline-8 hover:outline hover:duration-300">Back
                to home</a>
        </div>
    </div>
@endsection
