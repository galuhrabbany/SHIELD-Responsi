@extends('layout.template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #0a0a0a, #1a1a1a);
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }

        .futuristic-card {
            background: rgba(30, 30, 30, 0.6);
            border: 1px solid rgba(255, 0, 79, 0.3);
            backdrop-filter: blur(12px);
            box-shadow: 0 0 25px rgba(255, 0, 79, 0.15), 0 0 10px #ff004f55 inset;
            transition: 0.3s ease;
            border-radius: 1.5rem;
        }

        .futuristic-card:hover {
            transform: scale(1.02);
            box-shadow: 0 0 35px rgba(255, 0, 79, 0.4);
        }

        .text-gradient {
            background: linear-gradient(to right, #ff004f, #ffae00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-future {
            background: linear-gradient(to right, #ff004f, #ffae00);
            border: none;
            color: #fff;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-future:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px #ff004f88;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid px-5 py-5">

    <!-- HEADER -->
    <div class="text-center mb-5">
        <h1 class="fw-bold display-3 text-gradient">SHIELD DIY</h1>
        <p class="lead text-light">Sexual Harm Incident & Emergency Location Dashboard</p>
        <p class="text-muted fst-italic">Data speaks where words fail. Empowering silent voices through real-time awareness.</p>
    </div>

    <!-- STATISTIC CARDS -->
    <div class="row mb-5 text-center g-4">
        @foreach([
            ['label'=>'Kasus Terdata','jumlah'=>312],
            ['label'=>'Laporan Anonim','jumlah'=>210],
            ['label'=>'Zona Rawan','jumlah'=>48],
            ['label'=>'Pengguna Aktif','jumlah'=>139],
        ] as $stat)
        <div class="col-md-3">
            <div class="futuristic-card p-4">
                <h6 class="text-uppercase mb-2" style="letter-spacing: 1px;">{{ $stat['label'] }}</h6>
                <h3 class="fw-bold text-danger">{{ $stat['jumlah'] }}</h3>
            </div>
        </div>
        @endforeach
    </div>

    <!-- CHARTS -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="futuristic-card p-4">
                <h6 class="text-center mb-3 text-gradient">📈 Tren Kasus per Tahun</h6>
                <canvas id="lineChart" height="200"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="futuristic-card p-4">
                <h6 class="text-center mb-3 text-gradient">🚨 Jenis Kekerasan Terdata</h6>
                <canvas id="barHorizontalChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- DONUT CHART + INFO -->
    <div class="row g-4 mb-5 justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="futuristic-card p-4">
                <h6 class="text-center mb-3 text-gradient">🔐 Metode Pelaporan</h6>
                <canvas id="donutChart" height="200"></canvas>
            </div>
        </div>
        <div class="col-md-7">
            <div class="text-light fst-italic small px-3">
                <p><span style="color:#ff004f;">🔴 Anonim:</span> Mayoritas korban memilih anonim karena takut stigma dan kurangnya keamanan hukum.</p>
                <p><span style="color:#ffae00;">🟡 Terbuka:</span> Pelapor terbuka biasanya mendapat dukungan hukum & psikologis dari organisasi pendamping.</p>
            </div>
        </div>
    </div>

    <!-- QUOTES -->
    <div class="row g-4 mb-5">
        @foreach([
            "Aku kira suara aku gak penting. Tapi SHIELD bikin aku berani cerita.",
            "Setelah lama bungkam, akhirnya ada platform yang dengerin aku tanpa menghakimi.",
            "Buat pertama kalinya, aku merasa aman waktu laporan lewat SHIELD.",
        ] as $quote)
        <div class="col-md-4">
            <div class="futuristic-card p-4 border-start border-danger border-5">
                <blockquote class="blockquote text-white mb-0">
                    <p>“{{ $quote }}”</p>
                    <footer class="blockquote-footer text-muted mt-2">— Korban Anonim</footer>
                </blockquote>
            </div>
        </div>
        @endforeach
    </div>

    <!-- 🎞️ IMAGE CAROUSEL -->
    <div class="mb-5">
        <h5 class="text-gradient mb-4 text-center">📸 Galeri Edukasi & Kampanye</h5>
        <div id="campaignCarousel" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach([
                    ['img' => 'https://res.cloudinary.com/dk0z4ums3/image/upload/v1535351692/attached_image/ayo-antisipasi-watak-pelaku-kekerasan-seksual-dari-sekarang.jpg', 'caption' => 'Pelaporan Yang Real-Time'],
                    ['img' => 'https://i0.wp.com/ciputrahospital.com/wp-content/uploads/2024/06/non-explicit-image-child-abuse-1.jpg?fit=1000%2C667&ssl=1', 'caption' => 'Edukasi Kekerasan Seksual di Kampus'],
                    ['img' => 'https://hmsejarah.fib.undip.ac.id/wp-content/uploads/2024/09/Ilustrasi-kekerasan-seksual-20221018112811.jpg', 'caption' => 'SHIELD Berpihak Kepada Korban']
                ] as $i => $slide)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                    <img src="{{ $slide['img'] }}" class="d-block w-100" style="height: 400px; object-fit: cover; filter: brightness(80%);">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="fw-bold text-white" style="text-shadow: 0 0 10px #000;">{{ $slide['caption'] }}</h5>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#campaignCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#campaignCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    <!-- Preview External Resources -->
    <div class="row g-4 mb-5">
        <h5 class="text-gradient mb-4 text-center">🌐 Referensi & Website Pendukung</h5>
        @foreach([
            ['title' => 'Komnas Perempuan', 'url' => 'https://komnasperempuan.go.id', 'desc' => 'Lembaga negara yang membela hak perempuan korban kekerasan.'],
            ['title' => 'LBH APIK', 'url' => 'https://lbhapik.org', 'desc' => 'Lembaga Bantuan Hukum untuk korban kekerasan berbasis gender.'],
            ['title' => 'SAFEnet', 'url' => 'https://safenet.or.id', 'desc' => 'Perlindungan kebebasan berekspresi dan korban kekerasan digital.'],
        ] as $site)
        <div class="col-md-4">
            <a href="{{ $site['url'] }}" target="_blank" class="text-decoration-none">
                <div class="futuristic-card p-4 h-100">
                    <h5 class="mb-2 text-gradient">{{ $site['title'] }}</h5>
                    <p class="text-muted small">{{ $site['desc'] }}</p>
                    <span class="text-light small">🔗 {{ parse_url($site['url'], PHP_URL_HOST) }}</span>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <!-- CTA -->
    <div class="text-center my-5">
        <a href="/map" class="btn btn-lg btn-future px-5 py-3 rounded-pill shadow-lg">💬 Laporkan Kejadian Sekarang</a>
        <p class="small text-muted mt-2">Setiap laporan bisa menyelamatkan hidup. Suaramu berarti.</p>
    </div>

    <!-- FOOTER -->
    <footer class="text-center text-light small mt-5">
        <hr class="border-secondary">
        <p>Dikembangkan oleh Galuh Ayu Cita Rabbany | 23/514562/SV/22380 | Kelas A</p>
        <p>&copy; <span id="year"></span> SHIELD DIY – Bersama kita lawan kekerasan seksual.</p>
    </footer>
</div>

<!-- SCRIPTS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.getElementById('year').textContent = new Date().getFullYear();

    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['2019', '2020', '2021', '2022', '2023', '2024'],
            datasets: [{
                label: 'Jumlah Kasus',
                data: [50, 80, 120, 150, 180, 210],
                borderColor: '#ff004f',
                backgroundColor: 'rgba(255,0,79,0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true, ticks: { color: '#fff' }, grid: { color: '#333' } },
                x: { ticks: { color: '#fff' }, grid: { color: '#333' } }
            },
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });

    new Chart(document.getElementById('barHorizontalChart'), {
        type: 'bar',
        data: {
            labels: ['Pelecehan Verbal', 'Fisik', 'Online', 'Pemerkosaan', 'Eksploitasi'],
            datasets: [{
                label: 'Jumlah Laporan',
                data: [75, 60, 40, 35, 20],
                backgroundColor: '#ff004f'
            }]
        },
        options: {
            indexAxis: 'y',
            scales: {
                x: { beginAtZero: true, ticks: { color: '#fff' }, grid: { color: '#333' } },
                y: { ticks: { color: '#fff' }, grid: { color: '#333' } }
            },
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });

    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Anonim', 'Terbuka'],
            datasets: [{
                data: [70, 30],
                backgroundColor: ['#ff004f', '#ffae00']
            }]
        },
        options: {
            cutout: '65%',
            plugins: {
                legend: { labels: { color: '#fff' } }
            }
        }
    });
</script>
@endsection
