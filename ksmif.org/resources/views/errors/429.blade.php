<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KSM-IF 429</title>
    <script src="./lib/jquery.js"></script>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="h-screen justify-center-safe place-items-center grid font-['Jersey10']">
        <div id="header" class="grid justify-center place-items-center sm:mt-[5%] mt-[20%] sm:mb-[11%] mb-64">
            <img class="h-30" src="/images/icon/ksmHytam.svg" type="image/svg+xml">
            <h3 class="lg:text-9xl sm:text-7xl sm:mt-3 text-6xl text-center">429 Too Many Requests</h3>
            <h3 class="sm:text-3xl text-2xl m-5 text-pretty">It looks like your request was too many to handle</h3>
            <a href="/" class="text-white p-5 bg-black text-5xl">Back To Homepage</a>
        </div>
    </div>
    <div class="w-full bottom-0 ">
    @include('layout.mainFooter')
    </div>
</body>
</html>