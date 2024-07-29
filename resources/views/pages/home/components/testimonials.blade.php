<!-- component -->


<div class="bg-gray-50 flex items-center justify-center">
    <div class="w-full bg-white border-t border-b border-gray-200 px-5 py-16 md:py-24 text-gray-800">
        <div class="w-full max-w-6xl mx-auto">
            <div class="text-center max-w-xl mx-auto">
                <h1 class="text-6xl md:text-7xl font-bold mb-5 text-gray-600">What people <br>are saying.</h1>

                <div class="text-center mb-10">
                    <span class="inline-block w-1 h-1 rounded-full bg-green-500 ml-1"></span>
                    <span class="inline-block w-3 h-1 rounded-full bg-green-500 ml-1"></span>
                    <span class="inline-block w-40 h-1 rounded-full bg-green-500"></span>
                    <span class="inline-block w-3 h-1 rounded-full bg-green-500 ml-1"></span>
                    <span class="inline-block w-1 h-1 rounded-full bg-green-500 ml-1"></span>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($reviews as $review)
                    <div class="rounded-lg bg-white border border-gray-200 p-5 text-gray-800 font-light">
                        <div class="flex mb-4 items-center">
                            <div class="overflow-hidden rounded-full w-10 h-10 bg-gray-50 border border-gray-200">
                                @if (!empty($review->image))
                                    <img src="{{ Storage::url($review->image) }}" alt="">
                                @endif
                            </div>
                            <div class="flex-grow pl-3">
                                <h6 class="font-bold text-sm uppercase text-gray-600">{{ $review->name }}</h6>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm leading-tight">
                                <span class="text-lg leading-none italic font-bold text-gray-400 mr-1">"</span>
                                {{ $review->content }}
                                <span class="text-lg leading-none italic font-bold text-gray-400 ml-1">"</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>e
        </div>
    </div>
</div>
