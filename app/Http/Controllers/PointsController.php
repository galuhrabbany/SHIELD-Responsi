<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestReports = $this->points->with('location')->orderBy('created_at', 'desc')->take(5)->get();
        $totalReports = $this->points->count();
        $todayReports = $this->points->whereDate('created_at', now()->toDateString())->count();
        $distinctLocations = $this->points->distinct('geom')->count();


        $data = [
            'title' => 'SHIELD MAP',
            'latestReports' => $latestReports,
            'totalReports' => $totalReports,
            'todayReports' => $todayReports,
            'distinctLocations' => $distinctLocations,
        ];

        return view('map', $data);
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
        // Validate Request
        $request->validate(
            [
                'name' => 'required|unique:points,name',
                'description' => 'required',
                'geom_point' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg|max:2000',
                'kontak' => 'nullable|string|max:255'
            ],
            [
                'name.required' => 'Name is required.',
                'name.unique' => 'Name already exists.',
                'description.required' => 'Description is required.',
                'geom_point.required' => 'Geometry Point is required.',
            ]
        );

        // Create Images Directory If Not Exists
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Get Image Files
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_point,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
            'kontak' => $request->kontak,
            'user_id' => auth()->user()->id,
        ];

        // Create Data
        if (!$this->points->create($data)) {
            return redirect()->route('map')->with('error', 'Failed to add a point.');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Point has been added.');
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
        $data = [
            'title' => 'Edit Point',
            'id' => $id,
        ];
        return view('edit-point', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate Request
        $request->validate(
            [
                'name' => 'required|unique:points,name,' . $id,
                'description' => 'required',
                'geom_point' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg|max:2000',
                'kontak' => 'nullable|string|max:255'
            ],
            [
                'name.required' => 'Name is required.',
                'name.unique' => 'Name already exists.',
                'description.required' => 'Description is required.',
                'geom_point.required' => 'Geometry Point is required.',
            ]
        );

        // Create Images Directory If Not Exists
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Get Old Image File Name
        $old_image = $this->points->find($id)->image;

        // Get Image Files
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);

            // Delete Old Image File
            if ($old_image != null && file_exists('./storage/images/' . $old_image)) {
                unlink('./storage/images/' . $old_image);
            }
        } else {
            $name_image = $old_image;
        }

        $data = [
            'geom' => $request->geom_point,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
            'kontak' => $request->kontak,
        ];

        // Update Data
        if (!$this->points->find($id)->update($data)) {
            return redirect()->route('map')->with('error', 'Failed to update point.');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Point has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->points->find($id)->image;

        if (!$this->points->destroy($id)) {
            return redirect()->route('map')->with('error', 'Point failed to delete.');
        }

        // Delete Image File
        if ($imagefile != null && file_exists('./storage/images/' . $imagefile)) {
            unlink('./storage/images/' . $imagefile);
        }

        return redirect()->route('map')->with('success', 'Point has been deleted.');
    }
}
