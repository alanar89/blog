<x-app-layout>
    <x-slot name="header">
        {{ __('') }}
    </x-slot>
    <div class="flex flex-col w-full">
        <div class="flex">
            <div class="md:p-4 lg:basis-2/3 w-full rounded-lg shadow-xs flex flex-col ">
                @foreach ($posts as $post)
                    <article class="rounded-xl bg-white w-full p-4 sm:p-6 lg:p-8 mb-10">
                        <div class="flex flex-col sm:gap-4 relative">
                            <div class="">
                                <img class="h-72 w-full rounded-md object-cover" src="/storage/images/{{ $post->photo }}"
                                    alt="">
                            </div>
                            <div class="">
                                <strong
                                    class="rounded-full border hover:bg-indigo-600 absolute right-0 top-0 m-4 border-indigo-500 bg-indigo-500 px-2 py-1 text-sm font-medium text-white">
                                    <a href="{{ route('categories.show', $post->category->name) }}">
                                        {{ $post->category->name }}
                                    </a>
                                </strong>
                                <div class="mt-4 sm:flex sm:items-center sm:gap-2 justify-between ">
                                    <div class="flex items-center gap-1 ">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>

                                        <p class="font-medium">

                                            <a href="{{ route('users.show', $post->user->name) }}"
                                                class="underline uppercase hover:text-indigo-500">{{ $post->user->name }}</a>
                                        </p>
                                        <span class=" mb-3 mx-2  text-7xl text-indigo-500"
                                            aria-hidden="true">&middot;</span>
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                        </svg>

                                        <p class=" font-medium">
                                            {{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}</p>
                                        <span class=" mb-3 mx-2  text-7xl text-indigo-500"
                                            aria-hidden="true">&middot;</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                        </svg>
                                        <p class=" font-medium">

                                            {{ $post->comments->count() }}

                                        </p>
                                    </div>
                                    <div class="flex items-center gap-1 mb-6 sm:mb-0  ">
                                        @foreach ($post->tags as $tag)
                                            <a href="{{ route('tags.show', $tag->name) }}"> <span
                                                    class="mx-1 hover:underline hover:text-indigo-500">#{{ $tag->name }}</span></a>
                                        @endforeach
                                    </div>
                                </div>
                                <p class="text-2xl  text-gray-600 font-bold">
                                    <a href="{{ route('posts.show', $post->title) }}"
                                        class=" hover:text-indigo-500 hover:underline">
                                        {{ $post->title }} </a>
                                </p>
                                <p class="mt-2  text-gray-700">
                                    {{ $post->exerpt }}
                                </p>

                            </div>
                        </div>
                    </article>
                @endforeach
                <div class="m-2 p-2">{{ $posts->links() }}</div>
            </div>
            <div class=" hidden lg:flex p-4  basis-1/3 w-full flex-col">
                <div class="rounded-xl shadow-xs bg-white flex flex-col  sm:p-4 lg:p-6 ">
                    <h3 class="mb-2 pb-4 font-semibold">Recent Posts</h3>
                    <span
                        class=" inset-x-0 top-0 h-1 bg-gradient-to-r  mb-6 rounded from-green-300 via-blue-500 to-purple-600"></span>
                    @foreach ($posts as $post)
                        <article class="my-2">
                            <div class="flex  sm:gap-4 ">

                                <div class="flex min-w-max">
                                    <img class="h-24 w-24 rounded-md " src="/storage/images/{{ $post->photo }}"
                                        alt="">
                                </div>
                                <div class="flex  flex-col">
                                    <p class="text-sm font-light ">
                                        {{ $post->published_at->format('M d, Y') }}
                                    </p>

                                    <p class="text-lg text-gray-600 font-semibold  line-clamp-2">
                                        <a href="{{ route('posts.show', $post->title) }}"
                                            class=" hover:text-indigo-500 hover:underline">
                                            {{ $post->title }} </a>
                                    </p>
                                </div>
                        </article>
                        @if ($loop->iteration == 5)
                        @break
                    @endif
                @endforeach

            </div>
            <div class="rounded-xl shadow-xs bg-white  hidden lg:flex flex-col   w-full mt-10 sm:p-4 lg:p-6 ">
                <h3 class=" mb-2 pb-4 font-semibold">Posts categories </h3>
                <span
                    class=" inset-x-0 top-0 h-1 bg-gradient-to-r  mb-6 rounded from-green-300 via-blue-500 to-purple-600"></span>
                @foreach ($categorias as $categoria)
                    <a class="my-2  cursor-pointer hover:underline hover:text-indigo-500"
                        href="{{ route('categories.show', $categoria->name) }}">
                        {{ $categoria->name }}</a>
                @endforeach
            </div>
            <div class="rounded-xl shadow-xs hidden lg:flex bg-white  flex-col   w-full mt-10 sm:p-4 lg:p-6 ">
                <h3 class=" mb-2 pb-4 font-semibold">Posts Tags </h3>
                <span
                    class=" inset-x-0 top-0 h-1 bg-gradient-to-r  mb-6 rounded from-green-300 via-blue-500 to-purple-600"></span>
                <div class="flex flex-wrap">
                    @foreach ($etiquetas as $etiqueta)
                        <a class="my-2 hover:bg-indigo-600 cursor-pointer border-indigo-500 bg-indigo-500 px-2 py-1 mx-1 text-sm font-medium text-white rounded-full"
                            href="{{ route('tags.show', $etiqueta->name) }}">
                            {{ $etiqueta->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
