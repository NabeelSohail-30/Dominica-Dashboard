<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'achievements'; // Assuming the table name is 'achievements'

    // Define the primary key if different from 'id'
    protected $primaryKey = 'id';

    // Disable timestamps if not used, otherwise keep it
    public $timestamps = true;

    // Define which fields are mass assignable
    protected $fillable = [
        'achievement_title',
        'achievement_push_title',
        'achievement_how_to_get_here',
        'achievement_description',
        'achievement_image_color',
        'achievement_image_bw',
        'manual',
        'achievement_lat',
        'achievement_long',
        'radius',
        'dialog_box_image',
        'dialog_box_image_bw',
        'achievement_status',
        'created_at',
        'updated_at'
    ];

    // Set the default values for attributes if needed
    protected $attributes = [
        'achievement_status' => 1, // Default value of 1
        'radius' => 20, // Default value of 20
        'achievement_lat' => '0.0',
        'achievement_long' => '0.0',
    ];

    // If the 'created_at' and 'updated_at' columns are not standard, specify the column names
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
