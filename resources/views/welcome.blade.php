@extends('layouts.app')

@section('content')
    @include('layouts.slider')
    <div class="main">
        <div class="cd-section" id="blogs">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 ml-auto mr-auto">
                        <h2 class="title">What the topic?</h2>
                        <hr>
                        <div class="card card-plain card-blog">
                            <div class="row">
                                @if(count($event->topic) > 0)
                                    @foreach($event->topic as $topic)
                                        <div class="col-md-4">
                                            <h3 class="card-title">
                                                <span>{{$topic->title}}</span>
                                            </h3>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="card-description">
                                                {{ $topic->desc }}
                                            </p>
                                            <p class="author">
                                                @foreach ($topic->speakers as $speaker)
                                                    by <a href="{{ url('/member/'.str_slug($speaker->name)) }}"><b>{{ $speaker->name }}</b></a>
                                                @endforeach
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <h3 class="ml-auto mr-auto">There's no topic yet</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blogs-1" id="blogs-1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 ml-auto mr-auto">
                            <h2 class="title">Meet The Speakers</h2>
                            <hr>
                            <br />
                            @if(count($event->topic) > 0)
                                @foreach($event->topic->speakers as $speaker)
                                    <div class="card card-plain card-blog">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card-image">
                                                    <img class="img img-raised rounded
                                                    " src="/img/avatar/{{ $speaker->photos }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h3 class="card-title">
                                                    <span>{{ $speaker->name }}</span>
                                                </h3>
                                                <p class="card-description">
                                                    {{ $speaker->about }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row">
                                    <h3 class="ml-auto mr-auto">There's no topic speakers yet</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
                <h2 class="title">Maps</h2>
                <hr>
            </div>
        </div>
        <div id="contactUs2Map" class="big-map"></div>

        <div class="section" id="teams">
            <div class="team-1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto text-center">
                            @if(isset($event))
                            <h2 class="title">{{ count($event->rsvp) }} People Attending</h2>
                            @else
                            <h2 class="title">0 People Attending</h2>
                            @endif
                            <hr>
                        </div>
                    </div>
                    @if(isset($event))
                        <div class="row justify-content-center">
                            @foreach($event->rsvp as $rsvp)
                            <div class="col-xs-2">
                                <div class="card card-profile card-plain">
                                    <div class="card-avatar">
                                        <a href="{{ url('/member/'.str_slug($rsvp->user->name)) }}">
                                            <img class="img img-raised" src="/img/avatar/{{$rsvp->user->photos}}" data-toggle="tooltip" data-placement="top" title="{{ $rsvp->user->name }}" data-container="body" data-animation="true" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row justify-content-center">
                            <h3 class="ml-auto mr-auto">There's no people attending yet</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection