<x-admin-layout>
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

            <x-validation-errors class="mb-4"/>

          <div class="mb-4">
            <x-label class="mb-1">Nombre del rol</x-label>
            <x-input
            name="name" 
            class="w-full"
            placeholder="Ingrese el nombre del rol"
            value="{{ old('name') }}"
            />
          </div>
       
            <x-button>Crear rol</x-button>
        </form>
    </div>
</x-admin-layout>