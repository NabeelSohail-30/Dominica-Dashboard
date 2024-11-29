<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    // Display the form with the current About Us details
    public function edit()
    {
        $aboutUs = AboutUs::first(); // Get the first row in the 'about_us' table
        return view('about_us.edit', compact('aboutUs')); // Pass it to the view
    }

    // Update the About Us information
    public function update(Request $request)
    {
        $aboutUs = AboutUs::first(); // Get the first row in the 'about_us' table

        // Validate input
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'about_image' => 'nullable|image|max:2048',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
        ]);

        if ($request->hasFile('about_image')) {
            $file = $request->file('about_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // Log details for debugging
            \Log::info('File uploaded:', [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);

            // Save the file
            $uploadPath = public_path('uploads/images');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);
            $aboutUs->about_image = "uploads/images/$filename"; // Save relative path

            \Log::info('File moved to:', ['path' => $uploadPath . '/' . $filename]);
        }

        // Update the rest of the fields
        $aboutUs->update($request->only(keys: [
            'title',
            'description',
            'facebook_url',
            'instagram_url',
            'twitter_url',
            'youtube_url',
            'linkedin_url'
        ]));

        return redirect()->route('dashboard')->with('success', 'About Us updated successfully.');
    }
}
