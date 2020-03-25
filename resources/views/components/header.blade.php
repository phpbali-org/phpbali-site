<header class="p-4 flex shadow bg-white items-center">
    <button class="header__hamburger-btn p-2 md:hidden" aria-label="Open menu">
        <img src="{{ asset('icons/list.svg') }}" alt="" class="h-6 w-6">
    </button>
    <a href="/" class="ml-4 md:ml-0">
        <img src="{{ asset('img/phpbali-logo.png') }}" alt="PHPBali logo" width="50" height="50">
    </a>
    <nav id="sidebarMenu">
        <div class="flex border-b border-solid border-gray-500 md:border-none p-6 -ml-2 -mt-1 md:hidden">
            <!-- You can put your logo here ;) -->
            <button class="nav__hide-btn p-2 ml-auto" aria-label="Close menu">
              <img src="{{ asset('icons/times.svg') }}" alt="" class="h-6 w-6">
            </button>
        </div>
        <ul class="flex flex-col md:flex-row md:items-center">
            <li>
                <a href="/about" class="block md:inline font-bold md:mx-4 hover:bg-gray-200 {{ isActive('about') }}">
                    TENTANG
                </a>
            </li>
            <li>
                <a href="/events" class="block md:inline font-bold md:mx-4 hover:bg-gray-200 {{ isActive('events') }}">
                    KEGIATAN
                </a>
            </li>
            @if (auth()->check())
                @if (auth()->user()->isStaff() || auth()->user()->isAdmin())
                    <li>
                        <a href="/users" class="block md:inline font-bold md:mx-4 hover:bg-gray-200 {{ isActive('users') }}">PENGGUNA</a>
                    </li>
                @endif
            @endif
        </ul>
    </nav>
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
            <a href="/login/github" class="font-bold hover:bg-gray-200 p-4">LOGIN</a>
        @endif
    </div>
</header>
