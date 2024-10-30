<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppUser extends Model
{
    use HasFactory, Notifiable;

    // Define the table associated with the model (if not following naming convention)
    protected $table = 'app_users';

    // Specify the primary key (if it's not 'id')
    protected $primaryKey = 'id';

    // Disable timestamps if you don't have created_at and updated_at fields
    public $timestamps = true;

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'remember_token',
        'firebase_token',
        'phone',
        'login_from',
        'social_id',
        'device_id',
        'imei_no',
        'contact_tourism',
        'type',
        'reset_counter',
        'reset_token',
    ];

    // Specify fields that should be hidden from arrays (like when converting to JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast fields to appropriate data types
    protected $casts = [
        'email_verified_at' => 'datetime',
        'contact_tourism' => 'boolean',
        'reset_counter' => 'integer',
        'login_from' => 'string',
    ];

}
