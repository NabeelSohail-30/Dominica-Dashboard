<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'details';

    // Specify the primary key for the table
    protected $primaryKey = 'id';

    // Enable or disable timestamps based on your table structure
    public $timestamps = true;  // Since `created_at` and `updated_at` fields exist

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'menu_list_id',
        'menu_type',
        'title',
        'sub_title',
        'push_welcome_title',
        'push_body',
        'description',
        'description_sp',
        'description_fr',
        'description_2',
        'flag_image_id',
        'flag',
        'latitude',
        'longitude',
        'radius',
        'location',
        'image_id',
        'image',
        'bg_image_id',
        'bg_image',
        'year',
        'date',
        'day',
        'timing',
        'email',
        'phone',
        'whatsappNum',
        'website',
        'video',
        'badge',
        'geo_fencing',
        'achievement_ids',
        'gallery_status',
        'vgallery_status',
        'nearby',
        'status',
        'booking_url',
        'registration_link',
        'is_featured',
        'featured_banner',
        'has_trail',
        'has_360',
    ];

    // Cast fields to appropriate data types if necessary
    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'geo_fencing' => 'boolean',
        'has_360' => 'boolean',
        'is_featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
