<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HikeLocationTracking extends Model
{
    use HasFactory;

    protected $table = 'hike_location_tracking'; // Replace with the actual table name if different

    // Specify the fillable fields
    protected $fillable = [
        'registration_id',
        'latitude',
        'longitude',
        'tracked_at',
    ];

    // Define the relationship to the HikeDetails model
    public function hikeDetails()
    {
        return $this->belongsTo(HikeDetails::class, 'registration_id');
    }
}
