<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KSM-IF 500</title>
    <script src="./lib/jquery.js"></script>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="h-screen justify-center-safe place-items-center grid font-['Jersey10']">
        <div id="header" class="grid justify-center place-items-center sm:mt-[5%] mt-[20%] sm:mb-[11%] mb-64">
            <img class="h-30" src="/images/icon/ksmHytam.svg" type="image/svg+xml">
            <h3 class="lg:text-9xl sm:text-7xl sm:mt-3 text-6xl text-center">SORRY, WE ARE ON MAINTENANCE!!</h3>
        </div>
    </div>
    <div class="w-full bottom-0 ">
    @include('layout.mainFooter')
    </div>
</body>
</html>