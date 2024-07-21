   <!-- component -->
   <footer class="font-sans" style="background-color: #e3efc9;">
            <div class="container px-6 py-12 mx-auto" style="font-weight: 400;">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-y-10 lg:grid-cols-4 text-center md:text-left lg:text-left">

                    <div class="flex justify-center md:justify-start lg:justify-start">
                        <a href="/">
                            <x-logo></x-logo>
                        </a>
                    </div>

                    <div>
                        <p class="font-semibold text-black dark:text-green-400">Contact Us</p>

                        <div class="flex flex-col items-center md:items-start lg:items-start mt-5 space-y-2">
                            <p class="text-black transition-colors duration-300  dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">
                                Colombo,Sri Lanka <br>
                                0706997999 <br>
                                info@ceylontravel.com
                            </p>

                        </div>
                    </div>

                    <div>
                        <p class="font-semibold text-black dark:text-green-400">Quick Link</p>

                        <div class="flex flex-col items-center md:items-start lg:items-start mt-5 space-y-2">
                            <a href="/" class="text-gray-600 transition-colors duration-300 dark:text-black dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Home</a>

                            <a href="{{ route('shops') }}" class="text-gray-600 transition-colors duration-300 dark:text-black dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Shops</a>

                            <a href="{{ route('services') }}" class="text-gray-600 transition-colors duration-300 dark:text-black dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Services</a>

                            <a href="{{ route('review') }}" class="text-gray-600 transition-colors duration-300 dark:text-black dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Review Us</a>

                        </div>
                    </div>

                    <div>
                        <p class="font-semibold text-black dark:text-green-400">More Information</p>

                        <div class="flex flex-col items-center md:items-start lg:items-start mt-5 space-y-2">
                            <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-black dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Privacy
                                Policy</a>

                            <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-black dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Terms
                                and Conditions</a>

                            <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-black dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Refund
                                Policy</a>

                                @include('components.language-switcher')
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold text-black dark:text-green-400">Agent Program</p>

                        <div class="flex flex-col items-center md:items-start lg:items-start mt-5 space-y-2">
                            <a href="{{ route('agent.login') }}" class="text-black transition-colors duration-300 dark:text-black dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Agent
                                Portal</a>

                            <a href="{{ route('destination.login') }}" class="text-black transition-colors duration-300 dark:text-black dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Destination
                                Portal</a>
                            <button id="pwa-download-btn" style="display: none;" class="middle none center mr-3 rounded-lg bg-green-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">
                                Download Agent App
                            </button>

                        </div>
                    </div>
                </div>

                <hr class="h-2 my-6 border-gray-200 md:my-8 dark:border-gray-700" />

                {{-- <div class="sm:flex sm:items-center sm:justify-between">
                <div class="flex flex-1 gap-4 hover:cursor-pointer">
                    <img src="https://www.svgrepo.com/show/303139/google-play-badge-logo.svg" width="130"
                        height="110" alt="" />
                    <img src="https://www.svgrepo.com/show/303128/download-on-the-app-store-apple-logo.svg"
                        width="130" height="110" alt="" />
                </div>

                <div class="flex gap-4 hover:cursor-pointer">
                    <img src="https://www.svgrepo.com/show/303114/facebook-3-logo.svg" width="30" height="30"
                        alt="fb" />
                    <img src="https://www.svgrepo.com/show/303115/twitter-3-logo.svg" width="30" height="30"
                        alt="tw" />
                    <img src="https://www.svgrepo.com/show/303145/instagram-2-1-logo.svg" width="30" height="30"
                        alt="inst" />
                    <img src="https://www.svgrepo.com/show/94698/github.svg" class="" width="30"
                        height="30" alt="gt" />
                    <img src="https://www.svgrepo.com/show/22037/path.svg" width="30" height="30"
                        alt="pn" />
                    <img src="https://www.svgrepo.com/show/28145/linkedin.svg" width="30" height="30"
                        alt="in" />
                    <img src="https://www.svgrepo.com/show/22048/dribbble.svg" class="" width="30"
                        height="30" alt="db" />
                </div>
            </div> --}}
                <p class="p-8 font-sans text-black text-center md:text-start lg:text-start md:text-center md:text-lg md:p-4">
                    © {{ now()->year }}
                    Ceylon
                    Travel. All rights
                    reserved. Developed By <a href="https://zenax.info/" target="_blank">ZENAX</a></p>
            </div>
        </footer>