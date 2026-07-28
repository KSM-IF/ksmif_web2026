<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{getenv('APP_NAME')}}</title>
    <meta name="description" content="KSM Informatika Universitas Surabaya (UBAYA), WE NOT ME"/>

    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="KSM-IF UBAYA" />
    <meta property="og:description" content="Kelompok Studi Mahasiswa Informatika Universitas Surabaya" />
    <meta property="og:image" content="{{ asset('images/icon/thumbnail.webp') }}" />

    <link rel="icon" type="image/x-icon" href="images/icon/tab-icon.png" />
    <script src="/lib/jquery.js"></script>
    @vite('resources/css/app.css')
    <style>
        html{
            scroll-behavior: smooth;
        }
        body{
            background-image: url("/images/icon/background.webp");
            position: relative;
            width: 100%;
            margin: 0px;
            width: 100%;
            background: none;
        }

        .background {
            position: fixed;
            top: 0px;
            left: 0px;
            z-index: -1;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .background-pattern {
            position: fixed;
            top: -470px;
            left: -499px;
            width: calc(100% + 499px);
            height: calc(100% + 470px);
            background: repeat 499px 235px url("/images/icon/background.webp");
            animation: bg-gerak 2s ease infinite;
        }

        @keyframes bg-gerak {
            0% {
                transform: translate(0px, 0px);
            }
            100% {
                transform: translate(499px, 470px);
            }
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="background-pattern"></div>
    </div>

    @include('layout.loading')
    @includeWhen($data['navbar'] != "homepage", 'layout.mainNavbar')
    @yield('content')
    @include('layout.mainFooter')
</body>
<script>
console.log(
`\x1b[47m\x1b[30m
    Made With Love From    \x1b[1m
   KSM-IF CDD & HRDD 2026  \x1b[0m                                     
▓   ▓ ▓▓▓▓▓    ▓   ▓  ▓▓▓  ▓▓▓▓▓    ▓   ▓ ▓▓▓▓▓   
▓░  ▓░▓░░░░░   ▓▓  ▓░▓ ░░▓  ░▓░░░   ▓▓ ▓▓░▓░░░░░  
▓░▓ ▓░▓▓▓▓░░░  ▓░▓ ▓░▓░ ░▓░  ▓░░░░  ▓░▓ ▓░▓▓▓▓░░░ 
▓▓░▓▓░▓░░░░    ▓░░▓▓░▓░░ ▓░░ ▓░░    ▓░░░▓░▓░░░░   
▓░░ ▓░▓▓▓▓▓░   ▓░░ ▓░░▓▓▓ ░░ ▓░░    ▓░░ ▓░▓▓▓▓▓░  
 ░░░ ░░░░░░░    ░░  ░░ ░░░ ░  ░░     ░░  ░░░░░░░  
  ░   ░ ░░░░░    ░   ░  ░░░    ░      ░   ░ ░░░░░`);
</script>
</html>
