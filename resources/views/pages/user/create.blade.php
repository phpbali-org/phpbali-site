@extends('layouts.app')

@section('content')
    @include('components.user.form', [
        'user' => new \App\Models\User,
        'action' => "/users/store",
    ])
@endsection
