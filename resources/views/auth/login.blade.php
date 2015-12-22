
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Argue Secure</title>
</head>
<body>

ARGUE SECURE

<form method="POST" action="{{ url('auth/login') }}">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>

</body>
</html>