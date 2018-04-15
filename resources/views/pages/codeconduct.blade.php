@extends('layouts.verifiedemail')

@section('additional-styles')
<style type="text/css">
  body{
    background-color: #f7f7f7;
  }

  .lead
  {
    margin-bottom: .75em;
      font-size: 1.2em;
      font-weight: 300;
      line-height: 1.4;
  }

  .title
  {
    margin-bottom: 15px;
  }

  .section.organizers
  {
    background-color: white;
      border-bottom: 1px solid #eee;
      border-top: 1px solid #eee;
      margin-bottom: -1px;
      margin-top: -1px;
      padding-top: 2em;
      padding-bottom: 1em;
  }

  .section
  {
    background: none;
  }

  .about-organizers .img-wrapper
  {
    width: 50px;
      height: 50px;
      float: left;
      overflow: hidden;
      margin-bottom: 1rem;
      margin-right: .625rem;
  }

  .about-organizers .img-wrapper img
  {
    display: block;
      max-width: 100%;
      height: auto;
      border: .1rem solid #2e99e5;
      padding: .125rem;
  }

  .about-organizers .name, .about-organizers .title
  {
    margin: 0;
  }
  
  .about-organizers .col-sm-4{
      margin-bottom: 20px;
  }

  @media(min-width: 768px)
  {
    .lead
    {
      font-size: 1.5em;
    }
  }
</style>
@endsection

@section('content')
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1 class="title">About</h1>
          <p class="lead">Every 3rd Thursday of the month you'll find us talking about what we're doing and what's happening around us in the world of PHP.</p>
          <p class="lead">PHPBali wouldn't be possible without our organisers:</p>
        </div>
      </div>
    </div>
  </div>
  <div class="section organizers">
    <div class="container">
      <div class="row about-organizers ml-auto">
        @if(count($organiser) > 0)
          @foreach($organiser as $user)
          <div class="col-sm-4">
            <div class="organizer">
              <a href="#">
                <div class="img-wrapper">
                  <img src="{{ $user->avatar() }}" alt="{{ $user->slug }}" class="rounded-circle">
                </div>
              </a>
              <h4 class="name">{{ $user->name }}</h4>
              <p class="name">Coordinator</p>
            </div>
          </div>
          @endforeach
        @else
          <div class="col-md-12 text-center">
            <p>No organisers yet</p>
          </div>
        @endif
      </div>
    </div>
  </div>
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Code of Conduct</h2>
          @if(isset($conduct))
          {!! $conduct->desc !!}
          @else
          <p>No Description</p>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection