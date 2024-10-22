<?php

namespace App\Http\Controllers;

use App\Models\PushNotification;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    // Show all notifications with sorting and pagination
    // public function index(Request $request)
    // {
    //     // Get sorting parameters
    //     $sort = $request->input('sort', 'created_at');
    //     $order = $request->input('order', 'desc');
    //     $perPage = $request->input('per_page', 10);  // Default to 10 if not provided

    //     // Get search query
    //     $search = $request->input('search', '');

    //     // Fetch notifications with search, sorting, and pagination
    //     $query = PushNotification::query();

    //     if ($search) {
    //         $query->where(function ($q) use ($search) {
    //             $q->where('title', 'like', '%' . $search . '%')
    //                 ->orWhere('description', 'like', '%' . $search . '%');
    //         });
    //     }

    //     $notifications = $query->orderBy($sort, $order)->paginate($perPage);  // Use perPage for pagination

    //     // Handle AJAX request
    //     if ($request->ajax()) {
    //         return view('partials.push_notification_table', compact('notifications'))->render();
    //     }

    //     return view('push_notifications.index', compact('notifications', 'sort', 'order', 'perPage', 'search'));
    // }

    public function index(Request $request)
    {
        // Check if the 'search' query parameter is present
        $searchTerm = $request->input('search', ''); // Default to empty string if not present

        // Get sorting parameters from the request (default to 'title' and 'asc')
        $sort = $request->input('sort', 'title'); // Default sort by 'title'
        $order = $request->input('order', 'asc'); // Default to ascending order

        // Get the number of rows to display per page (default to 10)
        $perPage = $request->input('per_page', 10);

        // Fetch the push notifications based on the search keyword and sort them with pagination
        $notifications = PushNotification::where('title', 'LIKE', "%{$searchTerm}%")
            ->orWhere('description', 'LIKE', "%{$searchTerm}%")
            ->orderBy($sort, $order)
            ->paginate($perPage);

        // Retain the sorting and search parameters in the pagination links
        $notifications->appends([
            'search' => $searchTerm,
            'sort' => $sort,
            'order' => $order,
            'per_page' => $perPage,
        ]);

        // Handle AJAX request
        if ($request->ajax()) {
            return view('partials.push_notification_table', compact('notifications'))->render();
        }

        // Return the view with the notifications data
        return view('push_notifications.index', compact('notifications', 'searchTerm', 'sort', 'order', 'perPage'));
    }

    public function search(Request $request)
    {
        // Get the search keyword
        $searchTerm = $request->input('search', '');

        // Fetch the notifications based on the search keyword with pagination (10 per page)
        $notifications = PushNotification::where('title', 'LIKE', "%{$searchTerm}%")
            ->orWhere('description', 'LIKE', "%{$searchTerm}%")
            ->paginate(10); // Paginate 10 items per page

        // Return the partial view with filtered notifications and pagination
        return view('partials.push_notification_table', compact('notifications'))->render();
    }


    // Store a new notification
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|max:2048', // Optional image field
        ]);

        // Handle file upload if there is an image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        // Create a new push notification
        PushNotification::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'sent_status' => 1, // Default to sent for now
        ]);

        return redirect()->route('push_notifications.index')->with('success', 'Push Notification sent successfully.');
    }
}
