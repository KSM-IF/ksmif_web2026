<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <script src="/lib/jquery.js"></script>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="flex flex-row min-h-[68vh]">
        <div class="basis-40 border-r">
            @include('dashboard.layout.navbar')
        </div>
        <div class="basis-full overflow-scroll">
            @yield('content')
        </div>
    </div>
    @include('layout.mainFooter')
</body>
</html>