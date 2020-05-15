@extends('layouts.app')

@section('content')
    <div class="about md:w-3/4 m-auto">
        <article class="mx-4 md:mx-16 lg:mx-32">
            {!! $content !!}
        </article>
    </div>
@endsection
