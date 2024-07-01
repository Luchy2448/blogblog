<x-admin-layout :breadcrumb="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
        'url' => route('admin.roles.index'),
    ],
    [
        'name' => 'Nuevo',
    ]
    ]">
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
          <div class="mb-4">
            <ul>
                @foreach ($permissions as $permission)
                    <li>
                        <label>
                         <x-checkbox type="checkbox"
                         name="permissions[]" 
                         value="{{ $permission->id }}"
                         :checked="in_array($permission->id, old('permissions', []))"/>
                         {{ $permission->name }}
                        </label>
                    </li>
                @endforeach  
            </ul>
       </div>
       
            <x-button>Crear rol</x-button>
        </form>
    </div>
</x-admin-layout>