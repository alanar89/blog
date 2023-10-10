<x-app-layout>
    <script src="/../vendor/ckeditor5/build/ckeditor.js"></script>
    <script>
        function photo() {
            const img = document.getElementById("foto").files[0].name;
            document.getElementById("demo").innerHTML = img;
        }
    </script>
    <x-slot name="header">
        {{ __('Editar Publicación') }}
    </x-slot>
    <form action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" method="POST">
        @csrf @method('PATCH')
        <div class="flex gap-4 w-full ">
            <div class="relative flex flex-col w-full   bg-white p-3 rounded  ">
                <span
                    class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r rounded-t from-green-300 via-blue-500 to-purple-600"></span>
                <label for="titulo" class="block  mt-4 font-semibold text-gray-700">
                    Titulo de la Publicación
                </label>
                <input type="text" id="titulo" name="titulo" placeholder=""
                    value="{{ old('titulo', $post->title) }}"
                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                @error('titulo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <label for="contenido" class="block  mt-4 font-semibold text-gray-700">
                    Contenido de la Publicación
                </label>

                <textarea id="editor" name="editor" class="">{{ old('editor', $post->body) }}</textarea>
                @error('editor')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <script>
                    ClassicEditor
                        .create(document.querySelector('#editor'))
                        .then(editor => {
                            editor.editing.view.change(writer => {
                                writer.setStyle('height', '200px', editor.editing.view.document.getRoot());
                            });
                            console.log(editor);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                </script>
                <label for="" class="block  mt-4 mb-2 font-semibold text-gray-700">
                    Imagen de la Publicación
                </label>

                <div class="flex items-center relative w-36">
                    <img class="h-32  object-cover " src="/storage/images/{{ $post->photo }}" alt="">
                    <label class="absolute  right-0 top-0 cursor-pointer" title="editar" for="foto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-indigo-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <input id="foto" name="foto" type="file" onchange="photo()" hidden />
                    </label class="">
                </div>
                <p id="demo"></p>
                @error('foto')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="relative flex flex-col w-full  bg-white p-3 rounded">
                <span
                    class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r rounded-t from-green-300 via-blue-500 to-purple-600"></span>
                <label for="" class="block  mt-4 font-semibold text-gray-700">
                    Estado
                </label>
                <div class="flex gap-4 mt-1">
                    <input type="radio" id="activo" checked name="estado" placeholder="" value="1"
                        {{ $post->active == 1 ? ' checked ' : '' }} class="mt-1  sm:text-sm" />Publicado
                    <input type="radio" id="inactivo" name="estado" placeholder="" value="0"
                        {{ $post->active == 0 ? ' checked ' : '' }} class="mt-1 k  sm:text-sm" />Borrador
                </div>
                @error('estado')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <label for=fecha" class="block  mt-4 font-semibold text-gray-700">
                    Fecha de Publicación
                </label>
                <input type="date" id="fecha" name="fecha" placeholder=""
                    value={{ old('fecha', $post->published_at) }}
                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                <label for="categorias" class="block  mt-4 font-semibold text-gray-700">
                    Categorias
                </label>
                <select name="categoria" id="categorias"
                    class="mt-1.5 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                    <option value="">Selecciona una categoria</option>
                    @foreach ($categorias as $categoria)
                        <option {{ old('categoria', $post->category_id) == $categoria->id ? 'selected' : '' }}
                            value={{ $categoria->id }}>
                            {{ $categoria->name }}</option>
                    @endforeach
                </select>
                @error('categoria')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <label for="etiquetas" class="block  font-semibold mt-4 text-gray-700">
                </label>
                <select name="etiquetas[]" id="etiquetas" multiple
                    class="mt-1.5 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm">

                    @foreach ($tags as $tag)
                        <option class="checked:bg-purple-600 checked:text-white"
                            {{ collect(old('etiquetas', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}
                            value={{ $tag->id }}>{{ $tag->name }}</option>
                    @endforeach
                </select>
                <label for="extracto" class="block  mt-4 font-semibold text-gray-700">
                    Extracto Publicación
                </label>
                <textarea name="extracto" id="extracto" placeholder=""
                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm">{{ old('extracto', $post->exerpt) }}</textarea>
                @error('extracto')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <button class="bg-purple-600 rounded mt-4 px-2 py-1 text-white">Guardar Publicación</button>
            </div>
        </div>
    </form>
</x-app-layout>
