<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'ratings'; // Replace 'reviews' with your actual table name if different

    // Specify the primary key for the table
    protected $primaryKey = 'id';

    // Enable or disable timestamps based on your table structure
    public $timestamps = true;  // Since `created_at` and `updated_at` exist

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'detail_id',
        'social_id',
        'rating',
        'user_id',
        'review',
    ];

    // Optionally, cast some fields to proper types
    protected $casts = [
        'rating' => 'integer',
        'created_At' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
