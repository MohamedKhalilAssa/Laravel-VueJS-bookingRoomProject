<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Listing::latest()->filter(request(['search']))->paginate(6)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $formElements = $request->validate([
                "title" => 'required|string|max:255',
                "address" => 'required',
                "description" => 'required',
                'image' => 'image|mimes:jpeg,png,pdf|max:2048',
            ]);

            if($request->hasFile('image')){
                $path = $request->file('image')->store('images','public');
                $formElements['image'] = json_encode($path);
            }

            // validating amneties
            if($request->amenities){
                foreach($request->amenities as $amenity){
                    $formElements[$amenity] = true;
                }
            }

            Listing::create($formElements);

            return "done";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Listing::find($id)->toJson();
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
