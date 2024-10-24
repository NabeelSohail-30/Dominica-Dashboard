<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;

class AchivementController extends Controller
{
    public function index(Request $request)
    {
        // Check if the 'search' query parameter is present
        $searchTerm = $request->input("search", ""); // Default to empty string if not present

        // Get sorting parameters from the request (default to 'achievement_title' and 'asc')
        $sort = $request->input("sort", "achievement_title"); // Default sort by 'achievement_title'
        $order = $request->input("order", "asc"); // Default to ascending order

        // Get the number of rows to display per page (default to 10)
        $perPage = $request->input("per_page", 10);

        // Fetch the achievements based on the search keyword and sort them with pagination
        $achievements = Achievement::where("achievement_title", "LIKE", "%{$searchTerm}%")
            ->orWhere("achievement_push_title", "LIKE", "%{$searchTerm}%")
            ->orWhere("achievement_description", "LIKE", "%{$searchTerm}%")
            ->orderBy($sort, $order) // Apply sorting
            ->paginate($perPage); // Paginate with the selected per_page

        // Retain the search, sorting, and per_page parameters in the pagination links
        $achievements->appends([
            "search" => $searchTerm,
            "sort" => $sort,
            "order" => $order,
            "per_page" => $perPage,
        ]);

        // Return the view with the achievements data
        return view('achievements.index', compact("achievements", "searchTerm", "sort", "order", "perPage"));
    }

    public function search(Request $request)
    {
        // Get the search keyword
        $searchTerm = $request->input("search", "");

        // Fetch the achievements based on the search keyword with pagination (10 per page)
        $achievements = Achievement::where("achievement_title", "LIKE", "%{$searchTerm}%")
            ->orWhere("achievement_push_title", "LIKE", "%{$searchTerm}%")
            ->orWhere("achievement_description", "LIKE", "%{$searchTerm}%")
            ->paginate(10); // Paginate 10 items per page

        // Retain the search parameters in the pagination links
        $achievements->appends([
            "search" => $searchTerm,
        ]);

        // Return the partial view with filtered achievements and pagination
        return view("partials.achievement_table", compact("achievements"))->render();
    }

    public function create()
    {
        return view('achievements.create');
    }

    // Store new achievement
    public function store(Request $request)
    {
        try {
            // Validate input
            $validatedData = $request->validate([
                'achievement_title' => 'required|string|max:255',
                'achievement_push_title' => 'required|string|max:255',
                'achievement_how_to_get_here' => 'required|string|max:255',
                'achievement_lat' => 'nullable|numeric',
                'achievement_long' => 'nullable|numeric',
                'radius' => 'nullable|numeric',
                'achievement_description' => 'required|string',
                'achievement_image_color' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation for color
                'achievement_image_bw' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation for B&W
                'manual' => 'nullable|boolean',
                'achievement_status' => 'nullable|boolean',
            ]);

            // Handle file uploads with custom filenames and store in 'uploads/images' folder
            $colorImageName = 'achievement_color_' . time() . '.' . $request->file('achievement_image_color')->getClientOriginalExtension();
            $bwImageName = 'achievement_bw_' . time() . '.' . $request->file('achievement_image_bw')->getClientOriginalExtension();

            // Store the files in the 'uploads/images' folder inside 'public'
            $request->file('achievement_image_color')->move(public_path('uploads/images'), $colorImageName);
            $request->file('achievement_image_bw')->move(public_path('uploads/images'), $bwImageName);

            // Save the correct path format to the database
            Achievement::create([
                'achievement_title' => $validatedData['achievement_title'],
                'achievement_push_title' => $validatedData['achievement_push_title'],
                'achievement_how_to_get_here' => $validatedData['achievement_how_to_get_here'],
                'achievement_lat' => $validatedData['achievement_lat'] ?? '0.0', // Default value
                'achievement_long' => $validatedData['achievement_long'] ?? '0.0', // Default value
                'radius' => $validatedData['radius'] ?? 20, // Default value
                'achievement_description' => $validatedData['achievement_description'],
                'achievement_image_color' => 'uploads/images/' . $colorImageName,
                'achievement_image_bw' => 'uploads/images/' . $bwImageName,
                'manual' => $validatedData['manual'] ?? 1, // Default to 1 (Yes)
                'achievement_status' => $validatedData['achievement_status'] ?? 1, // Default to 1 (Active)
            ]);

            // Redirect with success message
            return redirect()->route('achievements.create')->with('success', 'Achievement created successfully!');

        } catch (\Exception $e) {
            // Redirect back with errors
            return redirect()->route('achievements.create')->withErrors($e->getMessage())->withInput();
        }
    }


    public function destroy($id)
    {
        $achievement = Achievement::find($id);

        if ($achievement) {
            $achievement->delete();
            return response()->json(['status' => 'success', 'message' => 'Achievement deleted successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Achievement not found'], 404);
    }

}
