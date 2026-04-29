<?php

namespace App\Http\Controllers;

use App\Models\ReunionApplication;
use Illuminate\Http\Request;

class AdminReunionController extends Controller
{
    public function index(Request $request)
    {
        $query = ReunionApplication::query();

        if ($request->filled('year')) {
            $query->where('graduation_year', $request->year);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->orderBy('created_at', 'desc')->get();
        $totalApplications = ReunionApplication::count();
        $approvedApplications = ReunionApplication::where('status', 'approved')->count();
        
        $years = ReunionApplication::select('graduation_year')->distinct()->orderBy('graduation_year', 'desc')->pluck('graduation_year');

        return view('admin.applications.index', compact(
            'applications', 
            'totalApplications', 
            'approvedApplications',
            'years'
        ));
    }

    public function approve(ReunionApplication $application)
    {
        $application->status = 'approved';
        $application->save();
        return redirect()->route('admin.applications.index')->with('success', 'Application approved successfully!');
    }

    public function reject(ReunionApplication $application)
    {
        $application->status = 'rejected';
        $application->save();
        return redirect()->route('admin.applications.index')->with('success', 'Application rejected successfully!');
    }
}
