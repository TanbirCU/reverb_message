<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Reverb Messenger</title>
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

        .register-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            max-width: 1000px;
            width: 100%;
            align-items: center;
        }

        .register-illustration {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .register-illustration i {
            font-size: 100px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .register-illustration h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .register-illustration p {
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

        .register-form-container {
            background: white;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-height: 90vh;
            overflow-y: auto;
        }

        .register-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .register-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .register-header p {
            color: #999;
            margin: 0;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            color: #333;
            font-weight: 600;
            font-size: 13px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 13px;
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

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-row .form-group {
            margin-bottom: 0;
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle .toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .password-toggle .form-control {
            padding-right: 40px;
        }

        .password-strength {
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            margin-top: 5px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            background: #e0e0e0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .password-strength-text {
            font-size: 11px;
            color: #999;
            margin-top: 3px;
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .terms-checkbox input {
            cursor: pointer;
            width: 16px;
            height: 16px;
            margin-top: 2px;
            accent-color: #667eea;
            flex-shrink: 0;
        }

        .terms-checkbox label {
            margin: 0;
            cursor: pointer;
            color: #666;
            line-height: 1.4;
        }

        .terms-checkbox a {
            color: #667eea;
            text-decoration: none;
        }

        .terms-checkbox a:hover {
            text-decoration: underline;
        }

        .register-btn {
            width: 100%;
            padding: 11px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 12px;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .register-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .login-link {
            text-align: center;
            color: #666;
            font-size: 13px;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert {
            margin-bottom: 15px;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid transparent;
            font-size: 13px;
        }

        .alert-danger {
            background: #fff3cd;
            border-color: #ffc107;
            color: #856404;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .register-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .register-illustration {
                display: none;
            }

            .register-form-container {
                padding: 30px;
            }

            .register-header h2 {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .register-form-container {
                padding: 20px;
            }

            .register-header {
                margin-bottom: 20px;
            }

            .register-header h2 {
                font-size: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Illustration Side -->
        <div class="register-illustration">
            <i class="fas fa-user-plus"></i>
            <h1>Join Us Today</h1>
            <p>Create your account and start messaging instantly</p>
            <div class="feature-list">
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <p><strong>Quick Setup</strong> - Get started in seconds</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-lock"></i>
                    <p><strong>Fully Secure</strong> - Military-grade encryption</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-heart"></i>
                    <p><strong>24/7 Support</strong> - Always here to help</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-star"></i>
                    <p><strong>Premium Features</strong> - Enjoy all benefits</p>
                </div>
            </div>
        </div>

        <!-- Register Form Side -->
        <div class="register-form-container">
            <div class="register-header">
                <h2>Create Account</h2>
                <p>Join millions of users messaging globally</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register-store') }}" id="registerForm">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input 
                            type="text" 
                            class="form-control @error('first_name') is-invalid @enderror" 
                            name="first_name" 
                            value="{{ old('first_name') }}"
                            placeholder="First name"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input 
                            type="text" 
                            class="form-control @error('last_name') is-invalid @enderror" 
                            name="last_name" 
                            value="{{ old('last_name') }}"
                            placeholder="Last name"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        required
                    >
                    @error('email')
                        <small class="text-danger d-block">{{ $message }}</small>
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
                            placeholder="Min. 8 characters"
                            required
                        >
                        <button type="button" class="toggle-btn" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                    <div class="password-strength-text" id="strengthText">Password strength</div>
                    @error('password')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <div class="password-toggle">
                        <input 
                            type="password" 
                            class="form-control @error('password_confirmation') is-invalid @enderror" 
                            name="password_confirmation" 
                            id="confirmPassword"
                            placeholder="Re-enter password"
                            required
                        >
                        <button type="button" class="toggle-btn" id="toggleConfirmPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="register-btn" id="registerBtn">
                    <i class="fas fa-user-check"></i> Create Account
                </button>

                <div class="login-link">
                    Already have an account? <a href="{{ route('login') }}">Sign in here</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Password visibility toggle
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                this.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('confirmPassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                this.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const strength = calculatePasswordStrength(this.value);
            updateStrengthBar(strength);
        });

        function calculatePasswordStrength(password) {
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            
            return strength;
        }

        function updateStrengthBar(strength) {
            const bar = document.getElementById('strengthBar');
            const text = document.getElementById('strengthText');
            const width = (strength / 5) * 100;
            
            bar.style.width = width + '%';
            
            if (strength <= 1) {
                bar.style.background = '#dc3545';
                text.textContent = 'Weak';
            } else if (strength <= 2) {
                bar.style.background = '#ffc107';
                text.textContent = 'Fair';
            } else if (strength <= 3) {
                bar.style.background = '#17a2b8';
                text.textContent = 'Good';
            } else if (strength <= 4) {
                bar.style.background = '#28a745';
                text.textContent = 'Strong';
            } else {
                bar.style.background = '#20c997';
                text.textContent = 'Very Strong';
            }
        }

        document.getElementById('registerForm').addEventListener('submit', function() {
            const registerBtn = document.getElementById('registerBtn');
            registerBtn.disabled = true;
            registerBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating account...';
        });
    </script>
</body>
</html>
