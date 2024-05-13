<x-admin-layout>
    @push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
    @csrf
    @method('PUT')

    <x-validation-errors class="mb-4"/>
       
        <div class="mb-4">
            <x-label class="mb-1">
                TÍtulo
            </x-label>

            <x-input 
                name="title"
                value="{{ old('title', $post->title) }}"
                class="block w-full"
                placeholder="Escriba el titulo del post" />
        </div>
        
        <div class="mb-4">
            <x-label class="mb-1">
                TÍtulo
            </x-label>

            <x-input 
                name="slug"
                value="{{ old('slug', $post->slug) }}"
                class="block w-full"
                placeholder="Escriba el slug del post" />
        </div>

        <div class="mb-4">
            <x-label class="mb-1">
                Categoría
            </x-label>
            <x-select class="block w-full" name="category_id">
                @foreach ($categories as $category)
                    <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select>
        </div> 

       <div class="mb-4">
            <x-label class="mb-1">
                Resumen
            </x-label>
            <x-textarea 
            name="excerpt"
            class="block w-full" rows="4">
                {{ old('excerpt', $post->excerpt) }}
            </x-textarea>
        </div>

        <div class="mb-4">
            <x-label class="mb-1">
                Etiquetas
            </x-label>
            <select class="tag-multiple" name="tags[]" multiple="multiple" style="width: 100%">
                @foreach ($post->tags as $tag)
                    <option value="{{ $tag->id }}" selected>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

       <div class="mb-4">
            <x-label class="mb-1">
                Cuerpo
            </x-label>
            <x-textarea 
             name="body"
             class="block w-full" rows="12">
                {{ old('body', $post->body) }}
            </x-textarea>
        </div>
        
        <div class="mb-4">    
            <input type="hidden" value="0" name="published">
            <label class="inline-flex items-center cursor-pointer">
                <input name="published" 
                type="checkbox" 
                value="1" 
                class="sr-only peer"
                @checked(old('published', $post->published) == 1)>
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Publicar</span>
            </label>      
        </div>

          <div class="flex justify-end">
                <!-- Botón de eliminar -->
            <x-danger-button class="mr-2" onclick="deletePost()">
                Eliminar
            </x-danger-button>

            <x-button >
                Actualizar post
            </x-button>
        </div>
    
    </form>
    <!-- Formulario de eliminación -->
    <form action="{{ route('admin.posts.destroy', $post) }}" 
         method="POST"
         id="formDelete">
         @csrf
         @method('DELETE')
 
    </form>
    @push('js')
     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 
     
     <script>
        $(document).ready(function() {
    $('.tag-multiple').select2({
        ajax: {
            url: "{{ route('api.tags.index') }}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    term: params.term
                }
            },
            processResults: function(data) {
                return {
                    results: data
                }
            },
        }
    });
        });
     </script>
     <script>
         function deletePost() {
     
             form = document.getElementById('formDelete');
             form.submit();
         }
 
     </script>
   @endpush
</x-admin-layout>