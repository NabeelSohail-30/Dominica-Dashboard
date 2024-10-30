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
        'menu_tuc_id',
        'menu_type',
        'sub_title',
        'push_welcome_title',
        'push_body',
        'description_sp',
        'description_1',
        'description_fr',
        'description_2',
        'flag_image_id',
        'flag',
        'latitude',
        'longitude',
        'location',
        'image',
        'bg_image_id',
        'zip_code',
        'year',
        'date',
        'day',
        'email',
        'phone',
        'whatsappNum',
        'website',
        'badge',
        'video',
        'geo_fencing',
        'solvement_ids',
        'gallery_status',
        'nearby',
        'gallery_status',
        'booking_url',
        'registration_link',
        'is_featured',
        'has_featured_banner',
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
