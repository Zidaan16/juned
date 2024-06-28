<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @yield('content')
    <script src="{{asset('/assets/js/script.js')}}"></script>
    <script src="https://kit.fontawesome.com/e42e6d5e29.js" crossorigin="anonymous"></script>
</body>
</html>