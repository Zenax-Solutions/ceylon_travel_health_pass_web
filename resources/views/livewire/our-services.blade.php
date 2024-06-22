<div>

    <!-- Start Third Row -->
    <div class="items-start w-full px-4 xl:p-0 gap-y-4 md:gap-6">

        <div class="flex flex-col col-span-3 p-6 space-y-6 bg-white border rounded-xl border-gray-50">

            <div class="flex items-center justify-between">
                <h2 class="text-sm font-bold tracking-wide text-gray-600">My Services</h2>
                <button
                    class="middle none center mr-4 rounded-lg bg-green-500 py-3 px-6 font-sans text-sm font-bold  text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    data-ripple-light="true" id="open-panel">
                    Add Service
                </button>
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
                                            Name
                                        </th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            Image
                                        </th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            Location
                                        </th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            Area
                                        </th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            Discount Percentage
                                        </th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            Options
                                        </th>
                                    </tr>

                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

                                    @if ($agent->type == 'discount_agent')
                                        @forelse ($agent->discountShops as $record)
                                            <tr>
                                                <td
                                                    class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">


                                                    <span>{{ $record->shope_name }}</span>

                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                    <div class="relative inline-block shrink-0 rounded-2xl me-3">
                                                        <img src="{{ Storage::url($record->image) }}"
                                                            class="inline-block w-24 shrink-0 rounded-2xl"
                                                            alt="">
                                                    </div>
                                                </td>


                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                    <div
                                                        class="inline-flex items-center px-3 py-1 text-red-500 bg-yellow-100 rounded-full gap-x-2 dark:bg-gray-800">
                                                        {{ $record->location }}
                                                    </div>
                                                </td>

                                                <td
                                                    class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">


                                                    <span>{{ $record->area }}</span>

                                                </td>

                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                    {{ $record->discount_amount }}%
                                                </td>

                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">

                                                    @if ($record->status == 'pending')
                                                        <div
                                                            class="inline-flex items-center px-3 py-1 text-red-500 bg-red-100 rounded-full gap-x-2 dark:bg-gray-800">
                                                            Pending
                                                        </div>
                                                    @elseif ($record->status == 'publish')
                                                        <div
                                                            class="inline-flex items-center px-3 py-1 text-black bg-green-400 rounded-full gap-x-2 dark:bg-gray-800">
                                                            Approved
                                                        </div>
                                                    @endif


                                                </td>

                                                <td
                                                    class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">


                                                    <button type="button" wire:click='remove({{ $record->id }})'
                                                        wire:confirm="Are you sure you want to delete this service?"
                                                        class="px-2 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline">remove</button>

                                                </td>


                                            </tr>
                                        @empty
                                        @endforelse
                                    @elseif ($agent->type == 'service_agent')
                                        @forelse ($agent->discountServices as $record)
                                            <tr>
                                                <td
                                                    class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">


                                                    <span>{{ $record->service_name }}</span>

                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                    <div class="relative inline-block shrink-0 rounded-2xl me-3">
                                                        <img src="{{ Storage::url($record->image) }}"
                                                            class="inline-block w-24 shrink-0 rounded-2xl"
                                                            alt="">
                                                    </div>
                                                </td>


                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                    <div
                                                        class="inline-flex items-center px-3 py-1 text-red-500 bg-yellow-100 rounded-full gap-x-2 dark:bg-gray-800">
                                                        {{ $record->location }}
                                                    </div>
                                                </td>

                                                <td
                                                    class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">


                                                    <span>{{ $record->area }}</span>

                                                </td>

                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">
                                                    {{ $record->discount_amount }}%
                                                </td>

                                                <td
                                                    class="px-4 py-4 text-sm font-bold text-black dark:text-gray-300 whitespace-nowrap">

                                                    @if ($record->status == 'pending')
                                                        <div
                                                            class="inline-flex items-center px-3 py-1 text-red-500 bg-red-100 rounded-full gap-x-2 dark:bg-gray-800">
                                                            Pending
                                                        </div>
                                                    @elseif ($record->status == 'publish')
                                                        <div
                                                            class="inline-flex items-center px-3 py-1 text-black bg-green-400 rounded-full gap-x-2 dark:bg-gray-800">
                                                            Approved
                                                        </div>
                                                    @endif


                                                </td>

                                                <td
                                                    class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">

                                                    <button type="button" wire:click='remove({{ $record->id }})'
                                                        wire:confirm="Are you sure you want to delete this service?"
                                                        class="px-2 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline">remove</button>


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
            </div>
        </div>
    </div>
    <!-- End Third Row -->


    <!-- Side Panel -->
    <div wire:ignore.self id="side-panel"
        class="fixed top-0 right-0 hidden w-full h-full p-6 bg-white shadow-lg side-panel sm:w-1/3">
        <h2 class="mb-4 text-2xl font-bold">{{ $formTitle }}</h2>
        <form wire:submit.prevent="submit">

            <div class="mb-4">
                <label class="block font-bold text-gray-700">Shop Name</label>
                <input type="text" wire:model="service_name" id="service_name"
                    class="w-full px-3 py-2 border rounded" required>
                @error('service_name')
                    <span class="font-bold text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-bold text-gray-700 ">Image</label>
                <input type="file" wire:model="image" id="image" class="w-full px-3 py-2 border rounded">
                @error('image')
                    <span class="font-bold text-red-500">{{ $message }}</span>
                @enderror

                @if ($image)
                    <div class="mt-4">
                        <label class="block font-bold text-gray-700">Preview:</label>
                        <img src="{{ $image->temporaryUrl() }}" alt="Image Preview"
                            class="object-cover w-32 h-32 rounded">
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label for="location" class="block font-bold text-gray-700">Location</label>
                <input type="text" wire:model="location" id="location" class="w-full px-3 py-2 border rounded">
                @error('location')
                    <span class="font-bold text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="area" class="block font-bold text-gray-700">Area</label>
                <input type="text" id="area" wire:model="area" id="area"
                    class="w-full px-3 py-2 border rounded">
                @error('area')
                    <span class="font-bold text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="discount_amount" class="block font-bold text-gray-700">Discount Amount</label>
                <input type="number" wire:model="discount_amount" id="discount_amount"
                    class="w-full px-3 py-2 border rounded">
                @error('discount_amount')
                    <span class="font-bold text-red-500">{{ $message }}</span>
                @enderror
            </div>



            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Submit</button>

            <button wire:click='cleanData()' type="button" id="panel-close"
                class="px-4 py-2 text-white bg-red-500 rounded">Close</button>
        </form>
    </div>



    <script>
        document.getElementById('panel-close').addEventListener('click', function() {
            document.getElementById('side-panel').classList.add('hidden');

            document.getElementById('service_name').value = '';
            document.getElementById('image').value = '';
            document.getElementById('location').value = '';
            document.getElementById('area').value = '';
            document.getElementById('discount_amount').value = '';
        });


        document.getElementById('open-panel').addEventListener('click', function() {
            document.getElementById('side-panel').classList.remove('hidden');
        });

        window.addEventListener('openSidePanel', event => {
            document.getElementById('side-panel').classList.remove('hidden');
        });
    </script>

</div>
