<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReunionApplication extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'graduation_year',
        'message',
        'status',
        'member_type',
        'gender',
        'present_address',
        'permanent_address',
        'photo',
        'video',
        'spouse_type',
        'number_of_children',
        'wants_to_perform',
        'performance_type',
        'message_to_teachers',
        'donation_amount',
        'payment_method',
        'transaction_number',
        'donation_message',
    ];
}
