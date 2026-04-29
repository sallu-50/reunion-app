<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\ReunionApplication;
use App\Http\Controllers\AdminReunionController;

// Landing Page
Route::get('/', function () {
    return view('landing');
});

// Reunion Application Form
Route::get('/apply', function () {
    return view('welcome');
})->name('apply.form');

Route::post('/apply', function (Request $request) {
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:reunion_applications',
        'phone' => 'nullable|string|max:20',
        'member_type' => 'required|in:guest,ex_student,running_student',
        'graduation_year' => 'required|integer|min:1900|max:' . date('Y'),
        'gender' => 'required|in:male,female,other',
        'present_address' => 'required|string',
        'permanent_address' => 'required|string',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        'number_of_guests' => 'required|integer|min:0',
        'wants_to_perform' => 'required|boolean',
        'performance_type' => 'nullable|string|max:255',
        'message_to_teachers' => 'nullable|string',
        'donation_amount' => 'required|integer|min:0',
        'payment_method' => 'required|in:bKash,Nagad',
        'transaction_number' => 'required|string|max:255',
        'donation_message' => 'nullable|string',
        'message' => 'nullable|string', // Used for "Any Question"
    ]);

    if ($request->hasFile('photo')) {
        $validatedData['photo'] = $request->file('photo')->store('photos', 'public');
    }

    if ($request->hasFile('video')) {
        $validatedData['video'] = $request->file('video')->store('videos', 'public');
    }

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
});

Auth::routes();
