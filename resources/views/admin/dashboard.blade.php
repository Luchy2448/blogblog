<x-admin-layout :breadcrumb="[
    [
        'name' => 'Home',
    ]
    ]">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded shadow-lg px-6 py-4">
          <div class="flex items-center">
            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition flex-shrink-0">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            </button>
            <div class="ml-4">
                <h2 class="text-lg font-semibold text-gray-700">
                    Bienvenido {{ Auth::user()->name }}
                </h2>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm hover:text-blue-500">
                        Cerrar sesión
                    </button>
                </form>
            </div>
          </div>
        </div>
        <div class="bg-white rounded shadow-lg p-6 flex items-center justify-center">
              <h2 class="text-xl font-semibold uppercase text-gray-700">
                Coders Free
              </h2>
        </div>

    </div>
   
</x-admin-layout>