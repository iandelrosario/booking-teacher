<html>

<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('assets/images/logo.png')}}">
    @yield('meta')
    <link href="{{asset('css/hartpiece.css')}}" rel="stylesheet">
    @yield('style')
    @stack('style')
    <script data-ad-client="ca-pub-2558599793791085" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171038797-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-171038797-1');
    </script>
</head>

<body>
    <div class="container-lg container-fluid">
        <div class="row pb-3 pb-lg-0">
            <div class="col-lg-4 d-none d-lg-block">
                @auth
                @include('components.details')
                @else
                <div class="sticky-top pt-3">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="mb-0 hartpiece-font-poppins hartpiece-color">
                                <a href="{{route('login')}}" class="text-decoration-none text-dark hartpiece-logo-hover">
                                    <label class="hartpiece-logo hartpiece-logo-hover"></label><label class="hartpiece hartpiece-logo-hover">H<span class="hartpiece-art">art</span>piece</label>
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            @include('guest.template.login')
                        </div>
                    </div>
                </div>
                @endauth
            </div>
            <div class="col-lg-8 pb-5 pb-lg-0">

                <nav class="navbar sticky-top rounded-top hartpiece-rounded-corner navbar-expand navbar-light" id="topmenu" style="background:#fff;">
                    <a href="{{route('login')}}" class="mr-3 d-lg-none "><label class="hartpiece-logo-mobile hartpiece-logo-hover"></label></a>
                    <a class="navbar-brand hartpiece-font-poppins" href="#"><b>@yield('title')</b></a>
                </nav>

                @yield('top')
                @yield('body')
            </div>
        </div>
    </div>
    @auth
    <nav class="navbar fixed-bottom navbar-light text-center border-top d-lg-none" style="background-color:#fff;">
        <div class="col"><a href="{{route('login')}}" class="text-dark "><i class="fas fa-home fa-fw fa-lg"></i></a></div>
        <div class="col"><a href="{{route('user.home',['username'=> auth()->user()->username])}}"><img class="border hartpiece-img-sm" src='{{auth()->user()->profile}}'></a></div>
        <div class="col"><a href="{{route('search')}}" class="text-dark "><i class="fas fa-search fa-fw fa-lg"></i></a></div>
    </nav>
    @endauth
</body>
<script src="{{asset('js/hartpiece.js')}}"></script>
@yield('scripts')
@stack('scripts')

</html>