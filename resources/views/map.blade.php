@extends('layout.template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        body {
            background: linear-gradient(135deg, #1a1a1d, #121212);
            color: #e0e0e0;
            font-family: 'Roboto', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, h4 {
            font-family: 'Orbitron', sans-serif;
            color: #ff3366;
        }

        .shield-header {
            background: linear-gradient(90deg, #8b0000, #330000);
            color: #fff;
            padding: 1.5rem 2rem;
            border-bottom: 4px solid #ff3366;
            box-shadow: 0 4px 20px rgba(255, 51, 102, 0.7);
        }

        #map {
            height: 70vh;
            border-radius: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 0 20px #ff3366;
        }

        .card-custom {
            background: rgba(34, 0, 0, 0.85);
            border: 1px solid rgba(255, 51, 102, 0.5);
            border-radius: 1.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 0 15px rgba(255, 51, 102, 0.5);
            color: #fff;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(255, 51, 102, 0.7);
        }

        .modal-content {
            background: rgba(40, 0, 0, 0.95);
            border: 1px solid rgba(255, 51, 102, 0.5);
            border-radius: 1.5rem;
            color: #fff;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease-in-out;
        }

        .form-control {
            background: rgba(80, 0, 0, 0.8);
            border: 1px solid #ff3366;
            color: #fff;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff3366, #ff6699);
            border: none;
            box-shadow: 0 0 15px #ff3366;
            transition: background 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ff6699, #ff3366);
            box-shadow: 0 0 25px #ff6699;
        }

        .img-thumbnail {
            background: rgba(51, 0, 0, 0.85);
            border: 1px solid #ff3366;
            transition: transform 0.3s;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
        }

        .btn-close {
            filter: invert(1);
        }

        ul {
            padding-left: 1.5rem;
        }

        .tooltip {
            background: rgba(255, 51, 102, 0.85);
            color: #fff;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }

        .leaflet-container {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
@endsection

@section('content')
    <div class="shield-header text-center">
        <h1><i class="fa-solid fa-shield-halved me-2"></i>SHIELD MAP</h1>
        <p>Sexual Harm Incident & Emergency Location Dashboard</p>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <div id="map"></div>
            </div>

            <div class="col-lg-4">
                <div class="card-custom">
                    <h4><i class="fa-solid fa-chart-line me-2"></i>Statistik</h4>
                    <ul>
                        <li>Total Laporan: <strong>{{ $totalReports ?? 0 }}</strong></li>
                        <li>Laporan Hari Ini: <strong>{{ $todayReports ?? 0 }}</strong></li>
                        <li>Titik Aktif: <strong>{{ $activePoints ?? 0 }}</strong></li>
                    </ul>
                </div>
                <div class="card-custom">
                    <h4><i class="fa-solid fa-clock me-2"></i>Laporan Terbaru</h4>
                    <ul class="list-unstyled">
                        @forelse($latestReports as $report)
                            <li>
                                🕒 {{ $report->time_ago ?? 'Waktu tidak tersedia' }}
                            </li>
                        @empty
                            <li>Tidak ada laporan terbaru.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="CreatePointModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa-solid fa-pen me-2"></i>Laporkan Titik Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Pelapor</label>
                                <input type="text" name="name" class="form-control" required placeholder="Contoh: Lando Norris">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kontak Pelapor</label>
                                <input type="text" name="kontak" class="form-control" placeholder="Nomor / Email">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Deskripsi Kejadian</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Tuliskan detail kejadian..."></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Koordinat Titik</label>
                                <textarea name="geom_point" id="geom_point" class="form-control" readonly rows="2"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Foto Bukti</label>
                                <input type="file" name="image" class="form-control" onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                                <img id="preview-image-point" class="img-thumbnail mt-2" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane me-2"></i>Kirim Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script src="https://unpkg.com/@terraformer/wkt"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        var map = L.map('map').setView([-7.8167862, 110.4325104], 10);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: false,
                polygon: false,
                rectangle: false,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        var redIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/7058/7058249.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
            iconSize: [38, 38],
            iconAnchor: [19, 38],
            popupAnchor: [0, -38]
        });

        map.on('draw:created', function(e) {
            var layer = e.layer;
            var geometry = Terraformer.geojsonToWKT(layer.toGeoJSON().geometry);
            $('#geom_point').val(geometry);
            $('#CreatePointModal').modal('show');

            var marker = L.marker(layer.getLatLng(), {
                icon: redIcon
            });
            drawnItems.addLayer(marker);
        });

        var point = L.geoJson(null, {
            pointToLayer: function(feature, latlng) {
                return L.marker(latlng, {
                    icon: redIcon
                });
            },
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('points.destroy', ':id') }}".replace(':id', feature.properties.id);
                var routeedit = "{{ route('points.edit', ':id') }}".replace(':id', feature.properties.id);
                var popupContent = `
    <div class="card border-0 shadow-lg" style="width: 18rem; background: linear-gradient(135deg, #1f1f1f, #292b2f); color: #f8f9fa; border-radius: 1rem; overflow: hidden;">
        <div style="position: relative;">
            <img src='{{ asset('/storage/images/') }}/${feature.properties.image}' class="card-img-top" alt="Image" style="height: 10rem; object-fit: cover;">
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(0deg, rgba(0, 0, 0, 0.6), transparent); border-radius: 1rem 1rem 0 0;"></div>
        </div>
        <div class="card-body">
            <h5 class="card-title text-warning text-center mb-2" style="font-family: 'Orbitron', sans-serif; letter-spacing: 0.5px;"><strong>${feature.properties.name}</strong></h5>
            <p class="card-text" style="font-size: 0.85rem; line-height: 1.4; text-align: justify;">
                <strong>Deskripsi:</strong> ${feature.properties.description}<br>
                <strong>Kontak:</strong> ${feature.properties.kontak}<br>
                <strong>Dibuat:</strong> ${new Date(feature.properties.created_at).toLocaleString()}<br>
                <strong>Dibuat oleh:</strong> ${feature.properties.user_created}
            </p>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center p-2" style="background: rgba(40, 40, 40, 0.9);">
            <a href='${routeedit}' class='btn btn-outline-warning btn-sm text-warning' style="font-family: 'Orbitron', sans-serif;">
                <i class='fa-solid fa-pen-to-square'></i> Edit
            </a>
            <form method='POST' action='${routedelete}' class="mb-0">
                @csrf
                @method('DELETE')
                <button type='submit' class='btn btn-outline-danger btn-sm text-danger' style="font-family: 'Orbitron', sans-serif;" onclick='return confirm("Apakah anda setuju untuk menghapus laporan?")'>
                    <i class='fa-solid fa-trash'></i> Hapus
                </button>
            </form>
        </div>
    </div>
`;

                layer.on({
                    click: () => layer.bindPopup(popupContent).openPopup(),
                    mouseover: () => layer.bindTooltip(feature.properties.name).openTooltip()
                });
            }
        });

        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });

        var baseMaps = {
            "OpenStreetMap": L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png')
        };

        var overlayMaps = {
            "Titik Pelapor": point
        };

        L.control.layers(baseMaps, overlayMaps, {
            collapsed: false,
            position: "topright"
        }).addTo(map);
    </script>
@endsection
