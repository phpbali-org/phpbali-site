<header class="p-4">
    <nav class="flex items-center justify-between flex-wrap">
      <div class="flex items-center flex-shrink-0 text-white mr-auto">
        <a href="/">
            <img src="{{ asset('img/phpbali-logo.png') }}" alt="PHPBali logo" width="50" height="50">
        </a>
      </div>
      <div class="text-sm flex items-center">
        <a href="/about" class="block lg:inline-block lg:mt-0 text-black font-bold mr-4 {{ isActive('about') }}">
          TENTANG
        </a>
        <a href="/activities" class="block lg:inline-block lg:mt-0 text-black font-bold {{ isActive('activities') }}">
          KEGIATAN
        </a>
      </div>
    </nav>
</header>
