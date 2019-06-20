<header class="p-4">
    <nav class="flex items-center justify-between">
        <div class="flex items-center flex-shrink-0 text-white mr-auto">
            <a href="/">
                <img src="{{ asset('img/phpbali-logo.png') }}" alt="PHPBali logo" width="50" height="50">
            </a>
            <a href="/about" class="block lg:inline-block lg:mt-0 text-black font-bold mx-4 {{ isActive('about') }}">
                TENTANG
            </a>
            <a href="/events" class="block lg:inline-block lg:mt-0 text-black font-bold mx-4 {{ isActive('activities') }}">
                KEGIATAN
            </a>
            @if (auth()->check())
                @if (auth()->user()->isStaff() || auth()->user()->isAdmin())
                    <a href="/users" class="block lg:inline-block lg:mt-0 text-black font-bold mx-4">PENGGUNA</a>
                @endif
            @endif
        </div>
        <div class="flex flex-col items-center">
            @if (auth()->check())
                <img src="{{ auth()->user()->avatar() }}" alt="User profile" width="50" height="50" class="rounded-full">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="/login/github" class="block lg:inline-block lg:mt-0 text-black font-bold">LOGIN</a>
            @endif
        </div>
    </nav>
</header>
