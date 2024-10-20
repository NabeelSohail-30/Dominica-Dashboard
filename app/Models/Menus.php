<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    // Specify the table name if it's not the default plural of the model name
    protected $table = 'menus';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'type', 'title', 'title_sp', 'title_fr', 'sub_title', 'subtitle_sp', 'subtitle_fr',
        'single_api', 'image_id', 'image', 'bg_image_id', 'bg_image', 'status'
    ];

    // If there are no timestamp fields (created_at, updated_at), add this:
    public $timestamps = true; // Or false, if your table doesn't have them
}
