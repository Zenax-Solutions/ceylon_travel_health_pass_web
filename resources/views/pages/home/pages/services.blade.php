@extends('layouts.app')
@section('content')
<!-- Live Chat -->
@include('pages.home.components.chatwidget')

<div class="py-16 overflow-hidden bg-gray-50">
    <div class="container px-6 m-auto space-y-8 text-gray-500 md:px-12">
        <div>
            <h2 class="mt-4 text-2xl font-bold text-gray-900 md:text-4xl">Discount Services</h2>
        </div>
        <div class="grid mt-16 overflow-hidden border divide-x divide-y rounded-xl sm:grid-cols-2 lg:divide-y-0 lg:grid-cols-3 xl:grid-cols-4">

            @forelse ($discountServices as $service)
            <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                <div class="relative p-8 space-y-8 text-center">
                    <div style="height: 200px; display:flex; justify-content:center">
                        <img style="object-fit: contain;" src="{{ Storage::url($service->image) }}" alt="burger illustration">
                    </div>

                    <div class="space-y-2">
                        <a href="{{ $service->location }}" target="_blank" rel="noopener noreferrer">
                            <h5 class="text-xl font-medium text-gray-800 transition group-hover:text-yellow-600">
                                {{ $service->service_name }}
                            </h5>
                        </a>
                        <p class="text-sm font-bold text-green-400">
                            @if (is_numeric($service->discount_amount))
                            Discount: %{{ $service->discount_amount }}
                            @else
                            Discount: {{ $service->discount_amount }}
                            @endif
                        </p>
                        <p class="text-sm font-bold text-gray-600">Area: {{ $service->area }}</p>
                    </div>

                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</div>
@endsection