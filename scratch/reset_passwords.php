<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$emails = ['superadmin@reunion.com', 'moderator@reunion.com', 'viewer@reunion.com'];

foreach ($emails as $email) {
    $user = User::where('email', $email)->first();
    if ($user) {
        $user->password = Hash::make('password');
        $user->save();
        echo "Password updated for $email\n";
    } else {
        echo "User not found: $email\n";
    }
}
