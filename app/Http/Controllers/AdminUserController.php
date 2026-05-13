<?php

namespace App\Http\Controllers;

use App\Jobs\SendApprovalSms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Larament\Barta\Facades\Barta;

class AdminUserController extends Controller
{
    public function approve(Request $request, User $user)
    {
        if (auth()->user()->role !== 'super_admin') {
            abort(403);
        }

        $user->is_approved = true;
        $user->save();

        $query = $request->only(['page']);
        return redirect()->route('admin.applications.index', $query)->with('success', 'User approved and SMS queued.');
    }
}
