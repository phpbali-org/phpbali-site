@extends('layouts.app')

@section('content')
    <div class="about">
        <article class="mx-4 md:mx-16 lg:mx-32">
            {!! $content !!}
        </article>
    </div>
@endsection
