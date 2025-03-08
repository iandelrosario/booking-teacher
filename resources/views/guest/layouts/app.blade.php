<html>

<head>
    <title>{{ config('app.name') }} @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta')
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ config('app.name') }} @yield('title')" />
    <meta property="og:image" content="{{asset('assets/images/logo.png')}}" />
    <link rel="icon" href="{{asset('assets/images/logo.png')}}">
    <link href="{{asset('css/hartpiece.css')}}" rel="stylesheet">
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
    <style>

    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <h3 class="text-center hartpiece-font-poppins mb-5 hartpiece-color"><label class="hartpiece-logo-login"></label> <label class="hartpiece">H<span class="hartpiece-art">art</span>piece</label></h3>
                <h5 class="hartpiece-font-poppins mb-3">@yield('title')</h5>
                @yield('body')
            </div>
        </div>
    </div>
</body>
@yield('script')

</html>