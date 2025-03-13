<?php

namespace App\Http\Controllers;

use App\Models\PolylinesModel;
use Illuminate\Http\Request;

class PolylinesController extends Controller
{
    public function __construct()
    {
        $this->polylines = new PolylinesModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate Request
        $request->validate(
            [
                'name' => 'required|unique:polylines,name',
                'description' => 'required',
                'geom_polyline' => 'required'
            ],
            [
                'name.required' => 'Name is required.',
                'name.unique' => 'Name already exists.',
                'description.required' => 'Description is required.',
                'geom_polyline.required' => 'Geometry Polyline is required.',
            ]
        );

        $data = [
            'geom' => $request->geom_polyline,
            'name' => $request->name,
            'description' => $request->description,
        ];

        // Create Data
        if (!$this->polylines->create($data)) {
            return redirect()->route('map')->with('error', 'Line is failed to add.');
        }

        // Rediret to Map
        return redirect()->route('map')->with('success', 'Line has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
