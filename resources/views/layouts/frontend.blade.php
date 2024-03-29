<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- parsley validator --}}
    <link href="{{ asset('parsley/parsley.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @guest
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li> --}}
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->hasRole('user'))
                                {{-- <a class="dropdown-item" href="{{route('user.profile.view')}}">{{__('Profile')}}</a>
                                <a class="dropdown-item" href="{{route('user.change.password')}}">{{__('Change Password')}}</a> --}}
                                @else
                                <a class="dropdown-item" href="{{route('admin.dashboard')}}">{{__('Dashboard')}}</a>
                                {{-- <a class="dropdown-item" href="{{route('admin.change.password')}}">{{__('Change Password')}}</a> --}}
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                        {{-- <li class="nav-item dropdown">
                            <a id="navbarDropdownLang" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Language') }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLang">
                                @php
                                    $languages = App\Models\Language::where('status',1)->get();
                                @endphp
                                @foreach ($languages as $language)
                                <a class="dropdown-item" href="{{route('changeLanguage',$language->code)}}">{{$language->name}}</a>
                                @endforeach
                            </div>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">{{ __('About') }}</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
        <main class="py-4">
            @include('includes.message')<br>
            @yield('content')
        </main>
        </div>
    </div>
     <!-- Jquery -->
     <script src="{{ asset('admin/assets/scripts/jquery.min.js') }}"></script>
     <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('script')
</body>

</html>
