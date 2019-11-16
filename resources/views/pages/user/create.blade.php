@extends('layouts.app')

@section('content')
    <div class="w-full max-w-full m-auto">
      <form class="rounded px-8 pt-6 pb-8 mb-4" method="post" action="/users/store">
          @include('components.user.form', [
              'user' => new \App\Models\User
          ])
      </form>
    </div>
@endsection
