@auth
    <x-app-layout>
        @section('meta-title', $post->title)
    @section('meta-description', $post->exerpt)
    <article class="rounded-xl bg-white w-full p-4 sm:p-6 mt-10 lg:p-8 mb-10">
        <div class="flex flex-col sm:gap-4 relative">
            <div class="">
                <img class=" rounded-md " src="/storage/images/{{ $post->photo }}" alt="">
            </div>
            <strong
                class="rounded-full border hover:bg-indigo-600 absolute right-0 top-0 m-4 border-indigo-500 bg-indigo-500 px-2 py-1 text-sm font-medium text-white">
                <a href="{{ route('categories.show', $post->category->name) }}">
                    {{ $post->category->name }}
                </a>
            </strong>
            <div class="mt-4 sm:flex sm:items-center sm:gap-2 justify-between ">
                <div class="flex items-center gap-1 ">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>

                    <p class=" font-medium">

                        <a href="{{ route('users.show', $post->user->name) }}"
                            class="underline uppercase hover:text-indigo-500">{{ $post->user->name }}</a>
                    </p>
                    <span class=" mb-3 mx-2  text-7xl text-indigo-500" aria-hidden="true">&middot;</span>
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                    </svg>

                    <p class=" font-medium">
                        {{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}</p>
                </div>
                <div class="flex items-center gap-1 ">
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('tags.show', $tag->name) }}"> <span
                                class="mx-1 hover:underline hover:text-indigo-500">#{{ $tag->name }}</span></a>
                    @endforeach
                </div>
            </div>
            <p class=" mt-4 md:mt-0 text-5xl  text-gray-600 font-bold">
                {{ $post->title }}
            </p>
            <p class="mt-6 md:mt-2  text-gray-700">
                {!! $post->body !!}
            </p>
        </div>
    </article>
    @include('layouts.comments')
</x-app-layout>
@else
<!DOCTYPE html>
<html x-data="data" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @section('meta-title', $post->title)
    @section('meta-description', $post->exerpt)

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Scripts -->
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
</head>

<body>
    @include('layouts.nav')
    <div class="flex flex-col">
        @if (session()->has('flash'))
            <div role="alert" id="cartel" class="  rounded-lg my-2 p-4  border-gray-100 bg-white ">
                <div class="flex items-start gap-4">
                    <span class="text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <div class="flex-1">
                        <strong class="block font-medium text-gray-900"> Exito</strong>
                        <p class="mt-1 text-sm text-gray-700">
                            {{ session('flash') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif
        <div class="flex items-center min-h-screen p-6 w-full bg-gray-100">

            <div class="flex flex-col lg:flex-row w-full">
                <div class="md:p-4 basis-2/3 w-full rounded-lg shadow-xs flex flex-col ">
                    <article class="rounded-xl bg-white w-full p-4 sm:p-6 lg:p-8 mb-10">
                        <div class="flex flex-col sm:gap-4 relative">
                            <div class="">
                                <img class=" w-full rounded-md object-cover" src="/storage/images/{{ $post->photo }}"
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

                                        <p class="mt-2 font-medium  sm:mt-0">

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
                                            {{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}
                                        </p>
                                    </div>

                                </div>
                                <p class="text-5xl  text-gray-600 font-bold">
                                    {{ $post->title }}
                                </p>
                                <p class="mt-2  text-gray-700">
                                    {!! $post->body !!}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col mx-5 md:flex-row md:justify-between items-center mt-10 ">
                            <div class="flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->

                                    <path
                                        d="M345 39.1L472.8 168.4c52.4 53 52.4 138.2 0 191.2L360.8 472.9c-9.3 9.4-24.5 9.5-33.9 .2s-9.5-24.5-.2-33.9L438.6 325.9c33.9-34.3 33.9-89.4 0-123.7L310.9 72.9c-9.3-9.4-9.2-24.6 .2-33.9s24.6-9.2 33.9 .2zM0 229.5V80C0 53.5 21.5 32 48 32H197.5c17 0 33.3 6.7 45.3 18.7l168 168c25 25 25 65.5 0 90.5L277.3 442.7c-25 25-65.5 25-90.5 0l-168-168C6.7 262.7 0 246.5 0 229.5zM144 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                                </svg>
                                @foreach ($post->tags as $tag)
                                    <a href="{{ route('tags.show', $tag->name) }}"> <span
                                            class="rounded border border-indigo-600 px-2 py-1 text-sm font-medium text-indigo-600 hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:bg-indigo-500 transition-colors duration-100  ">{{ $tag->name }}</span></a>
                                @endforeach
                            </div>
                            <div class="flex gap-4 my-5 md:my-0 items-center">
                                <a href="https://api.whatsapp.com/send?text={{ $post->title }} {{ request()->fullUrl() }}"
                                    class="hover:opacity-70" target="blank" title="compartir en Whatsapp">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em"
                                        viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path
                                            d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                    </svg>
                                </a>
                                <a href="https://www.facebook.com/sharer.php?u={{ request()->fullUrl() }}&title={{ $post->title }}"
                                    title="compartir en Facebook" class="hover:opacity-70" target="blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em"
                                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path
                                            d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
                                    </svg>
                                </a>
                                <a href="https://twitter.com/share?url={{ request()->fullUrl() }}&text={{ $post->title }}&via={{ config('app.name') }}&hashtags={{ config('app.name') }}"
                                    class="hover:opacity-70" title="compartir en X" target="blank">

                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em"
                                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path
                                            d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                    </svg>
                                </a>
                                <a href="https://pinterest.com/pin/create/bookmarklet/?&url={{ request()->fullUrl() }}&description={{ $post->title }}"
                                    class="hover:opacity-70" title="compartir en Pinterest" target="blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em"
                                        viewBox="0 0 496 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path
                                            d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    @include('layouts.comments')
                </div>
                <div class="flex md:p-4  basis-1/3 w-full flex-col">
                    <div class="rounded-xl shadow-xs bg-white flex flex-col  p-4 lg:p-6 ">
                        <h3 class="mb-2 pb-4 font-semibold">Related Posts</h3>
                        <span
                            class=" inset-x-0 top-0 h-1 bg-gradient-to-r  mb-6 rounded from-green-300 via-blue-500 to-purple-600"></span>
                        @foreach ($posts as $post)
                            <article class="my-2">
                                <div class="flex  gap-4 ">

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
                <div class="rounded-xl shadow-xs bg-white flex flex-col   w-full mt-10 p-4 lg:p-6 ">
                    <h3 class=" mb-2 pb-4 font-semibold">Posts categories </h3>
                    <span
                        class=" inset-x-0 top-0 h-1 bg-gradient-to-r  mb-6 rounded from-green-300 via-blue-500 to-purple-600"></span>
                    @foreach ($categorias as $categoria)
                        <a class="my-2  cursor-pointer hover:underline hover:text-indigo-500"
                            href="{{ route('categories.show', $categoria->name) }}">
                            {{ $categoria->name }}</a>
                    @endforeach
                </div>
                <div class="rounded-xl shadow-xs bg-white flex flex-col   w-full mt-10 p-4 lg:p-6 ">
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
    <div>
        @include('layouts.footer')
    </div>
    <script>
        const cartel = document.querySelector("#cartel");
        setTimeout(function() {
            cartel.remove();
        }, 2000);
    </script>
</body>

</html>
@endauth
