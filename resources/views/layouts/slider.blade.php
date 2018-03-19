<div id="carouselExampleIndicators" class="carousel slide">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="page-header header-filter">
                <div class="page-header-image" style="background-image: url('../img/bg-event/{{ $event->photos }}');"></div>
                <div class="content-center">
                    <div class="row">
                        <div class="col-md-12 ml-auto mr-auto text-center">
                            <h1 class="title">{{ $event->name }}</h1>
                            <h4 class="description text-white">{{ Carbon\Carbon::parse($event->start_date)->format('D, d M Y') }} — {{ Carbon\Carbon::parse($event->start_date)->format('H:i a') }} - {{ Carbon\Carbon::parse($event->end_date)->format('H:i a') }}</h4>
                            <h5 class="description text-white">{{ $event->place }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 ml-auto mr-auto" id="reservation">
            <div class="card card-contact card-raised card-plain">
                <form role="form" id="contact-form" method="post">
                    {{ csrf_field() }}
                    <div class="text-center">
                        <button type="submit" class="btn btn-info btn-lg btn-round ">RSVP NOW</button>
                    </div>
                    {{--  <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 pr-2">
                                <label>Category</label>
                                <select id="select_category" class="wide" style="display: none;">
                                    <option data-display="Select">Nothing</option>
                                    <option value="1">Some option</option>
                                    <option value="2">Another option</option>
                                    <option value="4">Potato</option>
                                </select>
                            </div>
                            <div class="col-md-5 col-sm-5 pl-2">
                                <div class="form-group">
                                    <label>Vendor</label>
                                    <input type="text" class="form-control" placeholder="Last Name..." aria-label="Last Name...">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 text-right">
                                <div class="form-group mt-3">
                                    <label></label>
                                    <button type="submit" class="btn btn-info btn-round pull-right">Send Message</button>
                                </div>
                            </div>
                        </div>
                    </div>  --}}
                </form>
            </div>
        </div>
    </div>
    {{-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <i class="now-ui-icons arrows-1_minimal-left"></i>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <i class="now-ui-icons arrows-1_minimal-right"></i> --}}
</a>
</div>
