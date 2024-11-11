<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'listings';

    // Specify the primary key for the table
    protected $primaryKey = 'id';

    // Enable timestamps
    public $timestamps = true;

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'menu_id',
        'menu_type',
        'title',
        'title_sp',
        'title_fr',
        'image_id',
        'image',
        'bg_image_id',
        'bg_image',
        'website_link',
        'status',
        'temp_menu_id',
        'temp_menu_type',
        'created_at',
        'updated_at',
    ];

    // Cast fields to appropriate data types if necessary
    protected $casts = [
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
