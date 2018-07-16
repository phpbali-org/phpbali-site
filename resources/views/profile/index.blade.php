@extends('layouts.app')
@section('image-meta')
    @if(isset($event))
        {{ asset('img/bg-event/'.$event->photos) }}
    @else
        {{ asset('img/bg-event/header.jpg') }}
    @endif
@endsection
@section('content')
    <div class="page-header page-header-small" filter-color="orange">
        <div class="page-header-image" data-parallax="true" style="background-image: url(&quot;../img/bg3.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
        </div>
        <div class="content-center">
            <div class="photo-container">
                <img style="min-height: 100px;" src="{{ $user->avatar() }}" alt="{{ $user->name }}">
            </div>
            <h3 class="title">{{ $user->name }}</h3>
            @if(Auth::guard('web')->check())
                <div class="content">
                    <div class="social-description">
                        <a href="{{ route('myprofile.update') }}" class="btn btn-info">Update</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="{{ route('member.list') }}" class="btn btn-sm btn-primary">See other members</a>
                </div>
            </div>
            <h3 class="title">About me</h3>
            <h5 class="description text-center">
                @if(isset($user->about))
                    {{ $user->about }}
                @else
                    <p>Not Described</p>
                @endif
            </h5>
        </div>
    </div>
@endsection