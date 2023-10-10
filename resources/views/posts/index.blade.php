<x-app-layout>
    <div class="flex justify-between my-4">
        <h1 name="header">
            {{ __('Publicaciones') }}

        </h1>
        <button class="  rounded py-2 px-2  hover:bg-purple-600 text-white bg-purple-500" title="">
            <a href="{{ route('posts.create') }}">Nueva
                Publicación</a>
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
                    <strong class="block font-medium text-gray-900"> Publicación </strong>
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
    <div>
        <div class="relative">
            <span
                class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r rounded-t from-green-300 via-blue-500 to-purple-600"></span>
            <table class=" w-full table-fixed   bg-white text-sm">
                <thead class="text-center">
                    <tr>
                        <th class="whitespace-nowrap  py-3  text-gray-900">
                            Id
                        </th>
                        <th class="whitespace-nowrap  py-3  text-gray-900">
                            Titulo
                        </th>
                        <th class="whitespace-nowrap  py-3  text-gray-900">
                            Extracto
                        </th>
                        <th class="whitespace-nowrap  py-3  text-gray-900">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class=" ">
                    @foreach ($posts as $post)
                        <x-modal name="{{ $post->id }}">
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="p-6">
                                @method('DELETE')
                                @csrf
                                <h2 class="text-lg font-medium text-center text-gray-900">
                                    {{ __('Esta seguro que desea eliminar el post?') }}
                                </h2>

                                <div class="my-6 flex justify-center">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ml-3">
                                        {{ __('Aceptar') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                        <tr class="odd:bg-purple-100 text-center ">
                            <td class="whitespace-nowrap px-4 py-2 font-medium  text-gray-900">
                                {{ $post->id }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700  truncate">{{ $post->title }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 truncate">{{ $post->exerpt }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 ">
                                <div class="flex flex-wrap justify-center items-center gap-2">
                                    <button class="text-indigo-500" title="Mensajes">
                                        <a href="{{ route('comments.show', $post->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                            </svg>

                                        </a>
                                    </button>
                                    <button class="text-indigo-500" title="Ver">
                                        <a href="{{ route('posts.show', $post) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                    </button>
                                    <button class="text-indigo-500 " title="Editar">
                                        <a href="{{ route('posts.edit', $post) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                    </button>
                                    <button x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', '{{ $post->id }}')"
                                        class="text-red-500" title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="m-2 p-2">{{ $posts->links() }}</div>
    </div>
</x-app-layout>
