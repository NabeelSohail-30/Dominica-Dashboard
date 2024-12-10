<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HikeDetails;

class HikeDetailsController extends Controller
{
    public function index(Request $request)
    {
        $query = HikeDetails::query();

        // Filter based on status
        if ($request->filled('status')) {
            switch ($request->status) {
                case 'ongoing':
                    $query->where('is_active', 1)
                        ->where('expected_completion_datetime', '>=', now());
                    break;
                case 'overdue':
                    $query->where('is_active', 1)
                        ->where('expected_completion_datetime', '<', now());
                    break;
                case 'completed':
                    $query->where('is_active', 0);
                    break;
            }
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('is_active', 'like', '%' . $request->search . '%')
                    ->orWhere('expected_completion_datetime', 'like', '%' . $request->search . '%')
                    ->orWhere('phone_number', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        $sort = $request->input('sort', 'first_name'); // Default sort
        $order = $request->input('order', 'asc'); // Default order
        $query->orderBy($sort, $order);

        // Pagination
        $perPage = $request->input('entriesPerPage', 10);
        $registrations = $query->paginate($perPage);

        // Return AJAX or standard view
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
