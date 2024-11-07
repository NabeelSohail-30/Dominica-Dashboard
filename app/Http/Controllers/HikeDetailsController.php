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

        // Pagination and entries per page
        $perPage = $request->input('per_page', 10); // Default is 10 entries per page
        $registrations = $query->paginate($perPage);

        // AJAX response
        if ($request->ajax()) {
            return view('partials.hike_table', compact('registrations'))->render();
        }

        return view('hike.index', compact('registrations'));
    }
}
