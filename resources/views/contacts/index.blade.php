<x-app-layout>
    
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
 
        <div class="bg-white p-8 shadow-lg rounded-lg">
            <form action="{{ route('contacts.store') }}" method="POST">

                @csrf

                <x-validation-errors class="mb-4"/>

                <div class="mb-4">
                    <x-label>
                        Nombre
                    </x-label>
                    <x-input type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full"
                    placeholder="Ingrese el nombre del contacto"/>
                </div>

                <div class="mb-4">
                    <x-label>
                        Email
                    </x-label>

                    <x-input type="email"
                    value="{{ old('email') }}"
                    name="email"
                    class="w-full"
                    placeholder="Ingrese el email del contacto"/>
                </div>

                <div class="mb-4">
                    <x-label>
                        Mensaje
                    </x-label>
                    <textarea name="message"
                    value="{{ old('message') }}"
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
                    cols="30"
                    rows="4"
                    placeholder="Escriba su mensaje"></textarea>
                </div>
                
                <div class="flex justify-end">
                    <x-button>
                        Enviar
                    </x-button>
                </div>
            </form>

        </div>

    </section>

</x-app-layout>