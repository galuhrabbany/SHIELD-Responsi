@extends('layout.template')

@section('title', 'Kontak Darurat - SHIELD')

@section('styles')
    <style>
        body {
            background: linear-gradient(135deg, #0f0f0f, #1a1a2e);
            background-attachment: fixed;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
        }
        .card-custom {
            background: rgba(20, 20, 35, 0.9);
            border: 1px solid #333;
            box-shadow: 0 0 20px rgba(255, 0, 100, 0.2);
        }
        .glow-header {
            text-shadow: 0 0 8px #ff007f, 0 0 15px #ff007f;
        }
        .badge-custom {
            background: linear-gradient(45deg, #ff004c, #ffb347);
            color: white;
            font-weight: bold;
            box-shadow: 0 0 10px rgba(255, 0, 76, 0.5);
        }
        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: #000;
        }
    </style>
@endsection

@section('content')
<div class="container py-5">
    {{-- Highlight Banner --}}
    <div class="alert alert-danger text-center fw-bold fs-5 shadow">
        🚨 Butuh bantuan segera? Hubungi <span class="text-warning glow-header">119</span> untuk layanan medis darurat!
    </div>

    {{-- Card Kontak --}}
    <div class="card card-custom text-light rounded-4">
        <div class="card-header text-center text-warning fs-4 fw-bold glow-header">
            <i class="fa-solid fa-triangle-exclamation"></i> Kontak Darurat Yogyakarta
        </div>
        <div class="card-body">
            <p class="text-center text-muted mb-4" style="font-size: 0.95rem;">
                Hubungi instansi berikut jika mengalami atau melihat tindakan kekerasan.
            </p>

            <div class="table-responsive">
                <table class="table table-dark table-bordered text-center align-middle">
                    <thead class="text-info">
                        <tr>
                            <th>Instansi</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Layanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Dinas Pemberdayaan Perempuan DIY</td>
                            <td><span class="badge badge-custom">0811-2929-911</span></td>
                            <td>-</td>
                            <td>Aduan kekerasan</td>
                        </tr>
                        <tr>
                            <td>UPPA Polda DIY</td>
                            <td><span class="badge badge-custom">0274-520450</span></td>
                            <td>-</td>
                            <td>Pelaporan kepolisian</td>
                        </tr>
                        <tr>
                            <td>LBH APIK Yogyakarta</td>
                            <td><span class="badge badge-custom">0813-9090-7183</span></td>
                            <td><a href="mailto:lbhapik.jogja@gmail.com" class="text-warning">lbhapik.jogja@gmail.com</a></td>
                            <td>Bantuan hukum perempuan & anak</td>
                        </tr>
                        <tr>
                            <td>Yayasan Rifka Annisa</td>
                            <td><span class="badge badge-custom">0811-2637-800</span></td>
                            <td><a href="mailto:info@rifka-annisa.org" class="text-warning">info@rifka-annisa.org</a></td>
                            <td>Konseling & pendampingan</td>
                        </tr>
                        <tr>
                            <td>PSC 119 DIY (Emergency Medis)</td>
                            <td><span class="badge bg-warning text-dark fs-6">119</span></td>
                            <td>-</td>
                            <td>Ambulans & Medis</td>
                        </tr>
                        <tr>
                            <td>SHIELD (Sexual Harm Incident & Emergency Location Dashboard)</td>
                            <td><span class="badge badge-custom">0813-5615-3089</span></td>
                            <td><a href="mailto:galuhrabbany@gmail.com" class="text-warning">galuhrabbany@gmail.com</a></td>
                            <td>WebGIS Aduan Kekerasan</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="alert alert-warning mt-4 text-center shadow-sm">
                <strong>Catatan:</strong> Semua layanan bersifat <u>rahasia</u> dan <u>aman</u>. Dokumentasikan kejadian jika memungkinkan dan segera cari tempat aman.
            </div>
            <div class="text-center mt-3">
                <a href="/map" class="btn btn-outline-warning btn-sm rounded-pill">
                    <i class="fa-solid fa-map-location-dot"></i> Laporkan Kasus Anda di SHIELD
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
