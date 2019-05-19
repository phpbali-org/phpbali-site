<header class="p-4">
    <nav class="flex items-center justify-between flex-wrap">
      <div class="flex items-center flex-shrink-0 text-white mr-6">
        <a href="/">
            <img src="{{ asset('img/phpbali-logo.png') }}" alt="PHPBali logo" width="50" height="50">
        </a>
      </div>
      <div class="text-sm flex items-center">
        <a href="/about" class="block lg:inline-block lg:mt-0 text-black font-bold mr-4 {{ request()->is('about') ? 'underline' : 'hover:underline'}}">
          TENTANG
        </a>
        <a href="/activities" class="block lg:inline-block lg:mt-0 text-black font-bold mr-4 {{ request()->is('activities') ? 'underline' : 'hover:underline'}}">
          KEGIATAN
        </a>
      </div>
    </nav>
</header>
