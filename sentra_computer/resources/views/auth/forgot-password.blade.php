<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lupa Password - Sentra Computer</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Background sama persis dengan login -->
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
            
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span class="alert-text">{{ session('success') }}</span>
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
            
            <form action="{{ route('password.email') }}" method="post" class="login-form">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email Terdaftar</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="Email Anda" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" id="username" placeholder="Username Anda" required>
                    </div>
                </div>
                
                <button type="submit" class="login-button">
                    <span>Reset Password</span>
                    <i class="fas fa-paper-plane"></i>
                </button>
                
                <div class="form-footer">
                    <a href="{{ route('login') }}" class="login-link">Kembali ke Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>