<div class="container">
    <div class="navbar-translate">
        <a class="navbar-brand" href="{{ url('/') }}" rel="tooltip" data-placement="bottom" >
            <img src="{{ asset('img/favicon.png') }}" class="img-fluid" alt="PHP Bali Community" style="width: 50px;">
            {{-- {{ config('app.name', 'Laravel') }} --}}
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse " data-color="blue" data-nav-image="/img/blurred-image-1.jpg">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home.about') }}">CODE OF CONDUCT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home.meetups') }}">MEETUPS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mailto:phpbali@gmail.com?subject=Hi,%20I%20saw%20your%20site">CONTACT</a>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">REGISTER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::guard('web')->user()->avatar() }}" class="img img-rounded img-sm" style="width: 20px;">
                        {{ Auth::guard('web')->user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('myprofile.index') }}">
                            Profile Page
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            @endguest
            <li class="nav-item">
                <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/balihypertext" target="_blank">
                    <i class="fa fa-facebook-square"></i>
                    <p class="d-lg-none d-xl-none">Facebook</p>
                </a>
            </li>
        </ul>
    </div>
</div>
