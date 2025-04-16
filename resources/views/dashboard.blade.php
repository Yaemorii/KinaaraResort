<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kinaara Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="/img/KinaaraResortLogo.jpg" sizes="32x32" />
    <link rel="icon" href="/img/KinaaraResortLogo.png" sizes="192x192" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
            transition: all 0.3s;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 10px 15px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .main-content {
            padding: 20px;
            transition: all 0.3s;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #f8f9fa;
        }
        /* Mobile menu button */
        .mobile-menu-btn {
            display: none;
        }
        @media (max-width: 767.98px) {
            .mobile-menu-btn {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1050;
            }
            .sidebar {
                position: fixed;
                left: -250px;
                width: 250px;
                z-index: 1040;
            }
            .sidebar.show {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
            /* Table as cards on mobile */
            .table-responsive table {
                display: block;
                width: 100%;
            }
            .table-responsive tr {
                display: flex;
                flex-direction: column;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 0.25rem;
            }
            .table-responsive td {
                border: none;
                padding: 0.5rem;
            }
            .table-responsive td:before {
                content: attr(data-label);
                font-weight: bold;
                display: inline-block;
                width: 120px;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Button -->
    <button class="btn btn-primary mobile-menu-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar bg-dark" id="sidebar">
                <div class="text-center py-4">
                    <img src="/img/kinaararesortlogo.png" alt="Logo" width="120" class="img-fluid">
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </li>
                    @if(Auth::user()->role === 'super_admin')
                    <li class="nav-item">
                        <a class="nav-link" href="#account-management">
                            <i class="fas fa-users-cog me-2"></i> Kelola Akun
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-bed me-2"></i> Kelola Kamar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content" id="mainContent">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard Admin</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <span class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-user me-1"></i> {{ Auth::user()->username }} ({{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }})
                            </span>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(Auth::user()->role === 'super_admin')
                <div class="card mb-4" id="account-management">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Kelola Akun</h5>
                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                                <i class="fas fa-plus me-1"></i> Tambah Akun
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Nomor HP</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $user->role)) }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAccountModal" 
                                                data-id="{{ $user->id }}"
                                                data-username="{{ $user->username }}"
                                                data-phone="{{ $user->phone }}"
                                                data-role="{{ $user->role }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            @if($user->id !== Auth::id())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Kelola Harga dan Ketersediaan Kamar</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="d-none d-md-table-header-group">
                                    <tr>
                                        <th>Nama Kamar</th>
                                        <th>Harga per Malam</th>
                                        <th>Sisa Kamar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rooms as $room)
                                    <tr>
                                        <td data-label="Nama Kamar">{{ $room->name }}</td>
                                        <td data-label="Harga">
                                            <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="number" class="form-control" name="price" value="{{ $room->price }}" min="0" step="1000">
                                                </div>
                                        </td>
                                        <td data-label="Sisa Kamar">
                                                <input type="number" class="form-control mt-2 mt-md-0" name="available" value="{{ $room->available }}" min="0">
                                        </td>
                                        <td data-label="Aksi">
                                                <button type="submit" class="btn btn-sm btn-primary mt-2 mt-md-0 w-100">
                                                    <i class="fas fa-save d-md-none"></i>
                                                    <span class="d-none d-md-inline">Update</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Account Modal -->
    <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAccountModalLabel">Tambah Akun Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option value="admin">Admin Biasa</option>
                                <option value="super_admin">Admin Utama</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Account Modal -->
    <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editAccountForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAccountModalLabel">Edit Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="edit_username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_phone" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="edit_phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="edit_role" class="form-label">Role</label>
                            <select class="form-select" id="edit_role" name="role">
                                <option value="admin">Admin Biasa</option>
                                <option value="super_admin">Admin Utama</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru (Biarkan kosong jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control" id="new_password" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
            
            const mainContent = document.getElementById('mainContent');
            if (sidebar.classList.contains('show')) {
                mainContent.style.marginLeft = '250px';
            } else {
                mainContent.style.marginLeft = '0';
            }
        }
        
        // Auto close sidebar when clicking on mobile
        if (window.innerWidth < 768) {
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    document.getElementById('sidebar').classList.remove('show');
                    document.getElementById('mainContent').style.marginLeft = '0';
                });
            });
        }

        // Edit Account Modal
        document.getElementById('editAccountModal').addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const username = button.getAttribute('data-username');
            const phone = button.getAttribute('data-phone');
            const role = button.getAttribute('data-role');
            
            const modal = this;
            modal.querySelector('#edit_username').value = username;
            modal.querySelector('#edit_phone').value = phone;
            modal.querySelector('#edit_role').value = role;
            modal.querySelector('#editAccountForm').action = `/users/${id}`;
        });
    </script>
</body>
</html>