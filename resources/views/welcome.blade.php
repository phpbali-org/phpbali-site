@extends('layouts.app')
@section('image-meta')
    @if(isset($event))
        {{ asset('img/bg-event/'.$event->photos) }}
    @else
        {{ asset('img/bg-event/header.jpg') }}
    @endif
@endsection
@section('additional-styles')
<style>
    .card-description{
        font-size: 16.2px;
        text-align: justify;
    }

    .topic-style .speaker-avatar-wrapper{
        width: 90px;
        height: 90px;
        float: left;
        overflow: hidden;
        margin-bottom: 1rem;
        margin-right: .625rem;
    }

    .topic-style .speaker-avatar-wrapper img{
        display: block;
        max-width: 100%;
        height: auto;
        border: .1rem solid #2e99e5;
        border-radius: 50%;
        padding: .125rem;
    }

    .desc-topic-style .topic-title{
        font-weight: 700;
        margin-bottom: .25em;
    }

    .desc-topic-style .topic-desc{
        text-align: justify;
        color: #9A9A9A;
        font-weight: 300;
    }

    .list-unstyled li{
        display: inline-block;
        margin-bottom: 1rem;
        margin-right: 7px;
    }

    .img-attendance{
        overflow: hidden;
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

    @media(max-width: 640px)
    {
        .ecommerce-page .title{
            font-size: 36px;
        }

        .ml-auto.mr-auto {
            font-size: 16px;
        }
    }
</style>
@endsection

@section('content')
    @include('partials.slider')
    <div class="main">
        <div class="cd-section" style="margin-bottom: 20px;">
            <div class="container">
            @if(isset($event))
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <h2 class="title">What the topic?</h2>
                        <hr>
                        <br />
                        @if (date('Y-m-d') <= Carbon\Carbon::parse($event->start_date)->format('Y-m-d'))
                            <p class="card-description">{!! $event->desc !!}</p>
                        @else
                            <h3 class="text-center">There's no topic yet</h3>
                        @endif
                        <br />
                    </div>
                </div>
                @if(count($event->topic) > 0 && (date('Y-m-d') <= Carbon\Carbon::parse($event->start_date)->format('Y-m-d')))
                    @foreach($event->topic as $topic)
                        @if($loop->first)
                            <div class="row" style="margin-bottom: 20px;">
                        @endif
                            <div class="col-md-6">
                                <div class="topic-style">
                                    <div class="col-xs-3">
                                        <div class="speaker-avatar-wrapper">
                                            @foreach($topic->speakers as $speaker)
                                            <img src="{{ $speaker->avatar() }}" alt="{{ $speaker->name }}">
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                         <div class="desc-topic-style">
                                             <h5 class="topic-title">{{ $topic->title }}</h5>
                                             <p class="topic-sub-title">
                                                By
                                                @foreach($topic->speakers as $speaker)
                                                    {{ $speaker->name }}
                                                @endforeach
                                             </p>
                                             <div class="topic-desc">
                                                {!! $topic->desc !!}
                                             </div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        @if($loop->iteration == 2 && !$loop->last)
                            </div>
                            <div class="row" style="margin-bottom: 20px;">
                        @endif

                        @if($loop->last)
                            </div>
                        @endif
                    @endforeach
                @endif
            @else
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <h2 class="title">What the topic?</h2>
                        <hr>
                        <br />
                        <h3 class="text-center">There's no topic yet</h3>
                        <br />
                    </div>
                </div>
            @endif
            </div>
        </div>

        <div class="cd-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto text-center">
                        <h2 class="title">Maps</h2>
                        <hr>
                        @if(isset($event))
                        <div id="contactUs2Map" class="big-map"></div>
                        @else
                        <h3 class="text-center">There's no event yet</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="cd-section" style="margin-bottom: 20px;">
            <div class="container">
                @if(isset($event) && (date('Y-m-d') <= Carbon\Carbon::parse($event->start_date)->format('Y-m-d')))
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <h2 class="title">{{ $rsvpCounter }} People are Attending</h2>
                        <hr>
                        <br />
                        @if($event->rsvp)
                        <ul class="list-unstyled list-inline text-center attendees-list">
                            @foreach($event->rsvp as $rsvp)
                                @if(!empty($rsvp->user->name))
                                <li>
                                    <a href="{{ route('member.index', ['slug' => $rsvp->user->slug]) }}" class="img-attendance">
                                        @if(!empty($rsvp->user->avatar()))
                                        <div class="img-wrapper">
                                            <img src="{{ $rsvp->user->avatar() }}" data-toggle="tooltip" data-placement="top" title="{{ $rsvp->user->name }}" data-container="body" data-animation="true" />
                                        </div>
                                        @else
                                        <div class="img-wrapper">
                                            <img src="{{ asset('img/avatar/default-avatar.png') }}" data-toggle="tooltip" data-placement="top" title="{{ $rsvp->user->name }}" data-container="body" data-animation="true" />
                                        </div>
                                        @endif
                                    </a>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                        @else
                        <h3 class="text-center">There's no people attending yet</h3>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
