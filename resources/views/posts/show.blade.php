<x-app-layout>

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="mb-2">
            @foreach($post->tags as $tag)
                <span class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 rounded text-xs font-small me-2 px-2.5 py-0.5 text-center">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>

        <h1 class="text-4xl font-semibold text-gray-700"> 
            {{ $post->title }}
        </h1>

        <hr class="mt-1 mb-2">
        
        <p class="text-sm mb-6 text-gray-500">
            {{ $post->published_at->format('d/m/Y') }} - {{ $post->user->name }}
        </p>

        <figure class="mb-6">
            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="aspect-[16/9] object-cover object-center w-full">
        </figure>

        <div>
            {!! $post->body !!}
        </div>

    </section>


</x-app-layout>