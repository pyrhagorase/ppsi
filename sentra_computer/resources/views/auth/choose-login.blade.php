<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Jenis Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-choice-container {
            max-width: 800px;
            width: 100%;
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 15px;
        }
        .card-text {
            margin-bottom: 25px;
            color: #6c757d;
        }
        .btn-login {
            padding: 10px 30px;
            font-weight: 600;
        }
        .logo {
            margin-bottom: 30px;
            text-align: center;
        }
        .logo h1 {
            font-weight: 700;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container login-choice-container">
        <div class="logo">
            <h1>Nama Aplikasi</h1>
            <p>Silakan pilih jenis login yang sesuai</p>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card p-4">
                    <div class="card-body text-center">
                        <i class="fas fa-user fa-3x mb-3" style="color: #007bff;"></i>
                        <h5 class="card-title">Login sebagai User</h5>
                        <p class="card-text">Login sebagai pengguna biasa untuk mengakses fitur standar aplikasi.</p>
                        <a href="{{ route('login.user') }}" class="btn btn-primary btn-login">Masuk sebagai User</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card p-4">
                    <div class="card-body text-center">
                        <i class="fas fa-user-shield fa-3x mb-3" style="color: #28a745;"></i>
                        <h5 class="card-title">Login sebagai Admin</h5>
                        <p class="card-text">Login sebagai administrator untuk mengakses panel kontrol dan fitur manajemen.</p>
                        <a href="{{ route('login.admin') }}" class="btn btn-success btn-login">Masuk sebagai Admin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome untuk ikon -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>