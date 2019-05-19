<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Cache\Repository as Cache;

class AboutController extends Controller
{
    /**
     * The filesystem implementation.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * The cache implementation.
     *
     * @var Cache
     */
    protected $cache;

    /**
     * Create a new documentation instance.
     *
     * @param  Filesystem  $files
     * @param  Cache  $cache
     * @return void
     */
    public function __construct(Filesystem $files, Cache $cache)
    {
        $this->files = $files;
        $this->cache = $cache;
    }

    public function index()
    {
        $title = 'Tentang';
        $content = markdown($this->files->get(base_path('resources/docs/about.md')));

        return view('about', compact('title', 'content'));
    }
}
