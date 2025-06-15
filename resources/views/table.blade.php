@extends('layout.template')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <i class="bi bi-geo-alt-fill me-2"></i> TITIK LAPORAN KASUS
            </div>
            <div class="card-body">
                <div id="loadingText" style="text-align:center; color:#ff3c3c; padding: 1rem;">
                    <i class="bi bi-hourglass-split me-1"></i> Memuat data...
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="pointsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>PELAPOR</th>
                                <th>DESKRIPSI KEJADIAN</th>
                                <th>BUKTI</th>
                                <th>DIBUAT</th>
                                <th>DIPERBARUI</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($points as $p)
                                <tr @if ($loop->first) class="highlight-row" @endif>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td title="{{ $p->description }}">
                                        {{ Str::limit($p->description, 30) }}
                                        <span class="badge status-badge">Baru</span>
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $p->image) }}" alt="Gambar"
                                            class="img-thumbnail">
                                    </td>
                                    <td>
                                        <i
                                            class="bi bi-clock-history me-1"></i>{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y H:i') }}
                                    </td>
                                    <td>
                                        <i
                                            class="bi bi-pencil-square me-1"></i>{{ \Carbon\Carbon::parse($p->updated_at)->format('d M Y H:i') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('points.edit', $p->id) }}"
                                            class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('points.destroy', $p->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
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
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #0c0c0c;
            color: #f2f2f2;
            font-family: 'Orbitron', sans-serif;
        }

        .card {
            background-color: #121212;
            border: 1px solid rgba(255, 60, 60, 0.31);
            border-radius: 16px;
            box-shadow: 0 0 10px rgba(255, 60, 60, 0.125);
        }

        .card:hover {
            transform: scale(1.01);
            box-shadow: 0 0 15px #ff3c3c55;
            transition: 0.3s ease;
        }


        .card-header {
            background: linear-gradient(90deg, #ff3c3c, #ff0000);
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 16px 16px 0 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 0 0 8px #ff0000;
        }

        .btn-outline-info,
        .btn-outline-warning,
        .btn-outline-danger {
            border-color: rgba(255, 60, 60, 0.47);
            color: #ffaaaa;
            font-size: 0.75rem;
            padding: 4px 6px;
            transition: 0.2s;
        }

        .btn-outline-info:hover {
            background-color: #3cf;
            color: #000;
        }

        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: #000;
        }

        .btn-outline-danger:hover {
            background-color: #ff3c3c;
            color: #fff;
        }

        /* DataTable Styling */
        table.dataTable {
            background-color: #1a1a1a;
            color: #f5f5f5;
            border-radius: 12px;
            overflow: hidden;
        }

        table.dataTable thead {
            background-color: #2b0000;
            color: #ff5a5a;
            font-size: 0.9rem;
            border-bottom: 2px solid #ff3c3c;
        }

        table.dataTable tbody td {
            background-color: #151515;
            color: #ff3c3c;
        }

        table.dataTable tbody tr:hover {
            background-color: #300000 !important;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .highlight-row {
            animation: flashRow 2s ease-in-out;
            background-color: #440000 !important;
        }

        @keyframes flashRow {
            0% {
                background-color: #300000;
            }

            50% {
                background-color: #440000;
            }

            100% {
                background-color: #300000;
            }
        }

        /* Thumbnail images */
        .img-thumbnail {
            border: 1px solid rgba(255, 60, 60, 0.44);
            background-color: #222;
            max-width: 90px;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .img-thumbnail:hover {
            transform: scale(1.1);
            border-color: #ff3c3c;
        }

        /* DataTables extras */
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            background-color: #1a1a1a;
            border: 1px solid rgba(255, 60, 60, 0.47);
            color: #fff;
            border-radius: 6px;
            padding: 4px 8px;
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: #ccc;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background-color: #1f1f1f;
            border: 1px solid rgba(255, 60, 60, 0.47);
            color: #ffaaaa !important;
            margin: 0 4px;
            border-radius: 4px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #ff3c3c;
            color: #fff !important;
        }

        #pointsTable {
            display: none;
        }

        .status-badge {
            background: #ff3c3c;
            color: #fff;
            font-size: 0.75rem;
            padding: 2px 6px;
            border-radius: 6px;
            margin-left: 6px;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            const table = new DataTable('#pointsTable');
            setTimeout(() => {
                $('#loadingText').fadeOut();
                $('#pointsTable').fadeIn();
            }, 1000);
        });
    </script>
@endsection
