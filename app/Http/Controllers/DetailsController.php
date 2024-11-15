<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Details;

class DetailsController extends Controller
{
    public function index($id)
    {
        // Retrieve listings with the given menu_id
        $details = Details::where('menu_list_id', $id)->get();

        // Return the view with the retrieved listings
        return view('details.index', compact('details'));
    }

    public function create()
    {
        return view('details.create');
    }
}
