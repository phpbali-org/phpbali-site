<div class="container">
    <div class="navbar-translate">
        <a class="navbar-brand" href="{{ url('/') }}" rel="tooltip" data-placement="bottom" >
            {{ config('app.name', 'Laravel') }}
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
                <a class="nav-link" href="{{ url('about') }}">CODE OF CONDUCT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('meetups') }}">MEETUPS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mailto:satyakresna6295@gmail.com">CONTACT</a>
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
                        <img src="{{ Auth::user()->avatar() }}" class="img img-rounded img-sm" style="width: 20px;">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('/profile' .'?'. http_build_query(['member' => strtolower(str_slug(Auth::user()->name)),'profile' => Auth::user()->id ])) }}">
                            Profile Page
                        </a>
                        {{-- <a class="dropdown-item" href="{{ route('password.request') }}">
                            Reset Password
                        </a> --}}
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
            {{--  <li class="nav-item">
                <a class="nav-link modal-toggle" data-tab="tab_login" data-toggle="modal" data-target="#modalLogin" href="#link_login">SIGN IN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link modal-toggle" data-tab="tab_register" data-toggle="modal" data-target="#modalLogin" href="#link_register">REGISTER</a>
            </li>  --}}
            {{-- <li class="nav-item">
                <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/balihypertext" target="_blank">
                    <i class="fa fa-twitter"></i>
                    <p class="d-lg-none d-xl-none">Twitter</p>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/balihypertext" target="_blank">
                    <i class="fa fa-facebook-square"></i>
                    <p class="d-lg-none d-xl-none">Facebook</p>
                </a>
            </li>
        </ul>
    </div>
</div>
