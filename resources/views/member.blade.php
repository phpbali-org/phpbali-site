@extends('layouts.app')

@section('additional-styles')
<style>
    .img-attendance{
        float: left;
        overflow: hidden;
        margin-bottom: 1rem;
        margin-right: .625rem;
    }
    
    .img-attendance .img-wrapper{
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto;
        border: .1rem solid #2e99e5;
    }

    .img-attendance img {
        border-radius: 1px;
        max-width: 100%;
        min-height: 100px;
    }
</style>
@endsection

@section('content')
    <div class="page-header page-header-small" filter-color="orange">
        <div class="page-header-image" data-parallax="true" style="background-image: url(&quot;../img/bg3.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
        </div>
        <div class="content-center">
            <h3 class="title">Meet Other PHP Developer</h3>
            <hr class="text-white">
        </div>
    </div>
    <div class="main">
        <div class="section">
            <div class="container">
                <div class="row">
                    @foreach ($member as $member)
                        <div class="col-xs-2">
                            <a href="{{ url('/member/'.$member->slug) }}" class="img-attendance">
                                <div class="img-wrapper">
                                    <img src="{{ $member->avatar() }}" data-toggle="tooltip" data-placement="top" title="{{ $member->name }}" data-container="body" data-animation="true" />
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection