<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin - Kinaara Resort</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="icon" href="img/KinaaraResortLogo.jpg" sizes="32x32" />
  <link rel="icon" href="img/KinaaraResortLogo.png" sizes="192x192" />
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
    /* Tambahkan media query untuk mobile */
    @media (max-width: 576px) {
        .login-container {
            padding: 1.5rem;
            margin: 2rem auto;
            border-radius: 10px;
        }
        
        .logo {
            width: 100px;
        }
        
        h4 {
            font-size: 1.25rem;
        }
    }
    
    /* Untuk modal di mobile */
    @media (max-width: 576px) {
        .modal-dialog {
            margin: 0.5rem auto;
            max-width: 95%;
        }
    }
    
    /* Style yang sudah ada tetap dipertahankan */
    body {
      background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
    }
    .login-container {
      background: rgba(255, 255, 255, 0.95);
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
      max-width: 400px;
      margin: 5rem auto;
    }
    .form-icon {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #777;
    }
    .form-control {
      padding-left: 2.5rem;
    }
    .logo {
      display: block;
      margin: 0 auto 20px;
      width: 120px;
    }
</style>
</head>

<body>
  <div class="container">
    <div class="login-container">
      <img src="/img/kinaararesortlogo.png" alt="Kinaara Resort Logo" class="logo">
      <h4 class="text-center mb-4">Login Admin</h4>
      @if(session('success_reset'))
    <div class="alert alert-success alert-dismissible fade show mb-4">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success_reset') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
      <form method="POST" action="{{ url('/login') }}">
        @csrf
        <div class="mb-3 position-relative">
          <span class="form-icon"><i class="fas fa-user"></i></span>
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3 position-relative">
          <span class="form-icon"><i class="fas fa-lock"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Sandi" id="passwordInput" required>
          <span class="position-absolute end-0 top-50 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword()">
            <i class="fas fa-eye" id="togglePasswordIcon"></i>
          </span>
        </div>
        <div class="mb-3 text-end">
          <a href="#" data-bs-toggle="modal" data-bs-target="#forgotModal">Lupa Sandi?</a>
        </div>
        <button type="submit" class="btn btn-success w-100">Login</button>
        <div class="text-center mt-3">
          <a href="{{ url('/') }}" class="text-decoration-none">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
          </a>
        </div>
      </form>
    </div>
  </div>

<!-- Modal Lupa Sandi -->
<div class="modal fade" id="forgotModal" tabindex="-1">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Lupa Sandi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
              <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}">
                  @csrf
                  <div class="mb-3">
                      <label for="email" class="form-label">Masukkan Email Terdaftar</label>
                      <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Kirim Kode Verifikasi</button>
              </form>
          </div>
      </div>
  </div>
</div>

  <script>
    function togglePassword() {
      const input = document.getElementById('passwordInput');
      const icon = document.getElementById('togglePasswordIcon');
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
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Auto close alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });

    function togglePassword() {
      const input = document.getElementById('passwordInput');
      const icon = document.getElementById('togglePasswordIcon');
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
</script>
</body>

</html>
