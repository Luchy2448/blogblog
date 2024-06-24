<x-admin-layout>
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        
        <form action="{{ route('admin.roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4"/>

          <div class="mb-4">
            <x-label class="mb-1">Nombre del rol</x-label>
            <x-input
            name="name" 
            class="w-full"
            placeholder="Ingrese el nombre del rol"
            value="{{ old('name', $role->name) }}"
            />
          </div>
        <div class="flex">

            <x-button>Actualizar rol</x-button>
            <!-- Botón de eliminar -->
            <x-danger-button class="ml-2" onclick="deleteRol()">
            Eliminar
            </x-danger-button>
       
            
        </div>
        </form>
 
    <!-- Formulario de eliminación -->
   <form action="{{ route('admin.roles.destroy', $role) }}" 
   method="POST"
   id="formDelete">
   @csrf
   @method('DELETE')

</form>   
</div>
@push('js')

<script>
   function deleteRol() {

       form = document.getElementById('formDelete');
       form.submit();
   }

</script>
  
@endpush

</x-admin-layout>