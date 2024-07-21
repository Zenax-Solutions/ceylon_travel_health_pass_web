@extends('layouts.app')
@section('content')
<!-- Live Chat -->
@include('pages.home.components.chatwidget')


<!-- component -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4 mb-12">
    <article>
        <h2 class="text-2xl font-extrabold text-gray-900">Our Blogs</h2>
        <section class="mt-6 grid md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8">

            @forelse($blogs as $blog)

            <article class="bg-white group relative rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transform duration-200">
                <div class="relative w-full h-80 md:h-64 lg:h-44">
                    <img src="{{Storage::url($blog->image)}}" alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." class="w-full h-full object-center object-cover">
                </div>
                <div class="px-3 py-4">
                    <h3 class="text-lg font-bold text-white pb-2">
                        <a class="text-green-400 rounded-lg" href="{{ route('blogs.page',['slug' => $blog->slug]) }}">
                           {{$blog->title}}
                        </a>
                    </h3>
                    <p class="text-sm font-bold text-black group-hover:text-black">
                       {{ Str::limit($blog->seo_description,100)}}
                    </p>
                </div>
            </article>

            @empty
            @endforelse

        </section>
    </article>
</section>


@endsection