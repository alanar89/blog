<x-app-layout>
    <div class="flex justify-between my-4">
        <h1 name="header">
            {{ __('Comentarios de ' . $post->title) }}

        </h1>
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
                    <strong class="block font-medium text-gray-900"> Comentario </strong>
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
    <div class=" shadow-xs relative bg-white">
        <div class="m-2">
            <span
                class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r rounded-t from-green-300 via-blue-500 to-purple-600"></span>

            @foreach ($comments as $comment)
                <div class="flex items-center justify-between m-2  border-b">
                    <div class="flex flex-col w-full p-2">

                        <div>
                            <div class="flex items-center gap-2 ">
                                <p class="  text-gray-600 uppercase font-semibold">
                                    {{ $comment->name }}
                                </p>

                                <p class="text-sm text-gray-400">
                                    {{ $comment->created_at ? $comment->created_at->format('M d, Y') : '' }}</p>
                                </p>
                            </div>

                        </div>

                        <div class="">
                            <p class="text-sm">
                                {{ $comment->comment }}
                            </p>
                        </div>

                    </div>
                    <div class="flex">
                        <button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', '{{ $comment->id }}')" class="text-red-500"
                            title="Eliminar">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>
                <x-modal name="{{ $comment->id }}">
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="p-6">
                        @method('DELETE')
                        @csrf
                        <h2 class="text-lg font-medium text-center text-gray-900">
                            {{ __('Esta seguro que desea eliminar el comentario?') }}
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
            @endforeach
        </div>
        <div class="m-2 p-2">{{ $comments->links() }}</div>
    </div>
</x-app-layout>
