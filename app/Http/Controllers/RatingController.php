<?php

namespace App\Http\Controllers;

use App\Models\AppUsers;
use App\Models\Details;
use App\Models\Ratings;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(Request $request)
    {
        // Get search query and pagination settings
        $searchTerm = $request->input('search', '');
        $perPage = $request->input('per_page', 10); // Default is 10

        // Fetch ratings with user and detail data using manual joins
        $ratings = \DB::table('ratings')
            ->join('app_users', 'ratings.user_id', '=', 'app_users.id')
            ->join('details', 'ratings.detail_id', '=', 'details.id')
            ->select('ratings.*', 'app_users.name', 'app_users.email', 'details.description', 'ratings.created_At')
            ->where(function ($query) use ($searchTerm) {
                $query->where('app_users.name', 'like', "%{$searchTerm}%")
                    ->orWhere('app_users.email', 'like', "%{$searchTerm}%")
                    ->orWhere('ratings.review', 'like', "%{$searchTerm}%")
                    ->orWhere('details.description', 'like', "%{$searchTerm}%");
            })
            ->paginate($perPage);

        // Retain search and pagination parameters in the links
        $ratings->appends([
            'search' => $searchTerm,
            'per_page' => $perPage,
        ]);

        return view('ratings.index', compact('ratings', 'searchTerm', 'perPage'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search', '');
        $perPage = $request->input('per_page', 10);

        // Same logic as in the index method, but for AJAX search
        $ratings = \DB::table('ratings')
            ->join('app_users', 'ratings.user_id', '=', 'app_users.id')
            ->join('details', 'ratings.detail_id', '=', 'details.id')
            ->select('ratings.*', 'app_users.name', 'app_users.email', 'details.description', 'ratings.created_At')
            ->where(function ($query) use ($searchTerm) {
                $query->where('app_users.name', 'like', "%{$searchTerm}%")
                    ->orWhere('app_users.email', 'like', "%{$searchTerm}%")
                    ->orWhere('ratings.review', 'like', "%{$searchTerm}%")
                    ->orWhere('details.description', 'like', "%{$searchTerm}%");
            })
            ->paginate($perPage);

        // Return partial view for table body
        return view('partials.ratings_table', compact('ratings'))->render();
    }

}
