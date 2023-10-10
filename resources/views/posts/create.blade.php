<x-app-layout>
    <script src="/../vendor/ckeditor5/build/ckeditor.js"></script>
    <style>
        .ck.ck-toolbar.ck-toolbar_grouping>.ck-toolbar__items {
            flex-wrap: wrap !important;
        }
    </style>
    <script>
        function photo() {
            const img = document.getElementById("foto").files[0].name;
            document.getElementById("demo").innerHTML = img;
        }
    </script>
    <x-slot name="header">
        {{ __('Crear Publicación') }}
    </x-slot>
    <form action="{{ route('posts.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="flex flex-col lg:flex-row gap-4 w-full ">
            <div class="relative flex flex-col w-full   bg-white p-3 rounded  ">
                <span
                    class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r rounded-t from-green-300 via-blue-500 to-purple-600"></span>
                <label for="titulo" class="block  mt-4 font-semibold text-gray-700">
                    Titulo de la Publicación
                </label>
                <input type="text" id="titulo" name="titulo" placeholder="" value="{{ old('titulo') }}"
                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                @error('titulo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <label for="contenido" class="block  mt-4 font-semibold text-gray-700">
                    Contenido de la Publicación
                </label>
                <textarea id="editor" name="editor" class="">{{ old('editor') }}</textarea>
                @error('editor')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <script>
                    ClassicEditor
                        .create(document.querySelector('#editor'))
                        .then(editor => {
                            editor.editing.view.change(writer => {
                                writer.setStyle('height', '200px', editor.editing.view.document
                                    .getRoot());
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
                <div class="flex items-center justify-center w-full">
                    <label for="foto"
                        class="flex flex-col items-center justify-center w-full h-52 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50  hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                    to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                            </p>
                        </div>
                        <input id="foto" name="foto" type="file" onchange="photo()" hidden />
                    </label>

                </div>
                <p id="demo"></p>
                @error('foto')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="relative flex flex-col w-full  bg-white p-3 rounded">
                <span
                    class="absolute  hidden lg:block inset-x-0 top-0 h-2 bg-gradient-to-r rounded-t from-green-300 via-blue-500 to-purple-600"></span>
                <label for="" class="block  mt-4 font-semibold text-gray-700">
                    Estado
                </label>
                <div class="flex gap-4 mt-1">
                    <input type="radio" id="activo" checked name="estado" placeholder="" value="1"
                        class="mt-1  sm:text-sm" />Publicado
                    <input type="radio" id="inactivo" name="estado" placeholder="" value="0"
                        class="mt-1 k  sm:text-sm" />Borrador
                </div>
                @error('estado')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <label for="fecha" class="block  mt-4 font-semibold text-gray-700">
                    Fecha de Publicación
                </label>
                <input type="date" id="fecha" name="fecha" placeholder="" value="{{ old('fecha') }}"
                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                <label for="categorias" class="block  mt-4 font-semibold text-gray-700">
                    Categorias
                </label>
                <select name="categoria" id="categorias"
                    class="mt-1.5 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                    <option value="">Selecciona una categoria</option>
                    @foreach ($categorias as $categoria)
                        <option {{ old('categoria') == $categoria->id ? 'selected' : '' }} value={{ $categoria->id }}>
                            {{ $categoria->name }}</option>
                    @endforeach
                </select>
                @error('categoria')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <label for="etiquetas" class="block  font-semibold mt-4 text-gray-700">
                    Etiquetas
                </label>
                <select name="etiquetas[]" max="3" id="etiquetas" multiple
                    class="mt-1.5 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                    {{-- <option value="">Selecciona etiquetas</option> --}}
                    @foreach ($tags as $tag)
                        <option class="checked:bg-purple-600 checked:text-white"
                            {{ collect(old('etiquetas'))->contains($tag->id) ? 'selected' : '' }}
                            value={{ $tag->id }}>{{ $tag->name }}</option>
                    @endforeach
                </select>
                <label for="extracto" class="block  mt-4 font-semibold text-gray-700">
                    Extracto Publicación
                </label>
                <textarea name="extracto" id="extracto" placeholder=""
                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm">{{ old('extracto') }}</textarea>
                @error('extracto')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <button class="bg-purple-600 rounded  mt-6 px-2 py-2 text-white">Guardar Publicación</button>
            </div>
        </div>
    </form>
</x-app-layout>
