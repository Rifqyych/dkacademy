<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - DK Academy</title>
    @vite(['resources/css/app.css'])
</head>
<body class="auth-page">
    <div class="auth-card">
        <a href="{{ route('home') }}" class="auth-logo">
            <img src="{{ asset('images/dkacademy logo.png') }}" alt="DK Academy">
        </a>

        <h1>Admin Login</h1>

        @if ($errors->any())
            <div class="alert alert-error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="form-stack">
            @csrf
            <label>
                Email
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </label>
            <label>
                Password
                <input type="password" name="password" required>
            </label>
            <label class="check-row">
                <input type="checkbox" name="remember">
                Remember me
            </label>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
