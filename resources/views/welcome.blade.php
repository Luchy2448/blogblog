<x-app-layout>
    <figure class="mb-12">
        <img src="{{ asset('img/home/portada.webp') }}" 
        class="w-full aspect-[3/1] object-cover object-center" 
        alt="portada del home">
    </figure>
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl text-center font-semibold mb-20">
            Listado de artículos
        </h1>

        <div class="grid grid-cols-4">

            <div class="col-span-1">
                <form action="">

                  <div class="mb-4"> 
                    <p class="text-lg font-semibold text-gray-700">Ordenar:</p>
                    <select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="order">
                        <option value="new">Más nuevos</option>
                        <option value="old" @selected(request('order') == 'old')>Más antiguos</option>
                    </select>
                  </div>
                  <div class="mb-4">
                    <p class="text-lg font-semibold text-gray-700">Categorías:</p>
                    
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <label>
                                        <x-checkbox name="category[]" value="{{ $category->id }}" :checked="is_array(request('category')) && in_array($category->id, request('category'))" />
                                        <span class="ml-2 text-gray-700">{{ $category->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                  </div>
                  <div>
                    <x-button>
                        Aplicar filtro
                    </x-button>
                  </div>
                   
                </form>
            </div>

            <div class="col-span-3">
                <div class="space-y-8">
                    @foreach ($posts as $post)
                        <article class="grid grid-cols-2 gap-6" >
                            
                            <figure>
                                <img src="{{ $post->image }}" 
                                class="aspect-[14/8] object-cover object-center w-full rounded-sm"
                                alt="{{ $post->title }}">
                            </figure>
        
                            <div>
                                 <h1 class="text-xl font-semibold"> 
                                    {{ $post->title }}
                                </h1>
                                <hr class="mt-1 mb-2">
                                <div>
                                    @foreach($post->tags as $tag)
                                     <a href="{{ route('home') . '?tag=' . $tag->name }}">
                                        <span class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 rounded text-xs font-small me-2 px-2.5 py-0.5 text-center">
                                            {{ $tag->name }}
                                        </span>
                                     </a>
                                    @endforeach
                                </div>
        
                                <p class="text-sm mb-2">
                                    {{ $post->published_at->format('d/m/Y') }}
                                </p>
        
                                <div class="mb-4">
                                        {{ Str::limit($post->excerpt, 150, '...') }}
                                </div>
        
                                <div>
                                    <a href="{{ route('posts.show', $post) }}" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Leer más</a>
                                </div>
        
                            </div>
                        
                        </article>  
                    @endforeach
                </div>       
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            </div>

        </div>
        
    </section>



</x-app-layout>