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
}
