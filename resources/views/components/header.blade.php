<header class="p-4 flex shadow bg-white">
    <div class="flex">
        <label for="menuToggle" class="sidebarIconToggle" aria-label="Toggle Menu" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fill-current h-6 w-6"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
        </label>
        <input type="checkbox" id="menuToggle">
        <label for="menuToggle" aria-label="Hide Menu" role="presentation" class="menuUnderlay"></label>
        <a href="/" class="ml-12 md:ml-0">
            <img src="{{ asset('img/phpbali-logo.png') }}" alt="PHPBali logo" width="50" height="50">
        </a>
        <nav id="sidebarMenu">
            <label for="menuToggle" class="sidebarIconToggle" aria-label="">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" class="fill-current h-6 w-6"><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"/></svg>
            </label>
            <input type="checkbox" id="menuToggle">
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
    </div>
    <div class="backdrop"></div>
    <div class="ml-auto">
        @if (auth()->check())
            <button id="avatarBtn">
                <img src="{{ auth()->user()->avatar() }}" alt="User profile" width="50" height="50" class="rounded-full">
            </button>
            <div class="absolute bg-white block mt-4 p-2 md:p-3 shadow rounded-b-lg hidden right-1 md:right-2" id="logoutField">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        @else
            <a href="/login/github" class="block lg:inline-block text-black font-bold mt-4">LOGIN</a>
        @endif
    </div>
</header>
