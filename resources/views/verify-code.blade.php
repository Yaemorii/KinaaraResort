<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Kode - Kinaara Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("contextmenu", function(e) {
            e.preventDefault();
        });

        document.addEventListener("keydown", function(e) {
            if (
                e.key === "F12" ||
                (e.ctrlKey && e.shiftKey && (e.key === "I" || e.key === "J" || e.key === "C")) ||
                (e.ctrlKey && e.key === "U")
            ) {
                e.preventDefault();
            }
        });

        (function() {
            let threshold = 160;
            let checkDevTools = function() {
                let start = new Date();
                debugger;
                let end = new Date();
                if (end - start > threshold) {
                    alert("Developer Tools terdeteksi! Akses diblokir.");
                    window.location.href = "https://www.google.com"; // Redirect
                }
            };
            setInterval(checkDevTools, 1000);
        })();
    </script>
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
        }
        .verify-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            margin: 5rem auto;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 120px;
        }
        .form-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
        }
        .input-with-icon {
            position: relative;
            margin-bottom: 1rem; /* Memberikan jarak yang konsisten */
        }
        .input-with-icon input {
            padding-left: 40px;
            padding-right: 40px;
        }
        /* Animasi notifikasi */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert-animated {
            animation: fadeIn 0.5s ease-out;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        .alert-danger .btn-close {
            filter: brightness(0.7);
        }
        .alert-danger i.fas {
            color: #dc3545;
        }
        .password-mismatch {
            border-color: #dc3545 !important;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }
        /* Perbaikan untuk posisi ikon yang tetap */
        .password-input-container {
            position: relative;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="verify-container">
        <img src="/img/kinaararesortlogo.png" alt="Kinaara Resort Logo" class="logo">
        <h4 class="text-center mb-4">Verifikasi Kode</h4>

        <form id="resetPasswordForm" method="POST" action="{{ route('password.reset') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $email ?? session('email') }}">

            <div class="mb-3 input-with-icon">
                <label for="verification_code" class="form-label">Kode Verifikasi</label>
                <div class="password-input-container">
                    <span class="form-icon"><i class="fas fa-envelope"></i></span>
                    <input type="text" class="form-control" id="verification_code" name="verification_code" required>
                </div>
            </div>

            <div class="mb-3 input-with-icon">
                <label for="password" class="form-label">Password Baru</label>
                <div class="password-input-container">
                    <span class="form-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <span class="password-toggle" onclick="togglePassword('password')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <div class="mb-3 input-with-icon">
                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                <div class="password-input-container">
                    <span class="form-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <div id="passwordMismatchError" class="error-message">Password tidak sesuai</div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-sync-alt me-2"></i> Reset Password
            </button>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-decoration-none">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Halaman Login
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        const icon = input.nextElementSibling.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Real-time password confirmation check
    document.getElementById('password_confirmation').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const confirmPassword = this.value;
        const errorElement = document.getElementById('passwordMismatchError');
        
        if (password && confirmPassword && password !== confirmPassword) {
            this.classList.add('password-mismatch');
            errorElement.style.display = 'block';
        } else {
            this.classList.remove('password-mismatch');
            errorElement.style.display = 'none';
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('resetPasswordForm');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const confirmInput = document.getElementById('password_confirmation');
        const errorElement = document.getElementById('passwordMismatchError');
        
        // Check password match before submission
        if (password !== confirmPassword) {
            confirmInput.classList.add('password-mismatch');
            errorElement.style.display = 'block';
            confirmInput.focus();
            return;
        }
        
        // Proceed with form submission if passwords match
        const formData = new FormData(this);

        fetch("{{ route('password.reset') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = data.redirect;
                });
            }
        })
        .catch(error => {
            // Menampilkan error menggunakan SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: error.message || 'Terjadi kesalahan saat memproses permintaan.',
            });
        });
    });

        // Handle other errors (not password confirmation)
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ $error }}',
                });
            @endforeach
        @endif

        @if(session('verification_error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('verification_error') }}',
            });
            {{ session()->forget('verification_error') }}
        @endif
    });
</script>
</body>
</html>