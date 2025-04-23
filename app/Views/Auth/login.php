<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MDI File Storage</title>
    <link rel="shortcut icon" href="<?= base_url(); ?>/img/MDI.png" type="image/svg+xml" />
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --form-transparency: 0.75; /* Control form transparency here (0 = fully transparent, 1 = fully opaque) */
        }

        /* Preloader */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .preloader.fade-out {
            animation: fadeOut 1s ease-in-out forwards;
        }
        
        .preloader-logo {
            width: 300px; /* Increased width */
            height: auto; /* Remove fixed height to maintain aspect ratio */
            object-fit: contain; /* Ensure image maintains aspect ratio */
            animation: breathe 2s ease-in-out infinite;
            filter: drop-shadow(0 0 15px rgba(255, 0, 0, 0.5)); /* Red glow effect */
        }
        
        @keyframes breathe {
            0% {
                transform: scale(1);
                opacity: 0.8;
                filter: drop-shadow(0 0 10px rgba(255, 0, 0, 0.3));
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
                filter: drop-shadow(0 0 20px rgba(255, 0, 0, 0.6));
            }
            100% {
                transform: scale(1);
                opacity: 0.8;
                filter: drop-shadow(0 0 10px rgba(255, 0, 0, 0.3));
            }
        }
        
        @keyframes fadeOut {
            to {
                opacity: 0;
                visibility: hidden;
            }
        }

        /* Video Background */
        .video-background {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
            object-fit: cover;
        }

        /* Login Container */
        .login-container {
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.4); /* Reduced opacity for better video visibility */
        }

        .login-box {
            background: rgba(255, 255, 255, var(--form-transparency));
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative; /* Added for better shadow rendering */
            z-index: 1; /* Ensures the box stays above the background */
        }

        .login-box .form-control {
            background-color: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.75rem;
        }

        .login-box .form-control:focus {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .login-box label {
            font-weight: 500;
            color: rgba(0, 0, 0, 0.8);
        }

        .btn-login {
            padding: 0.75rem;
            font-weight: 600;
            background: rgba(13, 110, 253, 0.9);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: rgba(13, 110, 253, 1);
            transform: translateY(-2px);
        }

        .logo-img {
            max-width: 150px;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 0 5px rgba(0, 0, 0, 0.2)); /* Added shadow to logo */
        }

        .form-check-label {
            user-select: none;
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="<?= base_url(); ?>/img/mdi-nobg.png" alt="MDI Logo" class="preloader-logo">
    </div>

    <!-- Video Background -->
    <video autoplay muted loop class="video-background">
        <source src="<?= base_url(); ?>/video/mdi-vid.mp4" type="video/mp4">
    </video>

    <!-- Login Container -->
    <div class="login-container d-flex align-items-center justify-content-center">
        <div class="login-box">
            <!-- Logo -->
            <div class="text-center">
                <img src="<?= base_url(); ?>/img/mdi-nobg.png" alt="Logo" class="logo-img">
                <h4 class="mb-4">SPARC Monitoring Dashboard</h4>
            </div>

            <?= view('Myth\Auth\Views\_message_block') ?>

            <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Username Field -->
                <div class="mb-3">
                    <label for="login" class="form-label">Username</label>
                    <input type="text" class="form-control <?php if (session('errors.login')): ?>is-invalid<?php endif ?>" 
                           id="login" name="login" required autofocus>
                    <?php if (session('errors.login')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.login') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control <?php if (session('errors.password')): ?>is-invalid<?php endif ?>" 
                           id="password" name="password" required>
                    <?php if (session('errors.password')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Remember Me -->
                <?php if ($config->allowRemembering): ?>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" 
                           <?php if (old('remember')): ?> checked <?php endif; ?>>
                    <label class="form-check-label" for="remember"><?= lang('Auth.rememberMe') ?></label>
                </div>
                <?php endif; ?>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-login">Login</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Preloader Script -->
    <script>
        window.addEventListener('load', function() {
            const preloader = document.querySelector('.preloader');
            preloader.classList.add('fade-out');
            
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 1000);
        });
    </script>
</body>
</html>