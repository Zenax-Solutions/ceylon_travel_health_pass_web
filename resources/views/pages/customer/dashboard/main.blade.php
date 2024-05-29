@extends('layouts.customer')
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
                                Hello, {{ $customer?->first_name . ' ' . $customer?->last_name }}</h1>

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

        <!-- Start Third Row -->
        <div class="items-start w-full px-4 xl:p-0 gap-y-4 md:gap-6">

            <div class="flex flex-col col-span-3 p-6 space-y-6 bg-white border rounded-xl border-gray-50">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-bold tracking-wide text-gray-600">All Bookings</h2>
                </div>
                <div class="flex flex-col">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-800">
                                        <tr>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Booking No
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Package Name
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Tickets Count
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Package Price
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Booking Date
                                            </th>


                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Payment Status
                                            </th>

                                            <th scope="col" class="relative py-3.5 px-4">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

                                        @forelse ($bookings as $booking)
                                            <tr>
                                                <td
                                                    class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">


                                                    <span>#{{ $booking->id }}</span>

                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                    {{ $booking->package->main_title }}
                                                </td>

                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                    {{ $booking->adult_pass_count + $booking->child_pass_count }}
                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                    {{ env('CURRENCY', '$') . $booking->total }}
                                                </td>

                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                    {{ $booking->date->format('Y/m/d') }}
                                                </td>

                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                    @php
                                                        $statusClasses = [
                                                            'pending' =>
                                                                'text-yellow-500 bg-yellow-100/60 dark:bg-gray-800',
                                                            'declined' => 'text-red-500 bg-red-100/60 dark:bg-gray-800',
                                                            'canceled' =>
                                                                'text-gray-500 bg-gray-100/60 dark:bg-gray-800',
                                                            'paid' =>
                                                                'text-green-500 bg-green-100/60 dark:bg-green-800',
                                                        ];

                                                        $statusIcons = [
                                                            'pending' =>
                                                                '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 1v4h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 6.5A4.5 4.5 0 1 1 5.5 2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                                            'declined' =>
                                                                '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1l10 10m0-10L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                                            'canceled' =>
                                                                '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 6h8M6 2v8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                                            'paid' =>
                                                                '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                                        ];

                                                        $paymentStatus = $booking->payment_status;
                                                        $statusText = ucfirst($paymentStatus); // Capitalize the first letter
                                                        $statusClass =
                                                            $statusClasses[$paymentStatus] ??
                                                            'text-gray-500 bg-gray-100/60 dark:bg-gray-800';
                                                        $statusIcon =
                                                            $statusIcons[$paymentStatus] ??
                                                            '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 6h.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
                                                    @endphp

                                                    <div
                                                        class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 {{ $statusClass }}">
                                                        {!! $statusIcon !!}
                                                        <h2 class="text-sm font-normal">{{ $statusText }}</h2>
                                                    </div>
                                                </td>


                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="flex items-center gap-x-6">


                                                        <a href="{{ route('customer.tickets', ['id' => $booking->id]) }}"
                                                            class="font-bold text-blue-500 transition-colors duration-200 hover:text-indigo-500 focus:outline-none">
                                                            View Tickets
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse





                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Third Row -->
    </div>
@endsection
