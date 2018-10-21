<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand mr-auto mr-lg-0" href="{{route('user.index')}}">{{env('APP_NAME')}}</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            {{--<li class="nav-item active">
                <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
            </li>--}}

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">{{isset(Auth::user()->level->level) ? __('page.level').Auth::user()->level->level : __('page.compl')}}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            @lang('page.logOut')
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest

        </ul>
        <div class="pr-2">
        <a class="pr-2" href="{{route('user.setLocale', 'en')}}"><img width="40px" src="{{asset('img/uk.png')}}" alt=""></a>
        <a href="{{route('user.setLocale', 'ua')}}"><img width="40px" src="{{asset('img/ukr.png')}}" alt=""></a>
        </div>
        {{--<form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>--}}
    </div>
</nav>

<div class="nav-scroller bg-white shadow-sm">
    <nav class="nav nav-underline">
        <a class="nav-link active" href="{{route('user.stats')}}">@lang('page.myStats')</a>
        <a class="nav-link active" href="{{route('user.stats.group')}}">@lang('page.groupStats')</a>
    </nav>
</div>
