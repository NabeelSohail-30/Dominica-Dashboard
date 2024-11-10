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
            'sub_title' => 'nullable|string|max:255',
            'push_welcome_title' => 'nullable|string|max:255',
            'push_body' => 'nullable|string',
            'description' => 'required|string',
            'description_2' => 'nullable|string',
            'description_sp' => 'nullable|string',
            'description_fr' => 'nullable|string',
            'background_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048', // max 2MB
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'whatsappNum' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'gallery_images' => 'nullable|boolean',
            'booking_url' => 'nullable|url',
        ]);

        // Handle background image upload if provided
        $backgroundImagePath = $request->hasFile('background_image')
            ? $request->file('background_image')->store('images', 'public')
            : null;

        // Create a new Details entry in the database
        Details::create([
            'menu_list_id' => null,
            'menu_type' => null,
            'title' => $validatedData['title'],
            'sub_title' => $validatedData['sub_title'] ?? null,
            'push_welcome_title' => $validatedData['push_welcome_title'] ?? null,
            'push_body' => $validatedData['push_body'] ?? null,
            'description' => $validatedData['description'],
            'description_2' => $validatedData['description_2'] ?? null,
            'description_sp' => $validatedData['description_sp'] ?? null,
            'description_fr' => $validatedData['description_fr'] ?? null,
            'flag_image_id' => null,
            'flag' => null,
            'latitude' => $validatedData['latitude'] ?? null,
            'longitude' => $validatedData['longitude'] ?? null,
            'location' => $validatedData['location'] ?? null,
            'bg_image' => $backgroundImagePath, // Assign background image path
            'image' => null,
            'bg_image_id' => null,
            'year' => null,
            'date' => null,
            'day' => null,
            'timing' => null,
            'email' => $validatedData['email'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'whatsappNum' => $validatedData['whatsappNum'] ?? null,
            'website' => null,
            'video' => null,
            'badge' => null,
            'geo_fencing' => $validatedData['gallery_images'] ?? false,
            'achievement_ids' => null,
            'gallery_status' => $validatedData['gallery_images'] ?? false,
            'nearby' => null,
            'status' => null,
            'booking_url' => $validatedData['booking_url'] ?? null,
            'registration_link' => null,
            'is_featured' => false,
            'featured_banner' => $backgroundImagePath,
            'has_trail' => false,
            'has_360' => false,
        ]);

        // Redirect to a success page with a success message
        return redirect()->route('featured_location.index')->with('success', 'Location has been saved successfully.');
    }

}
