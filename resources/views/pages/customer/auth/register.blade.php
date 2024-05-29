@extends('layouts.auth')
@section('content')
    <div class="flex flex-row w-full">

        <!-- Sidebar -->
        <div class='flex-col justify-between hidden bg-green-500 lg:flex lg:p-8 xl:p-12 lg:max-w-sm xl:max-w-lg'>

            <div class='space-y-5'>
                <h1 class="font-extrabold lg:text-3xl xl:text-5xl xl:leading-snug">Enter your account and discover
                    new
                    experiences</h1>
                <p class="text-lg">Already have an account</p>
                <a class="flex-none inline-block px-4 py-3 font-medium text-white bg-black border-2 border-black rounded-lg"
                    href="{{ route('customer.login') }}">Login
                    here</a>

            </div>
        </div>

        <!-- Login -->
        <div class="relative flex flex-col items-center justify-center flex-1 px-10">
            <div class="flex items-center justify-between w-full py-4 lg:hidden">

                <div class="flex items-center space-x-2">
                    <span>Already have an account </span>
                    <a href="{{ route('customer.login') }}" class="underline font-medium text-[#070eff]">
                        Login here
                    </a>
                </div>
            </div>
            <!-- Login box -->
            <div class="flex flex-col justify-center flex-1 max-w-md space-y-5">
                <div class="flex flex-col space-y-2 text-center">
                    <h2 class="text-3xl font-bold md:text-4xl">Create New Account</h2>

                </div>
                <style>
                    .tel-input {
                        width: 100%;
                    }
                </style>

                <form action="{{ route('customer.register.submit') }}" method="POST">
                    @csrf
                    <div class="flex flex-col max-w-md space-y-5">
                        <input type="text" value="{{ old('first_name') }}" placeholder="Enter Your First Name" required
                            name="first_name"
                            class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                        @error('first_name')
                            <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                        @enderror
                        <input type="text" value="{{ old('last_name') }}" placeholder="Enter Your Last Name"
                            name="last_name"
                            class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                        @error('last_name')
                            <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                        @enderror
                        <input type="email" value="{{ old('email') }}" placeholder="Enter Your Email" name="email"
                            required
                            class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                        @error('email')
                            <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                        @enderror
                        <input type="tell" id="mobile_code_3" value="{{ old('contact_no') }}"
                            placeholder="Enter Your Contact Number" name="contact_no" required
                            class="flex px-3 py-2 font-medium border-2 border-black rounded-lg tel-input md:px-4 md:py-3 placeholder:font-normal" />
                        @error('contact_no')
                            <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                        @enderror
                        <input type="password" placeholder="Password" name="password" required
                            class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                        @error('password')
                            <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                        @enderror
                        <input type="password" placeholder="Confirm Password" name="confpassword" required
                            class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                        @error('confpassword')
                            <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                        @enderror
                        <label>Select Your Region Type</label>
                        <select value="{{ old('region_type') }}" name="region_type" required
                            class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal">
                            <option value="">Select One</option>
                            <option value="south_asian">South Asian</option>
                            <option value="non_south_asian">Non South Asian</option>
                        </select>
                        @error('region_type')
                            <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                        @enderror

                        <button type="submit"
                            class="flex items-center justify-center flex-none px-3 py-2 font-medium text-white bg-black border-2 border-black rounded-lg md:px-4 md:py-3">login
                        </button>
                    </div>
                </form>
            </div>


        </div>
    </div>

    <script>
        const input_3 = document.querySelector("#mobile_code_3");
        window.intlTelInput(input_3, {
            autoInsertDialCode: true,
            nationalMode: false,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
        });
    </script>
@endsection
