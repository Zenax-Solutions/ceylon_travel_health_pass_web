@extends('layouts.auth')
@section('content')
    <div class="flex flex-row w-full">

        <!-- Sidebar -->
        <div class='flex-col justify-between hidden bg-green-500 lg:flex lg:p-8 xl:p-12 lg:max-w-sm xl:max-w-lg'>

            <div class='space-y-5'>
                <h1 class="font-extrabold lg:text-3xl xl:text-5xl xl:leading-snug">Enter your account and discover
                    new
                    experiences</h1>
                <p class="text-lg">You do not have an account?</p>
                <a class="flex-none inline-block px-4 py-3 font-medium text-white bg-black border-2 border-black rounded-lg"
                    href="{{ route('customer.register') }}">Create
                    account here</a>
            </div>
        </div>

        <!-- Login -->
        <div class="relative flex flex-col items-center justify-center flex-1 px-10">
            <div class="flex items-center justify-between w-full py-4 lg:hidden">

                <div class="flex items-center space-x-2">
                    <span>You do not have an account? </span>
                    <a href="{{ route('customer.register') }}" class="underline font-medium text-[#070eff]">
                        Create account here
                    </a>
                </div>
            </div>
            <!-- Login box -->
            <div class="flex flex-col justify-center flex-1 max-w-md space-y-5">
                <div class="flex flex-col space-y-2 text-center">
                    <h2 class="text-3xl font-bold md:text-4xl">Registerd User Login</h2>

                </div>

                <form action="{{ route('customer.login.validate') }}" method="POST">
                    @csrf
                    <div class="flex flex-col max-w-md space-y-5">
                        <input type="text" value="{{ old('email') }}" placeholder="Email" name="email"
                            class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                        @error('email')
                            <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                        @enderror
                        <input type="password" placeholder="Password" name="password"
                            class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                        @error('password')
                            <span class="text-red-400 invalid-feedback">{{ $message }}</span>
                        @enderror

                        <button type="submit"
                            class="flex items-center justify-center flex-none px-3 py-2 font-medium text-white bg-black border-2 border-black rounded-lg md:px-4 md:py-3">log-in
                        </button>
                    </div>
                </form>

            </div>


        </div>
    </div>
@endsection
