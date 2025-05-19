<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Website Manajemen Servis</title>
    <link rel="stylesheet" href="css/register.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="container">
        <div class="register-card">
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

            <div class="form-container">
                <form action="{{ route('actionregister') }}" method="post" class="register-form">
                    @csrf
                    <div class="form-group">
                        <label for="name">Username</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="name" id="name" placeholder="Buat username" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" id="email" placeholder="Email Anda" required value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" id="password" placeholder="Buat password" required>
                            <i class="fas fa-eye toggle-password" onclick="togglePassword('password')"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password" required>
                            <i class="fas fa-eye toggle-password" onclick="togglePassword('password_confirmation')"></i>
                        </div>
                    </div>

                    <script>
                        function togglePassword(fieldId) {
                            const password = document.getElementById(fieldId);
                            const icon = password.nextElementSibling;

                            if (password.type === 'password') {
                                password.type = 'text';
                                icon.classList.replace('fa-eye', 'fa-eye-slash');
                            } else {
                                password.type = 'password';
                                icon.classList.replace('fa-eye-slash', 'fa-eye');
                            }
                        }
                    </script>

                    <button type="submit" class="register-button">
                        <span>Daftar Sekarang</span>
                        <i class="fas fa-user-plus"></i>
                    </button>
                </form>
            </div>

            <div class="form-footer">
                <p>Sudah punya akun? <a href="{{ route('login') }}" class="login-link">Masuk disini</a></p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const password = document.getElementById(fieldId);
            const icon = password.nextElementSibling;

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