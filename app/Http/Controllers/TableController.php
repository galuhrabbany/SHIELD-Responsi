<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use App\Models\PolygonsModel;
use App\Models\PolylinesModel;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Laporan',
            'points' => $this->points->all(),
        ];

        return view('table', $data);
    }
}
