<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Kinaara Resort</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f7f7f7;
      font-family: 'Segoe UI', sans-serif;
    }
    .sidebar {
      height: 100vh;
      background-color: #198754;
      color: white;
      padding: 1.5rem 1rem;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      margin: 0.5rem 0;
    }
    .sidebar a:hover {
      text-decoration: underline;
    }
    .content {
      padding: 2rem;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 sidebar">
      <h4>Kinaara Admin</h4>
      <hr>
      <a href="#"><i class="fas fa-bed me-2"></i> Kelola Kapasitas Resort</a>
      <a href="#"><i class="fas fa-tags me-2"></i> Kelola Harga Resort</a>
      <a href="#"><i class="fas fa-image me-2"></i> Kelola Gambar</a>
      <a href="#"><i class="fas fa-file-alt me-2"></i> Artikel & Portofolio</a>
      <a href="#"><i class="fas fa-sign-out-alt me-2"></i> 
        <form action="{{ url('/logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-link text-white p-0 m-0 align-baseline" style="text-decoration: none;">Logout</button>
        </form>
      </a>
    </div>

    <!-- Content -->
    <div class="col-md-9 content">
      <h3>Selamat datang di Dashboard Admin</h3>
      <p>Silakan pilih menu di sebelah kiri untuk mulai mengelola konten situs web Kinaara Resort.</p>

      <div class="row mt-4">
        <div class="col-md-4 mb-3">
          <div class="card p-4">
            <h5><i class="fas fa-bed me-2"></i> Kapasitas Resort</h5>
            <p>Kelola jumlah kamar dan ketersediaan resort.</p>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card p-4">
            <h5><i class="fas fa-tags me-2"></i> Harga Resort</h5>
            <p>Update harga dan promo setiap jenis resort.</p>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card p-4">
            <h5><i class="fas fa-image me-2"></i> Galeri & Gambar</h5>
            <p>Atur gambar yang ditampilkan di situs.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
