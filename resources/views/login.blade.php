<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if ($errors->any() || session('error'))
        <h1>Incorrect email or password</h1>
    @endif
    <h1>{{$title}}</h1>
    <form action="{{$actionUrl}}" method="post">
        @csrf
        <input type="email" name="email" id="email" placeholder="Email" value="{{old('email')}}">
        <input type="password" name="password" id="password">
        <button type="submit">Login</button>
    </form>
</body>
</html>