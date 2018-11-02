<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {
        return 'hai';
    }

    public function lorem()
    {
        return 'foo';
    }

    public function qux()
    {
        return 'what are you looking for?';
    }
}
