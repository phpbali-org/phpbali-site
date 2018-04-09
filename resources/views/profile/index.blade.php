@extends('layouts.app')

@section('content')
    <div class="page-header page-header-small" filter-color="orange">
        <div class="page-header-image" data-parallax="true" style="background-image: url(&quot;../img/bg3.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
        </div>
        <div class="content-center">
            <div class="photo-container">
                <img src="{{ $user->avatar() }}" alt="{{ $user->name }}">
            </div>
            <h3 class="title">{{ $user->name }}</h3>
            @if(Auth::guard('web')->check())
                @if (Auth::user()->id == $user->id)
                    <div class="content">
                        <div class="social-description">
                            <a href="{{ url('/update' .'?'. http_build_query(['member' => strtolower(str_slug(Auth::user()->name)),'profile' => Auth::user()->id ])) }}" class="btn btn-info">Update</a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="{{ url('member') }}" class="btn btn-sm btn-primary">All Member</a>
                </div>
            </div>
            <h3 class="title">About me</h3>
            <h5 class="description text-center">{{ $user->about }}.</h5>
        </div>
    </div>
@endsection