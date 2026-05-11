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

    public function destroy(ReunionApplication $application)
    {
        if (auth()->user()->role !== 'super_admin') {
            abort(403);
        }
        $application->delete();
        return redirect()->route('admin.applications.index')->with('success', 'Application deleted successfully!');
    }

    public function edit(ReunionApplication $application)
    {
        if (auth()->user()->role !== 'super_admin') {
            abort(403);
        }

        return view('admin.applications.edit', compact('application'));
    }

    public function update(Request $request, ReunionApplication $application)
    {
        if (auth()->user()->role !== 'super_admin') {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'gender' => 'nullable|in:male,female,other',
            'spouse_type' => 'nullable|in:husband,wife,none',
            'member_type' => 'nullable|in:guest,ex_student,running_student',
            'tshirt_size' => 'nullable|string|max:10',
            'number_of_children' => 'nullable|integer|min:0',
            'payment_method' => 'nullable|string|max:50',
            'donation_amount' => 'nullable|integer|min:0',
            'transaction_number' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'graduation_year' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        $application->update($data);

        return redirect()->route('admin.applications.index')->with('success', 'Application updated successfully!');
    }
}
