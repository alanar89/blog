<div class="rounded-xl shadow-xs bg-white flex flex-col   w-full  p-4 sm:p-6 mt-5 lg:p-8 mb-10 ">
    <h3 class=" mb-2 pb-4 font-semibold">Comentarios</h3>
    <span class=" inset-x-0 top-0 h-1 bg-gradient-to-r  mb-6 rounded from-green-300 via-blue-500 to-purple-600"></span>
    <div class="flex flex-col ">
        @foreach ($post->comments as $comment)
            <div class="mb-4">
                <div class="flex items-center gap-2 ">
                    <p class="  text-gray-600 uppercase font-semibold">
                        {{ $comment->name }}
                    </p>

                    <p class="text-sm text-gray-400">
                        {{ $comment->created_at ? $comment->created_at->format('M d, Y') : '' }}</p>
                    </p>
                </div>
                <div class="mb-4">
                    <p class="text-sm">
                        {{ $comment->comment }}
                    </p>
                </div>
                <hr>
            </div>
        @endforeach
        @if (count($post->comments) < 1)
            <p>no hay comentarios.</p>
        @endif
    </div>
</div>
@guest
    <div class="rounded-xl shadow-xs bg-white flex flex-col   w-full mb-4 p-4 lg:p-6 ">
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <div class="flex gap-4 w-full ">
                <div class=" flex flex-col w-full">
                    <div>
                        <label for="mensaje" class="block  mt-4 font-semibold text-gray-700">
                            Mensaje
                        </label>
                        <textarea name="mensaje" id="mensaje" placeholder="" required
                            class="mt-1 w-full h-40 rounded-md border-gray-200 shadow-sm sm:text-sm">{{ old('mensaje') }}</textarea>
                        @error('mensaje')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex gap-4">
                        <div class="w-full">
                            <label for="nombre" class="block  mt-4 font-semibold text-gray-700">
                                Nombre
                            </label>
                            <input type="text" id="nombre" name="nombre" required placeholder=""
                                value="{{ old('nombre') }}"
                                class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="mail" class="block  mt-4 font-semibold text-gray-700">
                                Email
                            </label>
                            <input type="email" required id="email" name="email" placeholder=""
                                value="{{ old('email') }}"
                                class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                            @error('mail')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="text" name="post" id="post" hidden value="{{ $post->id }}">
                    </div>

                </div>

            </div>
            <button class="bg-purple-600 rounded mt-6 px-2 py-2  text-white">Comentar</button>
        </form>
    </div>
@endguest
