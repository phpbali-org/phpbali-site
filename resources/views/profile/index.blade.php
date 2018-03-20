@extends('layouts.app')

@section('content')
    <div class="page-header page-header-small" filter-color="orange">
        <div class="page-header-image" data-parallax="true" style="background-image: url(&quot;../img/bg3.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
        </div>
        <div class="content-center">
            <div class="photo-container">
                <img src="/img/avatar/default-avatar.png" alt="">
            </div>
            <h3 class="title">{{ $user->name }}</h3>
            @if(Auth::check())
                <div class="content">
                    <div class="social-description">
                        <a href="{{ url('/update' .'?'. http_build_query(['member' => strtolower(str_slug(Auth::user()->name)),'profile' => Auth::user()->id ])) }}" class="btn btn-info">Update</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="section">
        <div class="container">
            <h3 class="title">About me</h3>
            <h5 class="description text-center">{{ $user->about }}.</h5>
        </div>
    </div>
@endsection