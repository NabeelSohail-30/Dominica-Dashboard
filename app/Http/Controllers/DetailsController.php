<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Details;
use Illuminate\Support\Facades\Log;

class DetailsController extends Controller
{
    public function index($id)
    {
        // Retrieve listings with the given menu_id
        $details = Details::where('menu_list_id', $id)->get();

        // Return the view with the retrieved listings
        return view('details.index', compact('details'), compact('id'));
    }

    public function create($id)
    {
        Log::info('Create method called with id: ' . $id);
        return view('details.create', compact('id'));
    }

    public function store(Request $request, $id)
    {
        try {
            Log::info('store method called with id: ' . $id);
            Log::info('Request data: ' . json_encode($request->all()));

            // Validate input data
            $request->validate([
                'title' => 'required|string|max:255',
                'sub_title' => 'required|string|max:255',
                'push_welcome_title' => 'required|string|max:255',
                'push_body' => 'required|string',
                'description' => 'required|string',
                'description_sp' => 'required|string',
                'description_fr' => 'required|string',
                'flag' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'bg_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'radius' => 'required|numeric',
                'location' => 'required|string|max:255',
                'year' => 'required|integer',
                'date' => 'required|date',
                'day' => 'required|string|max:50',
                'timing' => 'required|string|max:100',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:15',
                'whatsappNum' => 'required|string|max:15',
                'website' => 'required|url|max:255',
                'video' => 'required|file|mimes:mp4,avi,mov|max:10240',
                'geo_fencing' => 'required|in:1,0',
                'gallery_status' => 'required|in:1,0',
                'vgallery_status' => 'required|in:1,0',
                'has_trail' => 'required|in:1,0',
                'has_360' => 'required|in:1,0',
                'booking_url' => 'required|url|max:255',
                'registration_link' => 'required|url|max:255',
            ]);

            // Generate paths and move uploaded files
            $flagPath = 'uploads/images/flag_' . time() . '.' . $request->file('flag')->getClientOriginalExtension();
            $request->file('flag')->move(public_path('uploads/images'), basename($flagPath));

            $imagePath = 'uploads/images/image_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/images'), basename($imagePath));

            $bgImagePath = 'uploads/bg_images/bg_image_' . time() . '.' . $request->file('bg_image')->getClientOriginalExtension();
            $request->file('bg_image')->move(public_path('uploads/bg_images'), basename($bgImagePath));

            $videoPath = 'uploads/videos/video_' . time() . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move(public_path('uploads/videos'), basename($videoPath));

            // Create new Details record
            Details::create([
                'menu_list_id' => $id,
                'menu_type' => 0,
                'title' => $request['title'],
                'sub_title' => $request['sub_title'],
                'push_welcome_title' => $request['push_welcome_title'],
                'push_body' => $request['push_body'],
                'description' => $request['description'],
                'description_2' => $request['description_2'],
                'description_sp' => $request['description_sp'],
                'description_fr' => $request['description_fr'],
                'flag_image_id' => $flagPath,
                'flag' => $flagPath,
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
                'radius' => $request['radius'],
                'location' => $request['location'],
                'image_id' => $imagePath,
                'image' => $imagePath,
                'bg_image' => $bgImagePath, // Assign background image path
                'bg_image_id' => $bgImagePath,
                'year' => $request['year'],
                'date' => $request['date'],
                'day' => $request['day'],
                'timing' => $request['timing'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'whatsappNum' => $request['whatsappNum'],
                'website' => $request['website'],
                'video' => $videoPath,
                'badge' => null,
                'geo_fencing' => $request['geo_fencing'],
                'achievement_ids' => null,
                'gallery_status' => $request['gallery_status'],
                'nearby' => null,
                'status' => "1",
                'vgallery_status' => $request['vgallery_status'],
                'booking_url' => $request['booking_url'],
                'registration_link' => $request['registration_link'],
                'is_featured' => "0",
                'featured_banner' => null,
                'has_trail' => $request['has_trail'],
                'has_360' => $request['has_360'],
            ]);

            // Redirect with success message
            return redirect()->route('dashboard')->with('success', 'Details added successfully!');
        } catch (\Exception $e) {
            // Log the exception
            Log::error('An error occurred in the store method: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with error message
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing your request. Please try again later.']);
        }
    }

