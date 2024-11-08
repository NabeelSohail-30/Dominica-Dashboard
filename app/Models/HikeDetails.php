<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HikeDetails extends Model
{
    use HasFactory;

    protected $table = 'pre_hike_registration';

    // Specify the fillable fields
    protected $fillable = [
        'first_name',
        'last_name',
        'current_address',
        'phone_number',
        'intended_hike',
        'status',
        'is_active',
        'estimated_start_datetime',
        'expected_completion_datetime',
        'next_of_kin_name',
        'next_of_kin_contact_number',
        'created_at',
        'user_id'
    ];

    // Define the relationship to the LocationTracking model
    public function locationTracking()
    {
        return $this->hasMany(HikeLocationTracking::class, 'registration_id');
    }
}
