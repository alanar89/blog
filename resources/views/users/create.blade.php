<x-app-layout>
    <x-slot name="header">
        {{ __('Crear Usuario') }}
    </x-slot>
    <script>
        function remove() {
            const cartel = document.querySelector("#cartel");
            cartel.remove();
        }
    </script>
    @if (session()->has('flash'))
        <div role="alert" id="cartel" class="rounded-xl border my-4 border-gray-100 bg-white p-4">
            <div class="flex items-start gap-4">
                <span class="text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <div class="flex-1">
                    <strong class="block font-medium text-gray-900"> Usuario </strong>
                    <p class="mt-1 text-sm text-gray-700">
                        {{ session('flash') }}
                    </p>
                </div>
                <button onclick="remove()" class="text-gray-500 transition hover:text-gray-600">
                    <span class="sr-only">Dismiss popup</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
    <div class=" relative rounded-xl shadow-xs bg-white flex flex-col   w-full mb-4 p-4 lg:p-6 ">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class=" flex flex-col md:flex-row gap-4">
                <div class="w-full ">
                    <span
                        class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r rounded-t from-green-300 via-blue-500 to-purple-600"></span>
                    <label for="titulo" class="block  mt-4 font-semibold text-gray-700">
                        Nombre
                    </label>
                    <input required type="text" id="name" name="name" placeholder=""
                        value="{{ old('name') }}"
                        class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <label for="contenido" class="block  mt-4 font-semibold text-gray-700">
                        Email
                    </label>
                    <input required type="email" id="email" name="email" placeholder=""
                        value="{{ old('email') }}"
                        class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                    @error('mail')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <label for="" class="block  mt-4 font-semibold text-gray-700">
                        Rol
                    </label>
                    <select name="rol" id=""
                        class="mt-1.5 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                        <option {{ old('rol') == 'writer' ? 'selected' : '' }} value="writer">Escritor
                        </option>
                        <option {{ old('rol') == 'admin' ? 'selected' : '' }} value="admin">Administrador
                        </option>
                    </select>
                    @error('rol')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full">
                    <label for="contenido" class="block  mt-4 font-semibold text-gray-700">
                        Contraseña
                    </label>
                    <input required type="password" name="password" placeholder="" value="{{ old('password') }}"
                        class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <label for="contenido" class="block  mt-4 font-semibold text-gray-700">
                        Repetir Contraseña
                    </label>
                    <input required type="password" name="password_confirmation" placeholder=""
                        value="{{ old('password_confirmation') }}"
                        class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button class="bg-purple-600  mt-6 px-2 py-2 rounded  text-white">Registar</button>
        </form>
    </div>
</x-app-layout>
