@extends('layouts.user_type.guest')

@section('content')
<main class="main-content mt-0">
    <section class="min-vh-100 d-flex align-items-center" style="background-color: #f3f4f6;">
        <div class="container-fluid m-0 p-0 h-100">
            <div class="row g-0 h-100 min-vh-100">
                
                <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-center align-items-center position-relative text-white"
                     style="background-image: url('../assets/img/buldingfront.jpg'); background-size: cover; background-position: center;">
                    
                    <div class="position-absolute w-100 h-100 top-0 start-0" style="background-color: rgba(28, 43, 70, 0.85);"></div>

                    <div class="position-relative z-index-1 text-center px-5">
                        
                        <!-- <div class="mb-4 d-flex justify-content-center align-items-center gap-3 flex-wrap">
                            <img src="../assets/img/logo-lldikti4-white.png" alt="LLDIKTI 4" style="height: 50px;">
                            <img src="../assets/img/logo-diktisaintek.png" alt="Diktisaintek" style="height: 40px;">
                        </div> -->

                        <h2 class="text-white font-weight-bolder mb-2" style="letter-spacing: 1px;">
                            LLDIKTI WILAYAH IV<br>JAWA BARAT DAN BANTEN
                        </h2>
                        <p class="text-white text-lg font-weight-light">Sistem Informasi Navigasi Data Kerja Sama</p>

                        <!-- <div class="mt-4 d-flex justify-content-center gap-4">
                            <a href="#" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-twitter fa-lg"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-lg"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-tiktok fa-lg"></i></a>
                        </div> -->
                    </div>
                </div>

                <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center">
                    
                    <div class="card shadow-lg border-0" style="width: 100%; max-width: 420px; border-radius: 12px;">
                        <div class="card-body p-5">
                            
                            <div class="text-center mb-4">
                                <img src="../assets/img/logo_lldikti_iv.jpg" alt="Logo" class="mb-3" style="width: 60px;">
                                <h4 class="font-weight-bolder text-dark mb-1">Masuk ke SENAD4 IV</h4>
                                <p class="text-muted text-xs">Sistem Informasi Navigasi Data Kerja Sama</p>
                            </div>

                            <form role="form" method="POST" action="/session">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label text-xs font-weight-bold text-dark">Email / Username</label>
                                    <div class="input-group border rounded">
                                        <span class="input-group-text bg-white border-0"><i class="fas fa-user text-muted"></i></span>
                                        <input type="text" class="form-control border-0 ps-0" name="name" id="name" placeholder="Email atau Username" aria-label="Name" required autofocus>
                                    </div>
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label text-xs font-weight-bold text-dark">Password</label>
                                    <div class="input-group border rounded">
                                        <span class="input-group-text bg-white border-0"><i class="fas fa-lock text-muted"></i></span>
                                        <input type="password" class="form-control border-0 ps-0" name="password" id="password" placeholder="Password" aria-label="Password" required>
                                        <span class="input-group-text bg-white border-0 cursor-pointer"><i class="fas fa-eye text-muted"></i></span>
                                    </div>
                                    @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- <div class="mb-4 mt-2">
                                    <div class="border rounded p-2 d-flex align-items-center justify-content-between" style="background-color: #f9f9f9;">
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" class="ms-2 me-3" style="transform: scale(1.5);">
                                            <span class="text-sm">I'm not a robot</span>
                                        </div>
                                        <div class="text-center d-flex flex-column align-items-center">
                                            <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" alt="reCAPTCHA" style="width: 25px;">
                                            <span style="font-size: 8px; color: #555;">reCAPTCHA</span>
                                        </div>
                                    </div> 
                                </div> -->

                                <!-- <div class="form-check d-flex align-items-center mb-4 ps-0">
                                    <input class="border" type="checkbox" id="rememberMe" name="remember" style="width: 16px; height: 16px;">
                                    <label class="form-check-label text-xs mb-0 ms-2" for="rememberMe">Ingat saya</label>
                                </div> -->

                                <div class="text-center">
                                    <button type="submit" class="btn w-100 text-white text-capitalize shadow-none" style="background-color: #2563eb; font-size: 14px; padding: 12px 0;">
                                        <i class="fas fa-sign-in-alt me-2"></i> Masuk
                                    </button>
                                </div>

                                <div class="text-center mt-3">
                                    <a href="https://lldikti4.kemdiktisaintek.go.id/" class="text-xs text-decoration-none" style="color: #2563eb;" target="_blank">
                                        <i class="fas fa-globe me-1"></i> lldikti4.kemdiktisaintek.go.id
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="text-center mt-4" style="font-size: 11px; color: #6b7280;">
                        <p class="mb-1">&copy; 2024 LLDIKTI Wilayah IV. All rights reserved.</p>
                        <p>
                            <a href="#" class="text-decoration-none" style="color: #3b82f6;">Kebijakan Privasi</a> | 
                            <a href="#" class="text-decoration-none" style="color: #3b82f6;">Syarat Layanan</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
@endsection