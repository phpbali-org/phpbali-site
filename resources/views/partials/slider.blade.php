<div id="carouselExampleIndicators" class="carousel slide">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="page-header header-filter">
                @php
                    if(isset($event)){
                        $imgUrl = asset('img/bg-event/'.$event->photos);
                    }else{
                        $imgUrl = asset('img/bg-event/header.jpg');
                    }
                @endphp
                <div class="page-header-image" style="background-image: url('{{$imgUrl}}')"></div>
                <div class="content-center">
                    <div class="row">
                        <div class="col-md-12 ml-auto mr-auto text-center">
                            @if(isset($event))
                                <h1 class="title">{{ $event->name }}</h1>
                                <h4 class="description text-white">{{ Carbon\Carbon::parse($event->start_date)->format('D, d M Y') }} — {{ Carbon\Carbon::parse($event->start_date)->format('H:i a') }} - {{ Carbon\Carbon::parse($event->end_date)->format('H:i a') }}</h4>
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
        @if(isset($event))
            @if($rsvpChecker < 1)
                <div class="col-md-2 ml-auto mr-auto" id="reservation">
                    <div class="card card-contact card-raised card-plain">
                        <div class="text-center">
                            <a href="{{ route('home.rsvp', ['slug' => $event->slug]) }}" class="btn btn-info btn-lg btn-round ">RSVP NOW</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-2 ml-auto mr-auto" id="reservation">
                    <div class="card card-contact card-raised card-plain">
                        <div class="text-center">
                            <button type="button" class="btn btn-info btn-lg btn-round ">Registered</button>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</a>
</div>