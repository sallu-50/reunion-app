<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\ReunionApplication;
use App\Http\Controllers\AdminReunionController;

// Landing Page
Route::get('/', function () {
    $totalApplied = ReunionApplication::count();
    $totalApproved = ReunionApplication::where('status', 'approved')->count();
    return view('landing', compact('totalApplied', 'totalApproved'));
});

// Reunion Application Form
Route::get('/apply', function () {
    return view('welcome');
})->name('apply.form');

Route::post('/apply', function (Request $request) {
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'gender' => 'required|in:male,female,other',
        'spouse_type' => 'nullable|in:husband,wife,none',
        'member_type' => 'required|in:guest,ex_student,running_student',
        'graduation_year' => 'required|integer|min:1900|max:' . date('Y'),
        'number_of_children' => 'required|integer|min:0',
        'payment_method' => 'required|in:bKash,Nagad,Bank',
        'donation_amount' => 'required|integer|min:0',
        'transaction_number' => 'required|string|max:255',
    ]);

    ReunionApplication::create($validatedData);

    return redirect()->route('apply.form')->with('success', 'Application submitted successfully!');
})->name('apply.submit');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminReunionController::class, 'index'])
        ->middleware('role:super_admin,moderator,viewer')
        ->name('applications.index');
    
    Route::post('applications/{application}/approve', [AdminReunionController::class, 'approve'])
        ->middleware('role:super_admin,moderator')
        ->name('applications.approve');
    
    Route::post('applications/{application}/reject', [AdminReunionController::class, 'reject'])
        ->middleware('role:super_admin,moderator')
        ->name('applications.reject');
    
    Route::delete('applications/{application}', [AdminReunionController::class, 'destroy'])
        ->middleware('role:super_admin')
        ->name('applications.destroy');
});

Auth::routes();
