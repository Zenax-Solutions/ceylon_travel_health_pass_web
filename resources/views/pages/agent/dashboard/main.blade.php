@extends('layouts.agent')
@section('content')
    <div class="flex flex-col space-y-8">

        <!-- First Row -->
        <div class="grid grid-cols-1 px-4 md:grid-cols-4 xl:grid-cols-5 xl:p-0 gap-y-4 md:gap-6">



            <div class="p-6 bg-white border md:col-span-2 xl:col-span-3 rounded-2xl border-gray-50">
                <div class="flex flex-col space-y-6 md:h-full md:justify-between">
                    <div class="flex justify-between">
                        <span class="text-xs font-semibold tracking-wider text-gray-500 uppercase">
                            Dashboard
                        </span>

                    </div>
                    <div class="flex items-center justify-between gap-2 md:gap-4">
                        <div class="flex flex-col space-y-4">
                            <h1 class="font-bold leading-tight tracking-widest text-gray-800">
                                Hello, {{ $agent?->name }}</h1>
                        </div>

                    </div>

                </div>
            </div>
            <div
                class="flex flex-col justify-between col-span-2 p-6 rounded-2xl bg-gradient-to-r from-green-400 to-green-600">
                <div class="flex flex-col">
                    <p class="font-bold text-white">Welcome To Ceylon Travel & Health Pass</p>

                    <br>
                    <h1 class="font-bold leading-tight tracking-widest text-gray-800">{{ now()->format('Y/m/d') }}</h1>

                </div>

            </div>

        </div>
        <!-- End First Row -->

        @include('pages.agent.dashboard.components.infowidget')

        @if ($agent->type == 'tour_agent')
            @include('pages.agent.dashboard.components.booking_list')
        @endif




    </div>
@endsection
