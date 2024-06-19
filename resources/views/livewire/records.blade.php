<div>

    @if ($records != null)
        <!-- Start Third Row -->
        <div class="items-start w-full px-4 xl:p-0 gap-y-4 md:gap-6">

            <div class="grid grid-cols-1 gap-4 mt-4 mb-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <div class="flex items-start p-4 bg-white shadow-lg rounded-xl">
                    <div
                        class="flex items-center justify-center w-12 h-12 border border-blue-100 rounded-full bg-blue-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </div>

                    <div class="ml-4">
                        <h2 class="font-semibold">Today Scanned Records Count</h2>
                        <p class="mt-2 text-lg font-bold text-gray-500">{{ number_format($todayCount) }}</p>
                    </div>
                </div>

                <div class="flex items-start p-4 bg-white shadow-lg rounded-xl">
                    <div
                        class="flex items-center justify-center w-12 h-12 border border-blue-100 rounded-full bg-blue-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </div>

                    <div class="ml-4">
                        <h2 class="font-semibold">Monthly Scanned Records Count</h2>
                        <p class="mt-2 text-lg font-bold text-gray-500">{{ number_format($monthlyCount) }}</p>
                    </div>
                </div>
            </div>


            <div class="flex flex-col col-span-3 p-6 space-y-6 bg-white border rounded-xl border-gray-50">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-bold tracking-wide text-gray-600">{{ $title }}</h2>
                </div>
                <div class="flex flex-col">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-800">

                                        @if ($agent->type == 'discount_agent')
                                            <tr>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Shop
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Ticket No.
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Status
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Date
                                                </th>


                                            </tr>
                                        @elseif($agent->type == 'service_agent')
                                            <tr>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Service
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Ticket No.
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Status
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Date
                                                </th>


                                            </tr>
                                        @endif
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

                                        @if ($agent->type == 'discount_agent')
                                            @forelse ($records as $record)
                                                <tr>
                                                    <td
                                                        class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">


                                                        <span>{{ $record->discountShop->shope_name }}</span>

                                                    </td>
                                                    <td
                                                        class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                        {{ $record->ticket_id }}
                                                    </td>

                                                    <td
                                                        class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                        <div
                                                            class="inline-flex items-center px-3 py-1 text-red-500 bg-red-100 rounded-full gap-x-2 dark:bg-gray-800">
                                                            {{ $record->status }}
                                                        </div>
                                                    </td>

                                                    <td
                                                        class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                        {{ $record->date }}
                                                    </td>

                                                </tr>
                                            @empty
                                            @endforelse
                                        @elseif ($agent->type == 'service_agent')
                                            @forelse ($records as $record)
                                                <tr>
                                                    <td
                                                        class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">


                                                        <span>{{ $record->discountService->service_name }}</span>

                                                    </td>
                                                    <td
                                                        class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                        {{ $record->ticket_id }}
                                                    </td>

                                                    <td
                                                        class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">

                                                        <div
                                                            class="inline-flex items-center px-3 py-1 text-red-500 bg-red-100 rounded-full gap-x-2 dark:bg-gray-800">

                                                            {{ $record->status }}
                                                        </div>


                                                    </td>

                                                    <td
                                                        class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                        {{ $record->date }}
                                                    </td>


                                                </tr>
                                            @empty
                                            @endforelse
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    {{ $records->links() }}
                </div>
            </div>
        </div>
        <!-- End Third Row -->
    @endif

</div>
