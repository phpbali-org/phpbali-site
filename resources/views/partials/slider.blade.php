<div id="carouselExampleIndicators" class="carousel slide">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="page-header header-filter">
                @php
                    $imgUrl = 'https://res.cloudinary.com/phpbali/image/upload/c_scale,q_auto:good,w_2401/v1536239463/phpbali-firstmeetup.webp';
                    if (isset($event)) {
                        $imgUrl = asset('img/bg-event/'.$event->photos);
                    }
                @endphp
                @if (isset($event))
                    @if ($event->mobile_photos)
                        <style type="text/css">
                            @media screen and (max-width: 991px) {
                                .page-header-image {
                                    background-image: url({{ $event->mobilePhotoUrl() }}) !important;
                                }
                            }
                        </style>
                    @endif
                    <style type="text/css">
                        .page-header-image {
                            background-image: url({{ $event->photoUrl() }})
                        }
                    </style>
                @else
                    <style type="text/css">
                        .page-header-image {
                            background-image: url('https://res.cloudinary.com/phpbali/image/upload/c_scale,q_auto:good,w_2401/v1536239463/phpbali-firstmeetup.webp');
                        }
                    </style>
                @endif
                <div class="page-header-image"></div>
                <div class="content-center">
                    <div class="row">
                        <div class="col-md-12 ml-auto mr-auto text-center">
                            @if (isset($event))
                                <h1 class="title">{{ $event->name }}</h1>
                                <h4 class="description text-white">{{ Carbon\Carbon::parse($event->start_datetime)->format('D, d M Y') }} — {{ Carbon\Carbon::parse($event->start_datetime)->format('g:i A') }} - {{ Carbon\Carbon::parse($event->end_datetime)->format('g:i A') }}</h4>
                                <h5 class="description text-white">{{ $event->place_name }} — <a href="http://maps.google.com.au/?daddr={{ $event->place_name }}"  target="_blank" style="color: #fff;">Directions</a></h5>
                            @else
                                <h1 class="title">No Event Yet!</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 ml-auto mr-auto" id="reservation">
            <div class="card card-contact card-raised card-plain">
                <div class="text-center">
                    @if (isset($event))
                        @if (date('Y-m-d') <= Carbon\Carbon::parse($event->start_datetime)->format('Y-m-d'))
                            @if ($rsvpChecker < 1)
                                <a href="{{ route('home.rsvp', ['slug' => $event->slug]) }}" class="btn btn-info btn-lg btn-round ">RSVP NOW</a>
                            @else
                                <button type="button" class="btn btn-info btn-lg btn-round ">Registered</button>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</a>
</div>
