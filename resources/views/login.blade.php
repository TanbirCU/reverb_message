<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Reverb Messenger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            max-width: 1000px;
            width: 100%;
            align-items: center;
        }

        .login-illustration {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .login-illustration i {
            font-size: 100px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .login-illustration h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .login-illustration p {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .feature-list {
            text-align: left;
            margin: 0 auto;
            width: 100%;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .feature-item i {
            font-size: 20px;
            width: 30px;
            text-align: center;
        }

        .feature-item p {
            margin: 0;
            font-size: 14px;
        }

        .login-form-container {
            background: white;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .login-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .login-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #999;
            margin: 0;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background-color: #f8f9ff;
        }

        .form-control::placeholder {
            color: #bbb;
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle .toggle-btn {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle .form-control {
            padding-right: 45px;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .form-checkbox input {
            cursor: pointer;
            width: 18px;
            height: 18px;
            accent-color: #667eea;
        }

        .form-checkbox label {
            margin: 0;
            cursor: pointer;
            color: #666;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .divider {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
            color: #999;
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e0e0e0;
        }

        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border: 1px solid #e0e0e0;
            background: white;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .social-btn:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .signup-link {
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .signup-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .signup-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .alert {
            margin-bottom: 20px;
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid transparent;
            font-size: 14px;
        }

        .alert-danger {
            background: #fff3cd;
            border-color: #ffc107;
            color: #856404;
        }

        .alert-success {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .login-illustration {
                display: none;
            }

            .login-form-container {
                padding: 40px 30px;
            }

            .login-header h2 {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px;
            }

            .login-form-container {
                padding: 30px 20px;
            }

            .login-header h2 {
                font-size: 20px;
            }

            .login-header {
                margin-bottom: 30px;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .social-login {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Illustration Side -->
        <div class="login-illustration">
            <i class="fas fa-comments"></i>
            <h1>Reverb Messenger</h1>
            <p>Real-time messaging platform for instant communication</p>
            <div class="feature-list">
                <div class="feature-item">
                    <i class="fas fa-bolt"></i>
                    <p><strong>Instant Messaging</strong> - Send messages in real-time</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-users"></i>
                    <p><strong>Connect Easily</strong> - Chat with friends and colleagues</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-shield-alt"></i>
                    <p><strong>Secure & Private</strong> - Your messages are encrypted</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-mobile-alt"></i>
                    <p><strong>Multi-Device</strong> - Access from anywhere, anytime</p>
                </div>
            </div>
        </div>

        <!-- Login Form Side -->
        <div class="login-form-container">
            <div class="login-header">
                <h2>Welcome Back</h2>
                <p>Sign in to your account to continue</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login-store') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                    >
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="password-toggle">
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            name="password" 
                            id="password"
                            placeholder="Enter your password"
                            required
                        >
                        <button type="button" class="toggle-btn" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-options">
                    <div class="form-checkbox">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="login-btn" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>

                <div class="divider">OR</div>

                <div class="social-login">
                    <button type="button" class="social-btn" title="Sign in with Google">
                        <i class="fab fa-google"></i>
                    </button>
                    <button type="button" class="social-btn" title="Sign in with GitHub">
                        <i class="fab fa-github"></i>
                    </button>
                    <button type="button" class="social-btn" title="Sign in with Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                </div>

                <div class="signup-link">
                    Don't have an account? <a href="{{ route('register') }}">Create one now</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleBtn = this;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });

        document.getElementById('loginForm').addEventListener('submit', function() {
            const loginBtn = document.getElementById('loginBtn');
            loginBtn.disabled = true;
            loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing in...';
        });
    </script>
</body>
</html>
