@extends('layouts.agent')
@section('content')
    <div class="block border-b-2 md:flex">


        <div class="w-full p-8 lg:ml-4 ">
            <div class="p-6 rounded">


                @if (!empty($agent->profile_image))
                    <div class="pb-6">
                        <div class="relative inline-block rounded shrink-0 me-3">
                            <img src="{{ Storage::url($agent->profile_image) }}" class="inline-block w-24 rounded-lg shrink-0"
                                alt="">
                        </div>
                    </div>
                @endif


                <form action="{{ route('agent.profile.imageUpdate') }}" enctype="multipart/form-data" method="POST"
                    class="pb-6">
                    @csrf

                    <div class="pb-6">
                        <label class="block pb-1 font-bold text-gray-700 ">Update Profile Image</label>
                        <input type="file" required name='image' id="image"
                            class="w-full px-3 py-2 border rounded">
                        @error('image')
                            <span class="font-bold text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded">Update Profile</button>
                </form>

                <div class="pb-6">
                    <label for="name" class="block pb-1 font-semibold text-gray-700">Name</label>
                    <div class="flex">
                        <input disabled id="username" class="w-full px-4 py-2 rounded-r border-1" type="text"
                            value="{{ $agent->name }}" />
                    </div>
                </div>
                <div class="pb-4">
                    <label for="email" class="block pb-1 font-semibold text-gray-700">Email</label>
                    <input disabled id="email" class="w-full px-4 py-2 rounded-r border-1" type="email"
                        value="{{ $agent->email }}" />
                </div>

                <div class="pb-4">
                    <label for="email" class="block pb-1 font-semibold text-gray-700">ID Number</label>
                    <input disabled id="email" class="w-full px-4 py-2 rounded-r border-1" type="text"
                        value="{{ $agent->id_no }}" />
                </div>

                @if ($agent->type == 'tour_agent')
                    <div class="pb-4">
                        <label for="email" class="block pb-1 font-semibold text-gray-700">ID Number</label>
                        <input disabled id="email" class="w-full px-4 py-2 rounded-r border-1" type="text"
                            value="{{ $agent->license_no }}" />
                    </div>
                @endif

                <!-- Password Reset Form -->
                <form action="{{ route('agent.profile.resetPassword') }}" method="POST" class="pb-6">
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
