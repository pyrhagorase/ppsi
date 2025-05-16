<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Sentra Computer</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container">
        <div class="login-card">
            <div class="logo-container">
                <h1 class="logo-text">Sentra Computer</h1>
                <p class="logo-subtext">Website Manajemen Service</p>
            </div>

            @if(session('status'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span class="alert-text">{{ session('status') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span class="alert-text">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </span>
            </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="login-form">
                @csrf

                <input type="hidden" name="token" value="{{ request()->route('token') }}">

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="Email Anda" required value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Password Baru" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" required>
                    </div>
                </div>

                <button type="submit" class="login-button">
                    <span>Setel Ulang Password</span>
                    <i class="fas fa-redo-alt"></i>
                </button>

                <div class="form-footer">
                    <a href="{{ route('login') }}" class="login-link">Kembali ke Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
