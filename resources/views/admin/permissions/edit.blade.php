<x-admin-layout :breadcrumb="[
  [
      'name' => 'Home',
      'url' => route('admin.dashboard'),
  ],
  [
      'name' => 'Permisos',
      'url' => route('admin.permissions.index'),
  ],
  [
      'name' => $permission->name,
  ]
  ]">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        
        <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4"/>

          <div class="mb-4">
            <x-label class="mb-1">Nombre del permiso</x-label>
            <x-input
            name="name" 
            class="w-full"
            placeholder="Ingrese el nombre del permiso"
            value="{{ old('name', $permission->name) }}"
            />
          </div>
        <div class="flex">

            <x-button>Actualizar permiso</x-button>
            <!-- Botón de eliminar -->
            <x-danger-button class="ml-2" onclick="deletePermission()">
            Eliminar
            </x-danger-button>
       
            
        </div>
        </form>
 
    <!-- Formulario de eliminación -->
   <form action="{{ route('admin.permissions.destroy', $permission) }}" 
   method="POST"
   id="formDelete">
   @csrf
   @method('DELETE')

</form>   
</div>
@push('js')

<script>
   function deletePermission() {

       form = document.getElementById('formDelete');
       form.submit();
   }

</script>
  
@endpush

</x-admin-layout>