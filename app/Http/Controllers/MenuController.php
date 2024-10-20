<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Check if the 'search' query parameter is present
        $searchTerm = $request->input("search", ""); // Default to empty string if not present

        // Get sorting parameters from the request (default to 'title' and 'asc')
        $sort = $request->input("sort", "title"); // Default sort by 'title'
        $order = $request->input("order", "asc"); // Default to ascending order

        // Get the number of rows to display per page (default to 10)
        $perPage = $request->input("per_page", 10);

        // Fetch the menus based on the search keyword and sort them with pagination
        $menus = Menus::where("title", "LIKE", "%{$searchTerm}%")
            ->orderBy($sort, $order) // Apply sorting
            ->paginate($perPage); // Paginate with the selected per_page

        // Retain the sorting and search parameters in the pagination links
        $menus->appends([
            "search" => $searchTerm,
            "sort" => $sort,
            "order" => $order,
            "per_page" => $perPage,
        ]);

        // Return the view with the menus data
        return view(
            "dashboard",
            compact("menus", "searchTerm", "sort", "order", "perPage")
        );
    }

    public function search(Request $request)
    {
        // Get the search keyword
        $searchTerm = $request->input("search", "");

        // Fetch the menus based on the search keyword with pagination (10 per page)
        $menus = Menus::where("title", "LIKE", "%{$searchTerm}%")->paginate(10); // Paginate 10 items per page

        // Return the partial view with filtered menus and pagination
        return view("partials.menu_table", compact("menus"))->render();
    }

    public function edit($id)
    {
        // Decode the menu ID
        $menuId = base64_decode($id);

        // Find the menu item by ID
        $menu = Menus::findOrFail($menuId);

        // Return the edit view with the menu data
        return view("edit_menu", compact("menu"));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            "title" => "required|string|max:255",
            "title_sp" => "nullable|string|max:255",
            "title_fr" => "nullable|string|max:255",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "bg_image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        // Decode the menu ID
        $menuId = base64_decode($id);

        // Find the menu item by ID
        $menu = Menus::findOrFail($menuId);

        // Handle the main image upload
        if ($request->hasFile("image")) {
            // Delete the old image if it exists
            if ($menu->image && file_exists(public_path($menu->image))) {
                unlink(public_path($menu->image));
            }

            // Store the new image in the 'uploads/images' directory
            $imageName = time() . "." . $request->image->extension();
            $request->image->move(public_path("uploads/images"), $imageName);
            $menu->image = "uploads/images/" . $imageName; // Save the path in the database
        }

        // Handle the background image upload
        if ($request->hasFile("bg_image")) {
            // Delete the old background image if it exists
            if ($menu->bg_image && file_exists(public_path($menu->bg_image))) {
                unlink(public_path($menu->bg_image));
            }

            // Store the new background image in the 'uploads/bg_images' directory
            $bgImageName = time() . "bg." . $request->bg_image->extension();
            $request->bg_image->move(
                public_path("uploads/bg_images"),
                $bgImageName
            );
            $menu->bg_image = "uploads/bg_images/" . $bgImageName; // Save the path in the database
        }

        // Update the other fields
        $menu->title = $request->input("title");
        $menu->title_sp = $request->input("title_sp");
        $menu->title_fr = $request->input("title_fr");
        $menu->save(); // Save the changes

        // Redirect to the dashboard with a success message
        return redirect()
            ->route("dashboard")
            ->with("success", "Menu updated successfully.");
    }
}
