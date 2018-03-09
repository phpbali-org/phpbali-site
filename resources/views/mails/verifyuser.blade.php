@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => url('/')])
            Thank you for register :) {{$user['name']}}
        @endcomponent
    @endslot
{{-- Body --}}
    Dear {{ $user['name'] }}, thank you for register as PHP Bali Community member. But, before continue please confirm your email address. <br>
    Please click link bellow for activate your account. <br>
    <a href="{{url('user/verify', $user->verify->verify_token)}}">Verify Email</a>
{{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                <a href="{{url('user/verify', $user->verify->verify_token)}}">Verify Email</a>
            @endcomponent
        @endslot
    @endisset
{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}.
        @endcomponent
    @endslot
@endcomponent