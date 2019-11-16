@extends('layouts.app')

@section('content')
    @include('components.user.form', [
        'user' => $user,
        'action' => $user->path()."/update",
        '_method' => 'PUT'
    ])
@endsection
