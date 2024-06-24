@extends('layouts.agent')
@section('content')
    <section class="pt-20 lg:pt-[120px] pb-10 lg:pb-20 bg-[#F3F4F6]">
        <div class="container">
            <div class="flex flex-wrap -mx-4">


                @forelse ($packages as $package)
                    <div class="w-full px-4 md:w-1/2 xl:w-1/3">
                        <div class="mb-10 overflow-hidden bg-white rounded-lg">
                            <img src="{{ Storage::url($package->gallery[0]) }}" alt="image"
                                class="object-cover w-full max-h-80" />
                            <div class="p-8 text-center sm:p-9 md:p-7 xl:p-9">
                                <h3 class="text-4xl font-black text-green-400 ">
                                    {{ $package->main_title }}</h3>
                                <p class="pt-2 pb-2 text-3xl font-bold leading-none text-red-500 align-baseline">Discount
                                    Price</p>
                                <p class="pt-2 pb-4">
                                    <span class="pt-4 pb-4 text-4xl font-bold leading-none text-red-500 align-baseline">

                                        @php
                                            $agentDiscountMargin = $agent->agent_discount_margin;

                                            $discount = 0;

                                            if ($agentDiscountMargin > 5) {
                                                $discount = $agentDiscountMargin;
                                            } else {
                                                $discount = env('AGENT_DISCONUNT_MARGIN', 5);
                                            }

                                        @endphp


                                        {{ env('CURRENCY', '$') . number_format($package->price - $discount) }}</span>

                                </p>



                                <div>
                                    <p class="text-base text-gray-500 md:text-lg">
                                    <h1 class="text-lg font-black text-gray-800 md:text-2xl">Travel</h1>
                                    {!! $package->travel_info !!}
                                    </p>
                                    <p class="text-base text-gray-500 md:text-lg">
                                    <h1 class="text-lg font-black text-gray-800 md:text-2xl">Health</h1>
                                    {!! $package->health_info !!}
                                    </p>
                                </div>
                                <a href="{{ route('agent.booking', ['id' => $package->id]) }}"
                                    class=" mt-4
                      inline-block
                      py-2
                      px-7
                      border border-[#E5E7EB]
                      rounded-full
                      text-base text-body-color
                      font-medium
                      hover:border-primary hover:bg-primary hover:text-white
                      transition
                      bg-green-400
                      ">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse



            </div>
        </div>
    </section>
@endsection
