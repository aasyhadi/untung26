<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | UNTUNG YASRIL</title>

    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ url('app/css/light.css') }}" rel="stylesheet">

    <style>

        body{
            background: linear-gradient(135deg,#f5f7fb,#e4ecf7);
            font-family: 'Poppins', sans-serif;
        }

        .main{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .login-card{
            border-radius:12px;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
            border:none;
        }

        .login-title{
            font-weight:600;
            color:#333;
            margin-bottom:5px;
        }

        .login-subtitle{
            font-size:14px;
            color:#777;
        }

        .form-label{
            font-weight:500;
        }

        .form-control{
            border-radius:8px;
            padding:10px 12px;
        }

        .btn-login{
            border-radius:8px;
            font-weight:500;
            padding:10px;
        }

        .footer-login{
            font-size:13px;
            color:#888;
        }

    </style>

</head>

<body>

<div class="main">

    <main class="content w-100">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-md-6 col-lg-4">

                    <div class="card login-card">

                        <div class="card-body p-4">

                            <!-- Title -->
                            <div class="text-center mb-4">
                                <h3 class="login-title">Login Sistem</h3>
                                <p class="login-subtitle">UNTUNG YASRIL</p>
                            </div>

                            <!-- Form -->
                            <form id="login" method="post" action="{{ url('submit-login') }}">
                                {{ csrf_field() }}

                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input
                                        type="text"
                                        name="username"
                                        class="form-control form-control-lg"
                                        placeholder="Masukkan username"
                                        required
                                    >
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Password</label>
                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control form-control-lg"
                                        placeholder="Masukkan password"
                                        required
                                    >
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg btn-login">
                                        Login
                                    </button>
                                </div>

                            </form>

                        </div>

                        <!-- Footer -->
                        <div class="text-center pb-3 footer-login">
                            © 2025 - Duratu Tech
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

<script src="{{ url('js/app.js') }}"></script>

</body>
</html>
