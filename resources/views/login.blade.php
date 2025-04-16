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
  <style>
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
        @if ($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <div class="mb-3 text-end">
          <a href="#" data-bs-toggle="modal" data-bs-target="#forgotModal">Lupa Sandi?</a>
        </div>
        <button type="submit" class="btn btn-success w-100">Login</button>
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
          <form id="resetForm">
            <div class="mb-3">
              <label for="phoneNumber" class="form-label">Masukkan Nomor HP</label>
              <input type="tel" class="form-control" id="phoneNumber" required>
            </div>
            <div class="mb-3">
              <label for="verificationCode" class="form-label">Kode Verifikasi</label>
              <input type="text" class="form-control" id="verificationCode" required>
            </div>
            <div class="mb-3">
              <label for="newPassword" class="form-label">Sandi Baru</label>
              <input type="password" class="form-control" id="newPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Ubah Sandi</button>
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
</body>

</html>
