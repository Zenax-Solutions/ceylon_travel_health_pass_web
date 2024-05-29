@extends('layouts.auth')
@section('content')
    <section class="w-full bg-white">
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
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

                    {{-- <p class="mt-4 leading-relaxed text-white/90">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi nam dolorum aliquam,
                        quibusdam aperiam voluptatum.
                    </p> --}}
                </div>
            </section>

            <main class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
                <div class="max-w-xl lg:max-w-3xl">
                    <div class="relative block -mt-16 lg:hidden">
                        <a class="inline-flex items-center justify-center text-blue-600 bg-white " href="/">
                            <span class="sr-only">Home</span>
                            <div>
                                <img src="{{ asset('images/logo.png') }}">
                            </div>
                        </a>

                        <h1 class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                            Welcome to Ceylon Travel Agent Program
                        </h1>

                        {{-- <p class="mt-4 leading-relaxed text-gray-500">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi nam dolorum aliquam,
                            quibusdam aperiam voluptatum.
                        </p> --}}
                    </div>

                    <div class="flex flex-col space-y-2 text-center">
                        <h2 class="text-3xl font-bold md:text-4xl">New Agent Registration</h2>
                    </div>


                    <form action="{{ route('agent.register.submit') }}" method="POST" class="grid grid-cols-6 gap-6 mt-8"
                        x-data="{ showLicenseField: false }">
                        @csrf

                        <div class="col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" value="{{ old('email') }}" placeholder="Enter Your Email" name="email"
                                required
                                class="flex w-full px-3 py-2 font-medium border-2 {{ $errors->has('email') ? 'border-red-400' : 'border-black' }}  rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                            @error('email')
                                <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" placeholder="Password" name="password" required
                                class="flex w-full px-3 py-2 font-medium border-2 {{ $errors->has('password') ? 'border-red-400' : 'border-black' }}  rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                            @error('password')
                                <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" placeholder="Confirm Password" name="confirm_password" required
                                class="flex w-full px-3 py-2 font-medium border-2 {{ $errors->has('confirm_password') ? 'border-red-400' : 'border-black' }} rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                            @error('confirm_password')
                                <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Type Field -->
                        <div class="col-span-6">
                            <label for="type" class="block text-sm font-medium text-gray-700">Sekect Your Agent Type
                            </label>
                            <select x-on:change="showLicenseField = ($event.target.value === 'tour_agent')"
                                value="{{ old('type') }}" name="type" required
                                class="flex w-full px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal">
                                <option value="">Select One</option>
                                <option value="discount_agent">Discount Agent</option>
                                <option value="service_agent">Service Agent</option>
                                <option value="esim_agent">Esim Agent</option>
                                <option value="tour_agent">Tour Agent</option>
                            </select>
                            @error('type')
                                <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Name Field -->
                        <div class="col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name </label>
                            <input type="text" value="{{ old('name') }}" required name="name"
                                class="flex w-full px-3 py-2 font-medium border-2 {{ $errors->has('name') ? 'border-red-400' : 'border-black' }}  rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                            @error('name')
                                <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Contact Number Field -->
                        <div class="col-span-6">
                            <label for="contact_no" class="block text-sm font-medium text-gray-700"> Contact Number </label>
                            <input type="text" value="{{ old('contact_no') }}" required name="contact_no"
                                placeholder="071 000 0000"
                                class="flex w-full px-3 py-2 font-medium border-2 {{ $errors->has('contact_no') ? 'border-red-400' : 'border-black' }}  rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                            @error('contact_no')
                                <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- ID Number Field -->
                        <div class="col-span-6">
                            <label for="id_no" class="block text-sm font-medium text-gray-700"> ID Number </label>
                            <input type="text" required value="{{ old('id_no') }}" name="id_no"
                                class="flex w-full px-3 py-2 font-medium border-2 {{ $errors->has('id_no') ? 'border-red-400' : 'border-black' }}  rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                            @error('id_no')
                                <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- License Number Field -->
                        <div class="col-span-6" x-show="showLicenseField" x-transition>
                            <label for="license_no" class="block text-sm font-medium text-gray-700"> License Number </label>
                            <input type="text" value="{{ old('license_no') }}" x-bind:required="showLicenseField"
                                name="license_no"
                                class="flex w-full px-3 py-2 font-medium border-2 {{ $errors->has('license_no') ? 'border-red-400' : 'border-black' }}  rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                            @error('license_no')
                                <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Submit Button -->
                        <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                            <button type="submit"
                                class="inline-block px-12 py-3 text-sm font-medium text-white transition bg-green-600 border border-green-600 rounded-md shrink-0 hover:bg-transparent hover:text-green-600 focus:outline-none focus:ring active:text-green-500">
                                Register Now
                            </button>
                            <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                                Already have an account?
                                <a href="{{ route('agent.login') }}" class="text-gray-700 underline">Log here</a>.
                            </p>
                        </div>
                    </form>

                </div>
            </main>
        </div>
    </section>
@endsection
