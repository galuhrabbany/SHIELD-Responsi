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
                'geom_polyline' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg|max:2000'
            ],
            [
                'name.required' => 'Name is required.',
                'name.unique' => 'Name already exists.',
                'description.required' => 'Description is required.',
                'geom_polyline.required' => 'Geometry Polyline is required.',
            ]
        );

        // Create Images Directory If Not Exists
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Get Image Files
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
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
        $data = [
            'title' => 'Edit Polyline',
            'id'=> $id,
        ];
        return view('edit-polyline', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($id, $request->all());
        //Validate Request
        $request->validate(
            [
                'name' => 'required|unique:polylines,name,' . $id,
                'description' => 'required',
                'geom_polyline' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg|max:2000'
            ],
            [
                'name.required' => 'Name is required.',
                'name.unique' => 'Name already exists.',
                'description.required' => 'Description is required.',
                'geom_polyline.required' => 'Geometry polyline is required.',
            ]
        );

        // Create Images Directory If Not Exists
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Get Old Image File Name
        $old_image = $this->polylines->find($id)->image;

        // Get Image Files
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);

            //Delete Old Image File
            if($old_image != null) {
                if(file_exists('./storage/images/' . $old_image)){
                    unlink('./storage/images/' . $old_image);
                }
            }
        } else {
            $name_image = $old_image;
        }

        $data = [
            'geom' => $request->geom_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];

        // Update Data
        if (!$this->polylines->find($id)->update($data)) {
            return redirect()->route('map')->with('error', 'Failed to update polyline.');
        }

        // Rediret to Map
        return redirect()->route('map')->with('success', 'Polyline has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->polylines->find($id)->image;

        if (!$this->polylines->destroy($id)) {
            return redirect()->route('map')->with('error', 'Line failed to delete.');
        }

        // Delete Image File
        if ($imagefile != null) {
            if (file_exists('./storage/images/' . $imagefile)) {
                unlink('./storage/images/' . $imagefile);
            }
        }
        return redirect()->route('map')->with('success', 'Line has been deleted.');
    }
}
