<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us'; // Specify the table name
    public $timestamps = true; // If you're using timestamps
    protected $fillable = [
        'title',
        'description',
        'about_image',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'youtube_url',
        'linkedin_url'
    ]; // Add fillable fields for mass assignment
}
