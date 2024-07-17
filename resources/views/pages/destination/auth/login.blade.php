<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Destinaton Portal</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    @livewireStyles

</head>

<body>

    <div class="flex flex-col justify-center min-h-screen bg-gray-100 sm:py-12">
        <div class="p-10 mx-auto xs:p-0 md:w-full md:max-w-md">
            <div class="flex justify-center mb-4">

                <x-logo></x-logo>

            </div>
            <form action="{{ route('destination.login.validate') }}" method="POST">
                @csrf
                <div class="w-full bg-white divide-y divide-gray-200 rounded-lg shadow">
                    <div class="px-5 py-7">
                        <label class="block pb-1 text-sm font-semibold text-gray-600">Branch Code</label>
                        <input type="text" required name="branch_code" class="w-full px-3 py-2 mt-1 text-sm border rounded-lg" placeholder="Enter Your Destination Branch Code" />
                        @error('branch_code')
                        <span class="mt-2 text-center text-red-400 invalid-feedback">{{ $message }}</span>
                        @enderror

                        <button type="submit" class="transition mt-4 duration-200 bg-green-500 hover:bg-green-600 focus:bg-green-700 focus:shadow-sm focus:ring-4 focus:ring-green-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                            <span class="inline-block mr-2">Login</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="inline-block w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>


    @livewireScripts

</body>

</html>