<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Details;


class FeaturedLocation extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input("search", "");
        $perPage = $request->input("per_page", 10);

        $featuredDetails = Details::where("is_featured", 1)
            ->where(function ($query) use ($searchTerm) {
                $query->where("title", "LIKE", "%{$searchTerm}%");
            })
            ->paginate($perPage);

        if ($request->ajax()) {
            return view('partials.featured_table', compact('featuredDetails'))->render();
        }

        return view('featured_location.index', compact('featuredDetails'));
    }

}
