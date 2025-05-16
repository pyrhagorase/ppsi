<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Website Manajemen Servis</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
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
                <i class="fas fa-desktop logo-icon"></i>
                <h1 class="logo-text">Sentra Computer</h1>
                <p class="logo-subtext">Website Manajemen Service</p>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span class="alert-text">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span class="alert-text">{{session('error')}}</span>
            </div>
            @endif

            <form action="{{ route('actionlogin') }}" method="post" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="Email Anda" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Password Anda" required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword('password')"></i>
                    </div>
                </div>

                <!-- Script yang lebih baik -->
                <script>
                    function togglePassword(fieldId) {
                        const passwordField = document.getElementById(fieldId);
                        const icon = passwordField.nextElementSibling;

                        if (passwordField.type === 'password') {
                            passwordField.type = 'text';
                            icon.classList.replace('fa-eye', 'fa-eye-slash');
                        } else {
                            passwordField.type = 'password';
                            icon.classList.replace('fa-eye-slash', 'fa-eye');
                        }
                    }
                </script>

                <button type="submit" class="login-button">
                    <span>Masuk</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <div class="form-footer">
                <a href="{{ route('password.request') }}" class="forgot-password">Lupa password?</a>
                    <p class="text-center">Belum punya akun? <a href="{{ route('register') }}">Register</a> sekarang!</p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.querySelector('.toggle-password');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>