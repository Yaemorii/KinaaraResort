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
        :root {
            --sidebar-width: 250px;
            --sidebar-bg: #343a40;
            --primary-color: #0d6efd;
            --mobile-breakpoint: 768px;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--sidebar-bg);
            color: white;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 15px;
            margin: 2px 10px;
            border-radius: 5px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 10px;
        }

        .sidebar .logo-container {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 10px;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        /* Card Styles */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border: none;
        }

        .card-header {
            border-radius: 10px 10px 0 0 !important;
        }

        /* Improved Table Styles */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            table-layout: fixed;
        }

        .table td, .table th {
            vertical-align: middle;
            padding: 12px 8px;
            word-wrap: break-word;
        }

        /* Column Widths */
        .table td:nth-child(1), /* Username */
        .table th:nth-child(1) {
            width: 20%;
        }

        .table td:nth-child(2), /* Email */
        .table th:nth-child(2) {
            width: 25%;
        }

        .table td:nth-child(3), /* Phone */
        .table th:nth-child(3) {
            width: 15%;
        }

        .table td:nth-child(4), /* Role */
        .table th:nth-child(4) {
            width: 15%;
        }

        .table td:nth-child(5), /* Actions */
        .table th:nth-child(5) {
            width: 25%;
            min-width: 150px;
        }

        /* Text Overflow Handling */
        .table td {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .table td:hover {
            overflow: visible;
            white-space: normal;
            text-overflow: clip;
            background-color: rgba(0,0,0,0.02);
            z-index: 1;
            position: relative;
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1050;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .mobile-menu-btn i {
            font-size: 1.2rem;
        }

        /* Overlay for mobile menu */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        @media (max-width: 767.98px) {
            .card-body,
            .table-responsive {
                padding: 15px;
            }

            body {
                font-size: 14px;
            }

            .h2 {
                font-size: 1.5rem;
            }

            .btn {
                padding: 8px 12px;
            }

            /* Touch-friendly elements */
            .btn,
            .form-control,
            .nav-link {
                min-height: 44px;
            }

            /* Mobile table styles */
            .table-responsive table {
                display: block;
                width: 100%;
            }

            .table-responsive thead {
                display: none;
            }

            .table-responsive tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 0.5rem;
                padding: 0.75rem;
                position: relative;
            }

            .table-responsive td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.5rem;
                border: none;
                border-bottom: 1px solid #f0f0f0;
                width: 100% !important;
                white-space: normal;
                overflow: visible;
                text-overflow: clip;
            }

            .table-responsive td:last-child {
                border-bottom: none;
            }

            .table-responsive td:before {
                content: attr(data-label);
                font-weight: bold;
                margin-right: 1rem;
                flex: 0 0 120px;
            }

            /* Form inputs in table cells */
            .table-responsive .form-control {
                flex: 1;
                min-width: 0;
            }

            /* Action buttons in table */
            .table-responsive .btn-group {
                display: flex;
                flex-direction: column;
                gap: 5px;
                width: 100%;
            }

            .table-responsive .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuButton" aria-label="Toggle menu">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo-container text-center">
            <img src="/img/KinaaraResortLogo.png" alt="Logo" width="120" class="img-fluid">
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            @if (Auth::user()->role === 'super_admin')
                <li class="nav-item">
                    <a class="nav-link" href="#account-management">
                        <i class="fas fa-users-cog"></i> Kelola Akun
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-bed"></i> Kelola Kamar
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard Admin</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <span class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-user me-1"></i> {{ Auth::user()->username }}
                        ({{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }})
                    </span>
                </div>
            </div>
        </div>

        @if (Auth::user()->role === 'super_admin')
            <div class="card mb-4" id="account-management">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Kelola Akun</h5>
                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                        <i class="fas fa-plus me-1"></i> Tambah Akun
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Nomor HP</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td data-label="Username">{{ $user->username }}</td>
                                        <td data-label="Email" title="{{ $user->email ?? '-' }}">
                                            {{ $user->email ?? '-' }}
                                        </td>
                                        <td data-label="Nomor HP">{{ $user->phone ?? '-' }}</td>
                                        <td data-label="Role">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</td>
                                        <td data-label="Aksi">
                                            <div class="d-flex flex-wrap gap-2">
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editAccountModal"
                                                    data-id="{{ $user->id }}"
                                                    data-username="{{ $user->username }}"
                                                    data-email="{{ $user->email }}"
                                                    data-phone="{{ $user->phone }}"
                                                    data-role="{{ $user->role }}">
                                                    <i class="fas fa-edit"></i> <span class="d-none d-md-inline">Edit</span>
                                                </button>
                                                @if ($user->id !== Auth::id())
                                                    <form action="{{ route('users.destroy', $user->id) }}"
                                                        method="POST" class="d-inline"
                                                        id="delete-form-{{ $user->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger delete-btn"
                                                            data-id="{{ $user->id }}"
                                                            data-username="{{ $user->username }}">
                                                            <i class="fas fa-trash"></i> <span class="d-none d-md-inline">Hapus</span>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
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
                            @foreach ($rooms as $room)
                                <tr>
                                    <td data-label="Nama Kamar">{{ $room->name }}</td>
                                    <td data-label="Harga per Malam">
                                        <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group mb-2 mb-md-0">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control" name="price"
                                                    value="{{ $room->price }}" min="0"
                                                    step="1000">
                                            </div>
                                    </td>
                                    <td data-label="Sisa Kamar">
                                        <input type="number" class="form-control" name="available" 
                                            value="{{ $room->available }}" min="0">
                                    </td>
                                    <td data-label="Aksi">
                                        <button type="submit" class="btn btn-primary w-100 mt-2 mt-md-0">
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

    <!-- Add Account Modal -->
    <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="toggle-password" style="position: absolute; top: 75%; right: 20px; transform: translateY(-50%); cursor: pointer;">
                                <i class="fa fa-eye" id="togglePassword"></i>
                            </span>
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
        <div class="modal-dialog modal-dialog-centered">
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
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email">
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
                        <div class="mb-3 position-relative">
                            <label for="new_password" class="form-label">Password Baru (Biarkan kosong jika tidak
                                                                                ingin mengubah)</label>
                            <input type="password" class="form-control" id="new_password" name="password">
                            <span class="toggle-password" style="position: absolute; top: 75%; right: 20px; transform: translateY(-50%); cursor: pointer;">
                                <i class="fa fa-eye" id="toggleNewPassword"></i>
                            </span>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mainContent = document.getElementById('mainContent');

        function toggleSidebar() {
            sidebar.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
            
            if (sidebar.classList.contains('show')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        // Close sidebar when clicking outside or on overlay
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking on nav links (mobile only)
        if (window.innerWidth < 992) {
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', toggleSidebar);
            });
        }

        // Handle window resize
        function handleResize() {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
                document.body.style.overflow = '';
            }
        }

        // Initialize event listeners
        mobileMenuButton.addEventListener('click', toggleSidebar);
        window.addEventListener('resize', handleResize);

        // Edit Account Modal
        document.getElementById('editAccountModal').addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const username = button.getAttribute('data-username');
            const phone = button.getAttribute('data-phone');
            const email = button.getAttribute('data-email');
            const role = button.getAttribute('data-role');

            const modal = this;
            modal.querySelector('#edit_username').value = username;
            modal.querySelector('#edit_phone').value = phone;
            modal.querySelector('#edit_email').value = email;
            modal.querySelector('#edit_role').value = role;
            modal.querySelector('#editAccountForm').action = `/users/${id}`;
        });

        // SweetAlert for delete confirmation
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                const userId = this.getAttribute('data-id');
                const username = this.getAttribute('data-username');

                Swal.fire({
                    title: 'Konfirmasi Hapus Akun',
                    html: `Anda yakin ingin menghapus akun <strong>${username}</strong>?<br><small class="text-danger">Aksi ini tidak dapat dibatalkan!</small>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${userId}`).submit();
                    }
                });
            });
        });

        // Auto close alert after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
    <script>
        const passwordInput = document.getElementById('password');
        const togglePasswordIcon = document.getElementById('togglePassword');
        const togglePasswordSpan = document.querySelector('.toggle-password');
    
        togglePasswordSpan.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePasswordIcon.classList.toggle('fa-eye');
            togglePasswordIcon.classList.toggle('fa-eye-slash');
        });
    </script>
    <script>
        const newPasswordInput = document.getElementById('new_password');
        const toggleNewPasswordIcon = document.getElementById('toggleNewPassword');
        const toggleNewPasswordSpan = document.querySelector('.mb-3.position-relative:last-child .toggle-password'); // Seleksi span yang benar
    
        toggleNewPasswordSpan.addEventListener('click', function() {
            const type = newPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            newPasswordInput.setAttribute('type', type);
            toggleNewPasswordIcon.classList.toggle('fa-eye');
            toggleNewPasswordIcon.classList.toggle('fa-eye-slash');
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</body>
</html>