@extends('layouts.destination')
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
                    <div>
                        <img class="rounded" style="width: 50%" src="{{ Storage::url($branch?->image) }}" alt=""
                            srcset="">

                    </div>
                    <div class="flex items-center justify-between gap-2 md:gap-4">




                        <div class="flex flex-col space-y-4">

                            <h1 class="font-bold leading-tight tracking-widest text-gray-800">
                                {{ $branch?->destination }} </h1>
                            <h1 class="font-bold leading-tight tracking-widest text-gray-800">
                                Destination Branch Code : <span class="text-green-500">{{ $branch?->branch_number }}</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white border md:col-span-2 xl:col-span-2 rounded-2xl border-gray-50">

                <div
                    class="flex flex-col justify-between col-span-2 p-6 rounded-2xl bg-gradient-to-r from-green-500 to-green-800">
                    <div class="flex flex-col">
                        <p class="font-bold text-white">Ticket Scan</p>
                    </div>
                    <div class="flex items-end justify-between">
                        <a href="{{ route('destination.qrscan') }}"
                            class="px-4 py-3 text-xs font-semibold tracking-wider text-white bg-gray-800 rounded-lg hover:bg-green-600 hover:text-white">
                            start
                        </a>
                        <img src="{{ asset('images/qr-image.png') }}" alt="calendar" class="object-cover"
                            style="width: 50%">
                    </div>
                </div>

            </div>

        </div>

        <livewire:records :limit='5' :title="'Recent Records'" :destinationMode="'true'" />

    </div>
@endsection
