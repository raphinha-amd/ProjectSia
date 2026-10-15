<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KasApp</title>
    <!-- Bootstrap 5.3 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light d-flex align-items-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <!-- Sisi Kiri: Branding / Ilustrasi (Hidden di mobile) -->
                        <div
                            class="col-lg-6 d-none d-lg-flex bg-dark text-white p-5 flex-column justify-content-between">
                            <div>
                                <h3 class="fw-bold mb-0"><i class="bi bi-wallet2 text-success me-2"></i>KasApp</h3>
                            </div>
                            <div class="my-auto text-center py-5">
                                <i class="bi bi-shield-lock display-1 text-success mb-4"></i>
                                <h4 class="fw-bold">Manajemen Keuangan Lebih Mudah</h4>
                                <p class="text-white-50 px-4">Kelola kas masuk, kas keluar, buku besar, dan laporan
                                    keuangan organisasi Anda secara transparan dan akurat.</p>
                            </div>
                            <div>
                                <p class="small text-white-50 mb-0">&copy; 2026 KasApp. All rights reserved.</p>
                            </div>
                        </div>

                        <!-- Sisi Kanan: Form Login -->
                        <div class="col-lg-6 p-4 p-sm-5 bg-white">
                            <div class="text-center text-lg-start mb-4">
                                <h2 class="fw-bold text-dark">Selamat Datang!</h2>
                                <p class="text-muted">Silakan masuk menggunakan akun Anda untuk melanjutkan.</p>
                            </div>

                            <!-- Alert Error Contoh (Opsional jika login gagal) -->
                            <!--
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Email atau kata sandi salah.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            -->

                            <form action="dashboard.html" method="GET">
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i
                                                class="bi bi-envelope text-muted"></i></span>
                                        <input type="email" class="form-control bg-light border-start-0 ps-0"
                                            id="email" placeholder="nama@email.com" required
                                            value="admin@kasapp.com">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="password" class="form-label fw-semibold">Kata Sandi</label>
                                        <a href="#" class="small text-decoration-none text-primary">Lupa kata
                                            sandi?</a>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i
                                                class="bi bi-lock text-muted"></i></span>
                                        <input type="password" class="form-control bg-light border-start-0 ps-0"
                                            id="password" placeholder="Masukkan kata sandi" required
                                            value="password123">
                                    </div>
                                </div>

                                <div class="mb-4 form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label text-muted small" for="rememberMe">Ingat saya di
                                        perangkat ini</label>
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                                        <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
