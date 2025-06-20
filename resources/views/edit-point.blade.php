@extends('layout.template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        body {
            background-color: #121212;
            color: #eee;
            font-family: 'Segoe UI', sans-serif;
        }

        h1, h2, h3, h4 {
            font-family: 'Orbitron', sans-serif;
            color: #ff2e2e;
        }

        .shield-header {
            background: linear-gradient(90deg, #8b0000, #330000);
            color: #fff;
            padding: 1rem 2rem;
            border-bottom: 3px solid #ff2e2e;
            box-shadow: 0 4px 15px rgba(255, 46, 46, 0.6);
        }

        #map {
            height: 60vh;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 0 15px #ff2e2e;
        }

        .card-custom {
            background-color: #220000;
            border: 1px solid #660000;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 0 12px rgba(255, 46, 46, 0.5);
            color: #fff;
        }

        .modal-content {
            background: rgba(40, 0, 0, 0.95);
            border: 1px solid #660000;
            border-radius: 1rem;
            color: #fff;
            backdrop-filter: blur(8px);
        }

        .form-control {
            background-color: rgba(80, 0, 0, 0.8);
            border: 1px solid #aa2222;
            color: #fff;
        }

        .btn-primary {
            background-color: #ff2e2e;
            border-color: #ff2e2e;
            box-shadow: 0 0 10px #ff2e2e;
        }

        .img-thumbnail {
            background-color: #330000;
            border: 1px solid #aa2222;
        }

        .btn-close {
            filter: invert(1);
        }

        ul {
            padding-left: 1rem;
        }
    </style>
@endsection

@section('content')
    <div class="shield-header text-center">
        <h1><i class="fa-solid fa-shield-halved me-2"></i>SHIELD Dashboard</h1>
        <p>Sexual Harm Incident & Emergency Location Dashboard</p>
    </div>

    <div class="container my-4">
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
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editPointModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa-solid fa-pen me-2"></i>Edit Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('points.update', $id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Pelapor</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kontak Pelapor</label>
                                <input type="text" id="kontak" name="kontak" class="form-control">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Deskripsi Kejadian</label>
                                <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Koordinat Titik</label>
                                <textarea id="geom_point" name="geom_point" class="form-control" readonly rows="2"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Foto Bukti</label>
                                <input type="file" id="image" name="image" class="form-control"
                                    onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                                <img id="preview-image-point" class="img-thumbnail mt-2" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-paper-plane me-2"></i>Update Laporan
                        </button>
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

        var redIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/7058/7058249.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
            iconSize: [38, 38],
            iconAnchor: [19, 38],
            popupAnchor: [0, -38]
        });

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                polyline: false,
                polygon: false,
                rectangle: false,
                circle: false,
                marker: false,
                circlemarker: false
            },
            edit: {
                featureGroup: drawnItems,
                edit: true,
                remove: false
            }
        });

        map.addControl(drawControl);

        map.on('draw:edited', function (e) {
            var layers = e.layers;
            layers.eachLayer(function (layer) {
                var geojson = layer.toGeoJSON();
                var wkt = Terraformer.geojsonToWKT(geojson.geometry);
                var props = geojson.properties ?? {};

                $('#geom_point').val(wkt);
                $('#name').val(props.name || '');
                $('#kontak').val(props.kontak || '');
                $('#description').val(props.description || '');
                $('#preview-image-point').attr('src', "{{ asset('storage/images') }}/" + (props.image || ''));

                $('#editPointModal').modal('show');
            });
        });

        var pointLayer = L.geoJson(null, {
            pointToLayer: function (feature, latlng) {
                return L.marker(latlng, { icon: redIcon });
            },
            onEachFeature: function (feature, layer) {
                var popup = `
                    <div class="text-light">
                        <h5 class="text-warning">${feature.properties.name}</h5>
                        <p><strong>Deskripsi:</strong> ${feature.properties.description}</p>
                        <p><strong>Kontak:</strong> ${feature.properties.kontak}</p>
                    </div>
                `;
                layer.on({
                    click: () => layer.bindPopup(popup).openPopup(),
                    mouseover: () => layer.bindTooltip(feature.properties.name).openTooltip()
                });
                drawnItems.addLayer(layer);
            }
        });

        $.getJSON("{{ route('api.point', $id) }}", function (data) {
            pointLayer.addData(data);
            map.addLayer(pointLayer);
            map.fitBounds(pointLayer.getBounds(), { padding: [100, 100] });
        });
    </script>
@endsection
