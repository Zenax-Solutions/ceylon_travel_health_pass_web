@extends('layouts.customer')
@section('content')
    <div class="block border-b-2 md:flex">


        <div class="w-full p-8 lg:ml-4 ">
            <div class="p-6 rounded">
                <div class="pb-6">
                    <label for="name" class="block pb-1 font-semibold text-gray-700">Name</label>
                    <div class="flex">
                        <input disabled id="username" class="w-full px-4 py-2 rounded-r border-1" type="text"
                            value="{{ $customer->first_name }} {{ $customer->last_name }}" />
                    </div>
                </div>
                <div class="pb-4">
                    <label for="email" class="block pb-1 font-semibold text-gray-700">Email</label>
                    <input disabled id="email" class="w-full px-4 py-2 rounded-r border-1" type="email"
                        value="{{ $customer->email }}" />
                </div>

                <!-- Password Reset Form -->
                <form action="{{ route('customer.profile.resetPassword') }}" method="POST" class="pb-6">
                    @csrf
                    <div class="pb-4">
                        <label for="password" class="block pb-1 font-semibold text-gray-700">New Password</label>
                        <input id="password" name="password" class="w-full px-4 py-2 rounded-r border-1" type="password" />
                        @error('password')
                            <span class="font-bold text-red-400 invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="pb-4">
                        <label for="password_confirmation" class="block pb-1 font-semibold text-gray-700">Confirm
                            Password</label>
                        <input id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 py-2 rounded-r border-1" type="password" />
                        @error('password_confirmation')
                            <span class="font-bold text-red-400 invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded">Reset Password</button>
                </form>


            </div>
        </div>

    </div>
@endsection
