<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
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
            'image.*' => 'image|mimes:jpeg,png,pdf|max:2048',
        ]);

        $paths = [];
        if ($request->file('image')) {
            foreach ($request->file('image') as $image) {
                $path = 'http://localhost:8000/storage/' . $image->store('images', 'public');
                $paths[] = $path;
            }
            $formElements['image'] = json_encode($paths);
        }
        // validating amneties
        if ($request->amenities) {
            foreach ($request->amenities as $amenity) {
                $formElements[$amenity] = true;
            }
        }

        $formElements['user_id'] = auth()->user()->id;

        Listing::create($formElements);

        return "Listing Created Successfully" . auth()->user()->id;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Listing::find($id)->toJson();
    }

    // get by User
    public function getByUser($id)
    {
        return User::find($id)->listings()->orderBy('created_at', 'desc')->get()->toJson();
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
    public function destroy($id)
    {
        $listing = Listing::find($id);

        if ($listing->user_id == auth()->user()->id) {
            $listing->delete();
            return "Listing Deleted Successfully";
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
