@extends('layout.template')

@section('content')
    <div class="container-fluid px-5 py-5"
        style="background: linear-gradient(135deg, #0a0a12, #12121a); color: #e0e0e0; font-family: 'Rajdhani', monospace; min-height: 100vh;">

        <!-- HEADER -->
        <div class="text-center mb-5">
            <h1 class="fw-bold display-4"
                style="color: #ff004f; letter-spacing: 0.3em; text-transform: uppercase; text-shadow: 0 0 20px #ff004f;">
                SHIELD DIY
            </h1>
            <p class="lead" style="color: #bbb; letter-spacing: 0.08em;">
                Sexual Harm Incident & Emergency Location Dashboard
            </p>
            <p class="text-muted" style="max-width: 650px; margin: 0 auto; font-style: italic; color: #888;">
                Menyediakan insight real-time dan data spasial terintegrasi untuk penanggulangan kekerasan seksual dengan
                teknologi terkini dan pendekatan yang berpihak pada korban.
            </p>
        </div>

        <!-- INFO GRID -->
        <div class="row g-5 mb-5 justify-content-center">

            <!-- Box 1: Apa itu SHIELD -->
            <div class="col-md-4"
                style="background: linear-gradient(145deg, #1b1b27, #232336); border-left: 6px solid #ff004f; border-radius: 20px; padding: 2rem; box-shadow: 0 0 25px #ff004f88, 0 0 10px #ff004f88 inset;">
                <h5 class="fw-bold text-uppercase"
                    style="color: #ff004f; letter-spacing: 0.15em; margin-bottom: 1.5rem; text-shadow: 0 0 6px #ff004f;">
                    <i class="fa-solid fa-shield-halved me-2"></i>Apa itu SHIELD?
                </h5>
                <p style="color: #e0e0e0; font-size: 0.95rem; line-height: 1.8;">
                    <strong>SHIELD</strong> adalah platform WebGIS berbasis <span style="color:#ff77a9;">peta</span> dan
                    <span style="color:#ff77a9;">data</span> untuk memetakan dan memonitor kekerasan seksual secara
                    <span style="color:#ff77a9;">real-time</span> di DIY. Dirancang untuk memfasilitasi respons cepat lewat
                    integrasi multi-sumber data demi <span style="color:#ff77a9;">perlindungan & intervensi yang
                        optimal</span>.
                </p>
            </div>

            <!-- Box 2: Kenapa Perlu -->
            <div class="col-md-4"
                style="background: linear-gradient(145deg, #1b1b27, #232336); border-left: 6px solid #00eaff; border-radius: 20px; padding: 2rem; box-shadow: 0 0 25px #00eaff88, 0 0 10px #00eaff88 inset;">
                <h5 class="fw-bold text-uppercase"
                    style="color: #00eaff; letter-spacing: 0.15em; margin-bottom: 1.5rem; text-shadow: 0 0 6px #00eaff;">
                    <i class="fa-solid fa-bolt me-2"></i>Kenapa Perlu?
                </h5>
                <p style="color: #e0e0e0; font-size: 0.95rem; line-height: 1.8;">
                    Ketepatan & kecepatan respons jadi kunci penyelamatan korban. <strong>SHIELD</strong> menyajikan
                    <span style="color:#67f2ff;">data spasial presisi</span> dan <span style="color:#67f2ff;">analitik
                        prediktif</span>
                    untuk mengidentifikasi zona rawan dan menerapkan strategi penanganan yang
                    <span style="color:#67f2ff;">adaptif & responsif</span>.
                </p>
            </div>

            <!-- Box 3: Fitur Unggulan -->
            <div class="col-md-4"
                style="background: linear-gradient(145deg, #1b1b27, #232336); border-left: 6px solid #ffae00; border-radius: 20px; padding: 2rem; box-shadow: 0 0 25px #ffae00a8, 0 0 10px #ffae00a8 inset;">
                <h5 class="fw-bold text-uppercase"
                    style="color: #ffae00; letter-spacing: 0.15em; margin-bottom: 1.5rem; text-shadow: 0 0 8px #ffae00;">
                    <i class="fa-solid fa-microchip me-2"></i>Fitur Unggulan
                </h5>
                <ul style="color: #e0e0e0; font-size: 0.95rem; line-height: 1.8; padding-left: 0.5rem; list-style: none;">
                    <li class="mb-2">
                        <i class="fa-solid fa-location-crosshairs text-info me-2"></i>
                        Real-time mapping & pengaduan lokasi kejadian
                    </li>
                    <li class="mb-2">
                        <i class="fa-solid fa-brain text-danger me-2"></i>
                        Zona rawan prediktif berbasis machine learning
                    </li>
                    <li class="mb-2">
                        <i class="fa-solid fa-user-secret text-warning me-2"></i>
                        Pelaporan anonim dengan enkripsi end-to-end
                    </li>
                    <li>
                        <i class="fa-solid fa-chart-line text-success me-2"></i>
                        Dashboard yang dinamis dan interaktif
                    </li>
                </ul>
            </div>

        </div>


        <!-- CAROUSEL PREVIEW -->
        <div class="row mb-5">
            <div class="col">
                <div id="shieldCarousel" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel"
                    data-bs-interval="7000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://img.jakpost.net/c/2020/03/09/2020_03_09_88634_1583742108._large.jpg"
                                class="d-block w-100" alt="Preview SHIELD 1">
                            <div class="carousel-caption d-none d-md-block" style="text-shadow: 0 0 8px #ff004f;">
                                <h5 style="color: #ff004f;">Integrasi Data Real-Time</h5>
                                <p>Memonitor lokasi dan kejadian secara langsung untuk respons cepat.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://s.france24.com/media/display/2129f042-7a1f-11ec-b0f9-005056bf30b7/w:1280/p:16x9/Beirut%20on%20December%207%2C%202019.%20%28AP%20Photo_Bilal%20Hussein%29.jpg"
                                class="d-block w-100" alt="Preview SHIELD 2">
                            <div class="carousel-caption d-none d-md-block" style="text-shadow: 0 0 8px #00eaff;">
                                <h5 style="color: #00eaff;">Teknologi Pelaporan Anonim</h5>
                                <p>Keamanan pelapor dijamin dengan enkripsi dan protokol ketat.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://d.ibtimes.co.uk/en/full/1689307/sexual-harassment-protest.jpg?w=1600&h=900&q=88&f=cdb7b41ca833b80e0a0695231f846024"
                                class="d-block w-100" alt="Preview SHIELD 3">
                            <div class="carousel-caption d-none d-md-block" style="text-shadow: 0 0 8px #ffa500;">
                                <h5 style="color: #ffa500;">Advokasi dan Intervensi Berbasis Data</h5>
                                <p>Memperkuat advokasi melalui data analitik dan evaluasi berkala.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#shieldCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-danger rounded-circle" aria-hidden="true"
                            style="filter: drop-shadow(0 0 2px #ff004f);"></span>
                        <span class="visually-hidden">Sebelumnya</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#shieldCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-danger rounded-circle" aria-hidden="true"
                            style="filter: drop-shadow(0 0 2px #ff004f);"></span>
                        <span class="visually-hidden">Selanjutnya</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- AUTHOR & FOOTER -->
        <div class="row">
            <div class="col text-center mt-4">
                <hr class="border-secondary">
                <p class="mb-1 small" style="color: #666;">Dikembangkan untuk:</p>
                <h6 style="color: #ff004f; font-weight: 700;">Praktikum Pemrograman Geospasial Web: Lanjut</h6>
                <p class="small text-muted" style="color: #999;">Galuh Ayu Cita Rabbany • 23/514562/SV/22380 • Kelas A</p>
            </div>
        </div>

        <!-- COPYRIGHT -->
        <div class="text-center mt-4 py-2" style="color: #555;">
            <span class="small">
                &copy; <span id="year"></span> <strong style="color: #ff004f;">SHIELD DIY</strong> – Designed with
                purpose, powered by awareness.
                <a href="mailto:galuhrabbany@gmail.com" class="text-decoration-none"
                    style="color: #00eaff; margin-left: 10px;">Contact Us</a>
            </span>
        </div>

        <style>
            #shieldCarousel .carousel-inner {
                max-height: 580px;
                /* dikurangi dari 480 jadi 400 */
                background: #1b1b27;
            }

            #shieldCarousel .carousel-item img {
                height: 580px;
                object-fit: cover;
                filter: brightness(0.8) contrast(1.1);
            }

            @media (max-width: 768px) {
                #shieldCarousel .carousel-inner {
                    max-height: 250px;
                }

                #shieldCarousel .carousel-item img {
                    height: 250px;
                }
            }
        </style>
    </div>

    <!-- YEAR SCRIPT -->
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
@endsection
