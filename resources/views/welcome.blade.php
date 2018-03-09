@extends('layouts.app')

@section('content')
    @include('layouts.slider')

    <div class="main">
        <div class="cd-section" id="blogs">

<!--     *********     BLOGS 1      *********      -->
            <div class="blogs-1" id="blogs-1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 ml-auto mr-auto">
                            <h2 class="title">Meet The Speekers</h2>
                            <br />
                            <div class="card card-plain card-blog">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-image">
                                            <img class="img img-raised rounded
                                            " src="/img/avatar.jpg" />
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        {{-- <h6 class="category text-danger">
                                            <i class="now-ui-icons now-ui-icons media-2_sound-wave"></i> Startup
                                        </h6> --}}
                                        <h3 class="card-title">
                                            <span>Insticator raises $5.2M to help publishers</span>
                                        </h3>
                                        <p class="card-description">
                                            Insticator is announcing that it has raised $5.2 million in Series A funding. The startup allows online publishers to add quizzes, polls and other interactive elements (either created by Insticator or by the publisher themselves) to their stories.
                                        </p>
                                        <p class="author">
                                            by <a href="#pablo"><b>Anthony Ha</b></a>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-plain card-blog">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-image">
                                            <img class="img img-raised rounded
                                            " src="/img/avatar.jpg" />
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        {{-- <h6 class="category text-danger">
                                            <i class="now-ui-icons now-ui-icons media-2_sound-wave"></i> Startup
                                        </h6> --}}
                                        <h3 class="card-title">
                                            <span>Insticator raises $5.2M to help publishers</span>
                                        </h3>
                                        <p class="card-description">
                                            Insticator is announcing that it has raised $5.2 million in Series A funding. The startup allows online publishers to add quizzes, polls and other interactive elements (either created by Insticator or by the publisher themselves) to their stories.
                                        </p>
                                        <p class="author">
                                            by <a href="#pablo"><b>Anthony Ha</b></a>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
           <div class="container">
               <h2 class="section-title">Latest Offers</h2>
               <div class="row">
                    <div class="col-md-4">

                        <div class="card card-product card-plain">
                            <div class="card-image">
                                <img class="img rounded" src="/img/avatar.jpg"/>
                            </div>

                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#pablo">Saint Laurent</a>
                                </h4>
                                <p class="card-description">The structured shoulders and sleek detailing ensure a sharp silhouette. Team it with a silk pocket square and leather loafers.</p>
                                <div class="card-footer">
                                    <div class="price-container">
                                        <span class="price price-old"> &euro;1,430</span>
                                        <span class="price price-new"> &euro;743</span>
                                    </div>
                                    <div class="stats stats-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-icon btn-neutral" data-original-title="Saved to Wishlist">
                                           <i class="now-ui-icons ui-2_favourite-28"></i>
                                       </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="card card-product card-plain">
                            <div class="card-image">
                                <img class="img rounded" src="/img/avatar.jpg"/>
                            </div>

                            <div class="card-body">
                                <h4 class="card-title">
                                    <h4 class="card-title">Saint Laurent</h4>
                                </h4>
                                <p class="card-description">The structured shoulders and sleek detailing ensure a sharp silhouette. Team it with a silk pocket square and leather loafers.</p>
                                <div class="card-footer">
                                    <div class="price-container">
                                        <span class="price price-old"> &euro;1,430</span>
                                        <span class="price price-new">&euro;743</span>
                                    </div>
                                    <div class="stats stats-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-icon btn-neutral" data-original-title="Saved to Wishlist">
                                            <i class="now-ui-icons ui-2_favourite-28"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="card card-product card-plain">
                            <div class="card-image">
                                <img class="img rounded" src="/img/avatar.jpg"/>
                            </div>

                            <div class="card-body">
                                <h4 class="card-title">
                                    <h4 class="card-title">Gucci</h4>
                                </h4>
                                <p class="card-description">The smooth woven-wool is water resistant to ensure you stay pristine after a long-haul flight. Cut in a trim yet comfortable regular fit.</p>
                                <div class="card-footer">
                                    <div class="price-container">
                                        <span class="price price-old"> &euro;2,430</span>
                                        <span class="price price-new">&euro;890</span>
                                    </div>
                                    <div class="stats stats-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-icon btn-neutral btn-default" data-original-title="Add to Wishlist">
                                           <i class="now-ui-icons ui-2_favourite-28"></i>
                                       </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

               </div>
           </div>
        </div><!-- section -->
        
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
                <h2 class="title">Maps</h2>
                <hr>
            </div>
        </div>
        <div id="contactUs2Map" class="big-map"></div>

        <div class="section" id="teams">
<!--     *********    TEAM 1     *********      -->
            <div class="team-1">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto text-center">
                            <h2 class="title">X People Attending</h2>
                            <hr>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        @for ($i = 0; $i < 30 ; $i++)
                            <div class="col-xs-2">
                                <div class="card card-profile card-plain">
                                    <div class="card-avatar">
                                        <a href="#pablo">
                                            <img class="img img-raised" src="/img/ryan.jpg" data-toggle="tooltip" data-placement="top" title="Emily Chloe" data-container="body" data-animation="true" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endfor


                        <div class="col-xs-2">
                            <div class="card card-profile card-plain">
                                <div class="card-avatar">
                                    <a href="#pablo">
                                        <img class="img img-raised" src="/img/avatar.jpg" data-toggle="tooltip" data-placement="top" title="Emily Chloe" data-container="body" data-animation="true"/>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-">
                            <div class="card card-profile card-plain">
                                <div class="card-avatar">
                                    <a href="#pablo">
                                        <img class="img img-raised" src="/img/avatar.jpg" data-toggle="tooltip" data-placement="top" title="Emily Chloe" data-container="body" data-animation="true" />
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-2 ">
                            <div class="card card-profile card-plain">
                                <div class="card-avatar">
                                    <a href="#pablo" >
                                        <img class="img img-raised" src="/img/avatar.jpg" data-toggle="tooltip" data-placement="top" title="Emily Chloe" data-container="body" data-animation="true"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
