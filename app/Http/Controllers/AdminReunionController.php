<?php

namespace App\Http\Controllers;

use App\Models\ReunionApplication;
use Illuminate\Http\Request;

class AdminReunionController extends Controller
{
    public function index()
    {
        $applications = ReunionApplication::orderBy('created_at', 'desc')->get();
        $totalApplications = ReunionApplication::count();
        $approvedApplications = ReunionApplication::where('status', 'approved')->count();
        
        return view('admin.applications.index', compact(
            'applications', 
            'totalApplications', 
            'approvedApplications'
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
