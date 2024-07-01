<x-admin-layout :breadcrumb="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
        'url' => route('admin.users.index'),
    ],
    [
        'name' => $user->name,
    ]
    ]">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
      <div class="mb-4">
            <x-label>Nombre</x-label>
            <x-input 
               class="w-full"
               name="name" 
               value="{{ old('name', $user->name) }}"/>
      </div>
      <div class="mb-4">
        <x-label>Email</x-label>
        <x-input 
           class="w-full"
           type="email"
           name="email" 
           value="{{ old('email', $user->email) }}"/>
      </div>
      <div class="mb-4">
        <x-label>Password</x-label>
        <x-input 
           type="password"
           class="w-full"
           name="password"/>
      </div>
      <div class="mb-4">
        <x-label>Confirmar Password</x-label>
        <x-input 
           type="password"
           class="w-full"
           name="password_confirmation"/>
      </div>
      <div class="mb-4">
            <ul>
                <x-label>Roles</x-label>
                @foreach ($roles as $role)
                   <li>
                    <label>
                        <x-checkbox type="checkbox"
                        name="roles[]" 
                        value="{{ $role->id }}"
                        :checked="in_array($role->id, old('roles', $user->roles->pluck('id')->toArray()))"/>
                        {{ $role->name }}
                    </label>
                   </li>
                @endforeach
            </ul>
      </div>
    <div class="flex justify-end">
        <x-button>Actualizar</x-button>
    </div>
</form>
    </div>
</x-admin-layout>