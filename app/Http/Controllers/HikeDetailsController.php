<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HikeDetails;

class HikeDetailsController extends Controller
{
    public function index(Request $request)
    {
        $query = HikeDetails::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('is_active', 'like', '%' . $request->search . '%')
                ->orWhere('expected_completion_datetime', 'like', '%' . $request->search . '%')
                ->orWhere('phone_number', 'like', '%' . $request->search . '%');
        }

        // Sorting functionality
        $sort = $request->input('sort', 'first_name'); // Default sort by first_name
        $order = $request->input('order', 'asc'); // Default order is ascending
        $query->orderBy($sort, $order);

        // Pagination size
        $perPage = $request->input('entriesPerPage', 10); // Default to 10 entries per page
        $registrations = $query->paginate($perPage);

        // AJAX response
        if ($request->ajax()) {
            return view('partials.hike_table', compact('registrations'))->render();
        }

        return view('hike.index', compact('registrations'));
    }


    public function index_relationed()
    {
        // Fetch all HikeDetails with their associated LocationTracking records
        $hikeDetails = HikeDetails::with('locationTracking')->get();

        // Pass the data to the view
        return view('hike_details.index', compact('hikeDetails'));
    }

    public function detail(Request $request, $id)
    {
        // Fetch the HikeDetails record based on the given ID
        $hikeDetails = HikeDetails::findOrFail($id);

        // Fetch the paginated LocationTracking records
        $locationTracking = $hikeDetails->locationTracking()->paginate(10);

        // Pass both HikeDetails and paginated LocationTracking data to the view
        return view('hike.detail', compact('hikeDetails', 'locationTracking'));
    }


}