    public function show($id)
    {
        // Fetch the details from the database using the given ID
        $details = Details::findOrFail($id);

        // Pass the data to the view
        return view('details.view', compact('details'));
    }

    public function edit($id)
    {
        $details = Details::findOrFail($id);
        return view('details.edit', compact('details'));
    }

    public function update(Request $request, $id)
    {
        try {
            Log::info('update method called with id: ' . $id);
            Log::info('Request data: ' . json_encode($request->all()));

            // Validate input data
            $request->validate([
                'title' => 'required|string|max:255',
                'sub_title' => 'required|string|max:255',
                'push_welcome_title' => 'required|string|max:255',
                'push_body' => 'required|string',
                'description' => 'required|string',
                'description_sp' => 'required|string',
                'description_fr' => 'required|string',
                'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'bg_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'radius' => 'required|numeric',
                'location' => 'required|string|max:255',
                'year' => 'required|integer',
                'date' => 'required|date',
                'day' => 'required|string|max:50',
                'timing' => 'required|string|max:100',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:15',
                'whatsappNum' => 'required|string|max:15',
                'website' => 'required|url|max:255',
                'video' => 'nullable|file|mimes:mp4,avi,mov|max:10240',
                'geo_fencing' => 'required|in:1,0',
                'gallery_status' => 'required|in:1,0',
                'vgallery_status' => 'required|in:1,0',
                'has_trail' => 'required|in:1,0',
                'has_360' => 'required|in:1,0',
                'booking_url' => 'required|url|max:255',
                'registration_link' => 'required|url|max:255',
            ]);

            // Find the existing record
            $details = Details::findOrFail($id);

            // Update file paths only if new files are uploaded
            if ($request->hasFile('flag')) {
                $flagPath = 'uploads/images/flag_' . time() . '.' . $request->file('flag')->getClientOriginalExtension();
                $request->file('flag')->move(public_path('uploads/images'), basename($flagPath));
                $details->flag = $flagPath;
            }

            if ($request->hasFile('image')) {
                $imagePath = 'uploads/images/image_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('uploads/images'), basename($imagePath));
                $details->image = $imagePath;
            }

            if ($request->hasFile('bg_image')) {
                $bgImagePath = 'uploads/bg_images/bg_image_' . time() . '.' . $request->file('bg_image')->getClientOriginalExtension();
                $request->file('bg_image')->move(public_path('uploads/bg_images'), basename($bgImagePath));
                $details->bg_image = $bgImagePath;
            }

            if ($request->hasFile('video')) {
                $videoPath = 'uploads/videos/video_' . time() . '.' . $request->file('video')->getClientOriginalExtension();
                $request->file('video')->move(public_path('uploads/videos'), basename($videoPath));
                $details->video = $videoPath;
            }

            // Update record fields
            $details->update([
                'title' => $request['title'],
                'sub_title' => $request['sub_title'],
                'push_welcome_title' => $request['push_welcome_title'],
                'push_body' => $request['push_body'],
                'description' => $request['description'],
                'description_sp' => $request['description_sp'],
                'description_fr' => $request['description_fr'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
                'radius' => $request['radius'],
                'location' => $request['location'],
                'year' => $request['year'],
                'date' => $request['date'],
                'day' => $request['day'],
                'timing' => $request['timing'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'whatsappNum' => $request['whatsappNum'],
                'website' => $request['website'],
                'geo_fencing' => $request['geo_fencing'],
                'gallery_status' => $request['gallery_status'],
                'vgallery_status' => $request['vgallery_status'],
                'booking_url' => $request['booking_url'],
                'registration_link' => $request['registration_link'],
                'has_trail' => $request['has_trail'],
                'has_360' => $request['has_360'],
            ]);

            // Redirect with success message
            return redirect()->route('dashboard')->with('success', 'Details updated successfully!');
        } catch (\Exception $e) {
            // Log the exception
            Log::error('An error occurred in the update method: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with error message
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing your request. Please try again later.']);
        }
    }

}
