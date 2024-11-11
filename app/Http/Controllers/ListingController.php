<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;


class ListingController extends Controller
{
    public function index($id)
    {
        // Retrieve listings with the given menu_id
        $listings = Listing::where('menu_id', $id)->get();

        // Return the view with the retrieved listings
        return view('listings.index', compact('listings'));
    }
}
