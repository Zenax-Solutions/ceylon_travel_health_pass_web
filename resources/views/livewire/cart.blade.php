<div>
    <!-- component -->
    <!-- This is an example component -->
    <div class="h-screen">


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
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>

                            <h2 class="mb-4 text-2xl font-bold text-center text-gray-800">Registration Success</h2>

                            <div class="mb-8 text-gray-600">
                                Thank you. We have sent you an email to demo@demo.test. Please click the link in the
                                message to activate your account.
                            </div>

                            <button @click="step = 1"
                                class="block w-40 px-5 py-2 mx-auto font-medium text-center text-gray-600 bg-white border rounded-lg shadow-sm focus:outline-none hover:bg-gray-100">Back
                                to home</button>
                        </div>
                    </div>
                </div>

                <div x-show.transition="step != 'complete'">
                    <!-- Top Navigation -->
                    <div class="py-4 border-b-2">
                        <div class="mb-1 text-xs font-bold leading-tight tracking-wide text-gray-500 uppercase"
                            x-text="`Step: ${step} of 3`"></div>
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-1">
                                <div x-show="step === 1">
                                    <div class="text-lg font-bold leading-tight text-gray-700">Package Info</div>
                                </div>

                                <div x-show="step === 2">
                                    <div class="text-lg font-bold leading-tight text-gray-700">Select Your Destinations
                                    </div>
                                </div>


                            </div>

                            <div class="flex items-center md:w-64">
                                <div class="w-full mr-2 bg-white rounded-full">
                                    <div class="h-2 text-xs leading-none text-center text-white bg-green-500 rounded-full"
                                        :style="'width: ' + parseInt(step / 2 * 100) + '%'"></div>
                                </div>
                                <div class="w-10 text-xs text-gray-600" x-text="parseInt(step / 2 * 100) +'%'"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /Top Navigation -->

                    <!-- Step Content -->
                    <div class="py-10">
                        <div x-show.transition.in="step === 1">

                        </div>

                        <div x-show.transition.in="step === 2">


                        </div>

                    </div>
                    <!-- / Step Content -->
                </div>
            </div>

            <!-- Bottom Navigation -->
            <div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
                <div class="max-w-3xl px-4 mx-auto">
                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <button x-show="step > 1" @click="step--"
                                class="w-32 px-5 py-2 font-medium text-center text-gray-600 bg-white border rounded-lg shadow-sm focus:outline-none hover:bg-gray-100">Previous</button>
                        </div>

                        <div class="w-1/2 text-right">
                            <button x-show="step < 2" @click="step++"
                                class="w-32 px-5 py-2 font-medium text-center text-white bg-blue-500 border border-transparent rounded-lg shadow-sm focus:outline-none hover:bg-blue-600">Next</button>

                            <button @click="step = 'complete'" x-show="step === 2"
                                class="w-32 px-5 py-2 font-medium text-center text-white bg-blue-500 border border-transparent rounded-lg shadow-sm focus:outline-none hover:bg-blue-600">Complete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->
        </div>

        <script>
            function app() {
                return {
                    step: 1,
                }
            }
        </script>
    </div>
