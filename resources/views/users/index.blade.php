<x-app-layout>
    <div class="flex justify-between my-4">
        <h1 name="header">
            {{ __('Usuarios') }}

        </h1>
        <button class="  rounded py-2 px-2  hover:bg-purple-600 text-white bg-purple-500" title="">
            <a href="{{ route('users.create') }}">Nuevo
                Usuario</a>
        </button>
    </div>
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
                    <strong class="block font-medium text-gray-900"> Exito </strong>
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
    @error('etiqueta')
        <div role="alert" id="cartel" class="rounded-xl border my-4 border-gray-100 bg-white p-4">
            <div class="flex items-start gap-4">
                <span class="text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                </span>
                <div class="flex-1">
                    <strong class="block font-medium text-gray-900"> Error</strong>
                    <p class="mt-1 text-sm text-gray-700">
                        {{ $message != 'El campo etiqueta ya ha sido registrado.' ? $message : 'La etiqueta que intenta ingresar ya se encuentra registrada.' }}

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
    @enderror

    <div>
        <div class="relative">
            <span
                class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r rounded-t from-green-300 via-blue-500 to-purple-600"></span>
            <table class=" w-full table-fixed   bg-white text-sm">
                <thead class="text-center">
                    <tr>

                        <th class="whitespace-nowrap  py-3  text-gray-900">
                            Nombre
                        </th>
                        <th class="whitespace-nowrap  py-3  text-gray-900">
                            Email
                        </th>

                        <th class="whitespace-nowrap  py-3  text-gray-900">
                            Rol
                        </th>
                        <th class="whitespace-nowrap  py-3  text-gray-900">
                            Estado
                        </th>
                        <th class="whitespace-nowrap  py-3  text-gray-900">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class=" ">
                    @foreach ($users as $user)
                        <x-modal name="{{ $user->id }}">
                            <form action="{{ route('users.update', $user) }}" method="POST" class="">
                                @method('PATCH')
                                @csrf
                                <h2 class="text-lg font-medium text-center p-6 text-gray-900">
                                    {{ __('Actualizar Usuario') }}
                                </h2>

                                <div class="p-6 flex flex-col justify-center">
                                    <div class="flex flex-col">
                                        <label for="" class="block  mt-4 font-semibold text-gray-700">
                                            Rol
                                        </label>
                                        <select name="rol" id=""
                                            class="mt-1.5 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                                            <option {{ old('rol', $user->rol) == 'writer' ? 'selected' : '' }}
                                                value="writer">
                                                Escritor
                                            </option>
                                            <option {{ old('rol', $user->rol) == 'admin' ? 'selected' : '' }}
                                                value="admin">
                                                Administrador
                                            </option>
                                        </select>
                                        @error('rol')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                        <label for="" class="block  mt-4 font-semibold text-gray-700">
                                            Estado
                                        </label>
                                        <select name="estado" id=""
                                            class="mt-1.5 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                                            <option {{ old('estado', $user->active) == '1' ? 'selected' : '' }}
                                                value="1">
                                                Activo
                                            </option>
                                            <option {{ old('estado', $user->active) == '0' ? 'selected' : '' }}
                                                value="0">
                                                Inactivo
                                            </option>
                                        </select>
                                        @error('estado')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="mt-4">
                                        <button class="ml-3 py-1 px-2  rounded class-name hover:bg-gray-200 bg-gray-100"
                                            x-on:click.prevent="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </button>

                                        <button
                                            class="ml-3 py-1 px-2 text-white rounded class-name hover:bg-purple-600 bg-purple-500">
                                            {{ __('Aceptar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </x-modal>
                        <tr class="odd:bg-purple-100 text-center ">

                            <td class="whitespace-nowrap px-4 py-2 text-gray-700  truncate">
                                {{ $user->name }}

                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700  truncate">
                                {{ $user->email }}

                            </td>

                            <td class="whitespace-nowrap px-4 py-2 text-gray-700  truncate">
                                {{ $user->rol }}

                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700  truncate">
                                {{ $user->active == 1 ? 'Activo' : 'Inactivo' }}

                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 ">
                                <div class="flex justify-center items-center">
                                    <button x-on:click.prevent="$dispatch('open-modal', '{{ $user->id }}')"
                                        class="text-indigo-500 mx-4" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="m-2 p-2">{{ $users->links() }}</div>
    </div>
</x-app-layout>
