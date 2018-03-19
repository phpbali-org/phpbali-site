@extends('layouts.app')

@section('content')
    @if(isset($event))
    @include('layouts.slider')
    @endif
    <div class="main">
        <div class="cd-section" id="blogs">

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
        @if(isset($event))
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
        @endif
    </div>
@endsection
