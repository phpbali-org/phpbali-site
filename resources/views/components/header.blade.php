<header class="p-4 flex items-center justify-between">
    <label for="openSidebarMenu" class="sidebarIconToggle">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fill-current h-6 w-6"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
    </label>
    <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
    <a href="/" class="ml-12">
        <img src="{{ asset('img/phpbali-logo.png') }}" alt="PHPBali logo" width="50" height="50">
    </a>
    <nav id="sidebarMenu" class="md:mx-auto md:flex md:items-center">
        <label for="openSidebarMenu" class="sidebarIconToggle">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" class="fill-current h-6 w-6"><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"/></svg>
        </label>
        <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
        <ul class="md:flex md:items-center">
            <li class="block lg:inline-block md:text-black font-bold m-0 md:mx-4 {{ isActive('about') }}">
                <a href="/about">
                    TENTANG
                </a>
            </li>
            <li class="block lg:inline-block md:text-black font-bold m-0 md:mx-4 {{ isActive('events') }}">
                <a href="/events">
                    KEGIATAN
                </a>
            </li>
            @if (auth()->check())
                @if (auth()->user()->isStaff() || auth()->user()->isAdmin())
                    <li class="block lg:inline-block md:text-black font-bold m-0 md:mx-4 {{ isActive('users') }}">
                        <a href="/users">PENGGUNA</a>
                    </li>
                @endif
            @endif
        </ul>
    </nav>
    <div class="backdrop"></div>
    <div class="relative">
        <div class="flex items-center">
            @if (auth()->check())
                <img src="{{ auth()->user()->avatar() }}" alt="User profile" width="50" height="50" class="rounded-full">
            @else
                <a href="/login/github" class="block lg:inline-block lg:mt-0 text-black font-bold">LOGIN</a>
            @endif
        </div>
        @if (auth()->check())
            <div class="absolute py-2 mt-2 pin-r">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        @endif
    </div>
</header>
