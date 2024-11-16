<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Log;


class ListingController extends Controller
{
    public function index($id)
    {
        // Retrieve listings with the given menu_id
        $listings = Listing::where('menu_id', $id)->get();

        // Return the view with the retrieved listings
        return view('listings.index', compact('listings'), compact('id'));
    }

    public function create($id)
    {
        return view('listings.create', compact('id'));
    }

    public function store(Request $request, $id)
    {
        try {
            Log::info('Store method called with data: ', $request->all());

            // Validate the request data
            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
                'bg_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            // Define the file paths including the folder structure
            $imagePath = 'uploads/images/image' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $bgImagePath = 'uploads/bg_images/bg_image' . time() . '.' . $request->file('bg_image')->getClientOriginalExtension();

            // Move the files to their respective folders in the 'public' directory
            $request->file('image')->move(public_path('uploads/images'), basename($imagePath));
            $request->file('bg_image')->move(public_path('uploads/bg_images'), basename($bgImagePath));

            // Create a new listing record with default values for certain fields
            Listing::create([
                'menu_id' => $id,
                'menu_type' => 3,
                'title' => $request->title,
                'title_sp' => $request->title, // Same as title
                'title_fr' => $request->title, // Same as title
                'image' => $imagePath,
                'image_id' => $imagePath,
                'bg_image' => $bgImagePath,
                'bg_image_id' => $bgImagePath,
                'website_link' => null,
            ]);

            // Log success message
            Log::info('Listing created successfully for menu_id: ' . $id);

            // Redirect with a success message
            return redirect()->route('dashboard')->with('success', 'Listing created successfully!');
        } catch (\Exception $e) {
            // Log detailed error information
            Log::error('Error occurred while creating listing: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            // Redirect back with an error message
            return redirect()->back()->withInput()->with('error', 'An error occurred while saving the listing. Please try again.');
        }
    }


    public function edit($id)
    {
        $listing = Listing::findOrFail($id);
        return view('listings.edit', compact('listing'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Find the listing by ID
        $listing = Listing::findOrFail($id);

        // Update fields based on request data
        $listing->title = $request->title;
        $listing->title_sp = $request->title;
        $listing->title_fr = $request->title;

        // Update image if a new file is uploaded
        if ($request->hasFile('image')) {
            $imagePath = 'uploads/images/image' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/images'), basename($imagePath));
            $listing->image = $imagePath;
            $listing->image_id = $imagePath;
        }

        // Update background image if a new file is uploaded
        if ($request->hasFile('bg_image')) {
            $bgImagePath = 'uploads/bg_images/bg_image' . time() . '.' . $request->file('bg_image')->getClientOriginalExtension();
            $request->file('bg_image')->move(public_path('uploads/bg_images'), basename($bgImagePath));
            $listing->bg_image = $bgImagePath;
            $listing->bg_image_id = $bgImagePath;
        }

        // Save the updated listing
        $listing->save();

        // Redirect with a success message
        return redirect()->route('dashboard')->with('success', 'Listing updated successfully!');
    }

    public function deactivate(Request $request, $id)
    {
        // Find the listing by ID
        $listing = Listing::findOrFail($id);

        // Update fields based on request data
        $listing->status = '0';

        // Save the updated listing
        $listing->save();

        // Redirect with a success message
        return redirect()->route('dashboard')->with('success', 'Listing Deactivated successfully!');
    }
}
