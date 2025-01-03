<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNS Manager Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <style>
        body {
            background: url('{{ asset('images/background.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-card {
            width: 600px;
            background: rgba(255, 255, 255, 0.8); /* Slight transparency for the login card */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px); /* Apply the blur effect to the background */
        }
        .login-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }
        .form-group i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #007bff;
        }
        .form-control {
            padding-left: 35px;
        }
        .login-card .content-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .login-card .content-wrapper p {
            flex: 1;
        }
    </style>
</head>
<body>
   

   
    <div class="login-card">
        <h2 style="text-align: center; margin-bottom: 20px; background-color: #007bff; color: white; padding: 10px; border-radius: 8px; border: 2px solid #0056b3;">
            Login
        </h2>
        <div class="content-wrapper">
            <p>Please note that FREE-DNS Manager is NOT needed if you have your own server. With CWP, we recommend that you use your own server for DNS hosting as it will provide you with automatic DNS zone configuration.</p>
            <img src="/images/dnss.png" alt="Logo" style="width: 80px; height: auto;">
        </div>
        <p>Instructions for private nameservers setup:</p>
        <!-- Display validation errors if any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <i class="fa fa-user"></i>
                <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required>
            </div>
            <div class="form-group">
                <i class="fa fa-lock"></i>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign In</button>
        </form>
        <div class="mt-3 text-center">
            <a href="/forgot-password">Forgot Password?</a> | 
            <a href="/">Create an account</a>
        </div>
    </div>
</body>

</html>
