@extends('layouts.auth')
@section('content')
    <section class="w-full bg-white">
        <div>
            <section class="relative flex items-end h-32 bg-gray-900 lg:col-span-5 lg:h-full xl:col-span-6">
                <img alt=""
                    src="https://images.squarespace-cdn.com/content/v1/59899fa9f9a61eda9f9f0394/1520893860746-WE234UJR1VY11Q3CG7PT/Castlereagh-lake-4+-+corinthian+travel+uk+v2.jpg?format=2500w"
                    class="absolute inset-0 object-cover w-full h-full opacity-80" />

                <div class="hidden lg:relative lg:block lg:p-12">
                    <a class="block text-white" href="/">
                        <span class="sr-only">Home</span>
                        <div>
                            <img style="width: 300px" src="{{ asset('images/logo.png') }}">
                        </div>
                    </a>

                    <h2 class="mt-6 text-2xl font-bold text-white sm:text-3xl md:text-4xl">
                        Welcome to Ceylon Travel Agent Program
                    </h2>


                </div>
            </section>

            <main class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
                <div class="max-w-xl lg:max-w-3xl">
                    {{-- <div class="relative block lg:hidden">
                        <a class="inline-flex items-center justify-center text-blue-600 " href="/">
                            <span class="sr-only">Home</span>
                            <div>
                                <img style="width: 300px" src="{{ asset('images/logo.png') }}">
                            </div>
                        </a>


                    </div> --}}

                    <div class="flex flex-col space-y-2 text-center">
                        {{-- <h2 class="text-3xl font-bold md:text-4xl">Agent Portal</h2> --}}
                    </div>

                    <form action="{{ route('agent.login.validate') }}" method="POST" class="grid grid-cols-6 gap-6 mt-8">
                        @csrf
                        <div class="col-span-6">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email
                            </label>

                            <input type="email" value="{{ old('email') }}" required name="email"
                                class="flex w-full px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                            @error('email')
                                <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-span-6">
                            <label for="Password" class="block text-sm font-medium text-gray-700"> Password </label>

                            <input type="password" required name="password"
                                class="flex w-full px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                            @error('password')
                                <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                            <button type="submit"
                                class="inline-block px-12 py-3 text-sm font-medium text-white transition bg-green-600 border border-green-600 rounded-md shrink-0 hover:bg-transparent hover:text-green-600 focus:outline-none focus:ring active:text-green-500">
                                Log-in
                            </button>

                            <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                                You do not have an account?
                                <a href="{{ route('agent.register') }}" class="text-gray-700 underline">Register here</a>.
                            </p>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>
@endsection
