<header class="z-10  bg-white shadow-md">
    <div class="mx-auto flex h-16 max-w-screen-xl  items-center gap-8 px-4 sm:px-6 lg:px-8 ">
        <a class="" href="{{ route('index') }}">
            <img class="h-12" src="{{ asset('images/logos.png') }}" alt="logo" />
        </a>

        <div class="flex flex-1 items-center justify-end md:justify-between">
            <nav aria-label="Global" class="hidden md:block ">
                <ul class="flex  gap-6 font-semibold uppercase">
                    @foreach ($categorias as $categoria)
                        <li class="mx-4 ">
                            <a class="text-gray-500   transition  hover:text-indigo-500  {{ request()->is('categories/' . $categoria->name) ? 'text-indigo-500' : '' }} "
                                href="{{ route('categories.show', $categoria->name) }}">
                                {{ $categoria->name }}</a>
                        </li>
                        @if ($loop->iteration == 4)
                        @break
                    @endif
                @endforeach

            </ul>
        </nav>

        {{-- <div class="flex items-center gap-4">
            <button
                class="block rounded bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden">
                <span class="sr-only">Toggle menu</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div> --}}
    </div>
</div>
</header>
