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
                        <img style="width: 50%" src="{{ Storage::url($agent?->profile_image) }}" alt="" srcset="">
                        <div class="flex flex-col space-y-4">

                            <h1 class="font-bold leading-tight tracking-widest text-gray-800">
                                Hello, {{ $agent?->name }}</h1>
                        </div>

                    </div>

                </div>
            </div>

            @if ($agent->type != 'tour_agent')
                @include('pages.agent.dashboard.components.infowidget')
            @endif
        </div>
        <!-- End First Row -->



        @if ($agent->type == 'tour_agent')
            @include('pages.agent.dashboard.components.booking_list')
        @endif

        @if ($agent->type == 'discount_agent' || $agent->type == 'service_agent')
            <livewire:records :limit='5' :title="'Recent Records'">
        @endif

    </div>
@endsection
