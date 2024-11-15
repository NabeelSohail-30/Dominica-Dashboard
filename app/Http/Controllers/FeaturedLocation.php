<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Details;

class FeaturedLocation extends Controller
{
    public function index(Request $request)
    {
        // Get the number of entries per page and search query
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search', '');

        // Filter data based on search query and paginate
        $featuredDetails = Details::where('is_featured', '1')
            ->where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->where('title', 'like', '%' . $search . '%');
                }
            })
            ->paginate($perPage);

        // Check if AJAX request and return only table content for smooth updating
        if ($request->ajax()) {
            return view('partials.featured_table', compact('featuredDetails'))->render();
        }

        return view('featured_location.index', compact('featuredDetails'));
    }

    public function create(Request $request)
    {
        return view('featured_location.create');
    }

    public function store(Request $request)
    {
        // Validate the required fields and file input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'push_welcome_title' => 'required|string|max:255',
            'push_body' => 'required|string',
            'description' => 'required|string',
            'description_2' => 'required|string',
            'description_sp' => 'required|string',
            'description_fr' => 'required|string',
            'background_image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048', // max 2MB
            'email' => 'required|email',
            'phone' => 'required|string',
            'whatsappNum' => 'required|string',
            'website' => 'required|string',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'gallery_status' => 'required|in:1,0', // Ensure alignment with form select
            'vgallery_status' => 'required|in:1,0',
            'booking_url' => 'required|url',
        ]);

        $backgroundImagePath = 'uploads/bg_images/bg_image' . time() . '.' . $request->file('background_image')->getClientOriginalExtension();
        $request->file('background_image')->move(public_path('uploads/bg_images'), basename($backgroundImagePath));

        // Create a new Details entry in the database
        Details::create([
            'menu_list_id' => 0,
            'menu_type' => 0,
            'title' => $validatedData['title'],
            'sub_title' => $validatedData['sub_title'],
            'push_welcome_title' => $validatedData['push_welcome_title'],
            'push_body' => $validatedData['push_body'],
            'description' => $validatedData['description'],
            'description_2' => $validatedData['description_2'],
            'description_sp' => $validatedData['description_sp'],
            'description_fr' => $validatedData['description_fr'],
            'flag_image_id' => $backgroundImagePath,
            'flag' => $backgroundImagePath,
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
            'radius' => 25,
            'location' => $validatedData['location'],
            'image_id' => $backgroundImagePath,
            'image' => $backgroundImagePath,
            'bg_image' => $backgroundImagePath, // Assign background image path
            'bg_image_id' => $backgroundImagePath,
            'year' => '',
            'date' => '',
            'day' => '',
            'timing' => '',
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'whatsappNum' => $validatedData['whatsappNum'],
            'website' => $validatedData['website'],
            'video' => '',
            'badge' => null,
            'geo_fencing' => "0",
            'achievement_ids' => null,
            'gallery_status' => $validatedData['gallery_status'],
            'nearby' => null,
            'status' => "1",
            'vgallery_status' => $validatedData['vgallery_status'],
            'booking_url' => $validatedData['booking_url'],
            'registration_link' => null,
            'is_featured' => "1",
            'featured_banner' => $backgroundImagePath,
            'has_trail' => null,
            'has_360' => null,
        ]);

        // Redirect to a success page with a success message
        return redirect()->route('featured_location.index')->with('success', 'Location has been saved successfully.');
    }

    public function destroy($id)
    {
        // Find the record by ID
        $record = Details::find($id);

        if ($record) {
            $record->delete();
            return redirect()->back()->with('success', 'Record deleted successfully.');
        }

        return redirect()->back()->with('error', 'Record not found.');
    }

    public function edit($id)
    {
        $location = Details::findOrFail($id);
        return view('featured_location.edit', compact('location'));
    }

    public function update(Request $request, $id)
    {
        // Validate the required fields and file input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'push_welcome_title' => 'required|string|max:255',
            'push_body' => 'required|string',
            'description' => 'required|string',
            'description_2' => 'required|string',
            'description_sp' => 'required|string',
            'description_fr' => 'required|string',
            'background_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048', // max 2MB, optional for updates
            'email' => 'required|email',
            'phone' => 'required|string',
            'whatsappNum' => 'required|string',
            'website' => 'required|string',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'gallery_status' => 'required|in:1,0',
            'vgallery_status' => 'required|in:1,0',
            'booking_url' => 'required|url',
        ]);

        // Retrieve the existing Details record
        $details = Details::findOrFail($id);

        // Handle background image upload if provided
        if ($request->hasFile('background_image')) {
            // Delete the old background image if exists
            if ($details->bg_image && file_exists(public_path($details->bg_image))) {
                unlink(public_path($details->bg_image));
            }

            // Save the new background image
            $backgroundImagePath = 'uploads/bg_images/bg_image' . time() . '.' . $request->file('background_image')->getClientOriginalExtension();
            $request->file('background_image')->move(public_path('uploads/bg_images'), basename($backgroundImagePath));
            $details->bg_image = $backgroundImagePath;
            $details->bg_image_id = $backgroundImagePath;
        }

        // Update the fields in the database
        $details->update([
            'title' => $validatedData['title'],
            'sub_title' => $validatedData['sub_title'],
            'push_welcome_title' => $validatedData['push_welcome_title'],
            'push_body' => $validatedData['push_body'],
            'description' => $validatedData['description'],
            'description_2' => $validatedData['description_2'],
            'description_sp' => $validatedData['description_sp'],
            'description_fr' => $validatedData['description_fr'],
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
            'location' => $validatedData['location'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'whatsappNum' => $validatedData['whatsappNum'],
            'website' => $validatedData['website'],
            'gallery_status' => $validatedData['gallery_status'],
            'vgallery_status' => $validatedData['vgallery_status'],
            'booking_url' => $validatedData['booking_url'],
            'image_id' => $backgroundImagePath,
            'image' => $backgroundImagePath,
            'bg_image' => $backgroundImagePath, // Assign background image path
            'bg_image_id' => $backgroundImagePath,
            'featured_banner' => $backgroundImagePath,
        ]);

        // Redirect to a success page with a success message
        return redirect()->route('featured_location.index')->with('success', 'Location has been updated successfully.');
    }
}
