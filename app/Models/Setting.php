<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_title',
        'site_url',
        'site_logo',
        'site_favicon',

        'email',      
        'instagram',  
        'linkedin',   

        'meta_title',
        'meta_description',
        'meta_keywords',

        'og_title',
        'og_description',
        'og_image',
        
        'api_tinymce_key',
        'ga_property_id',
        'ga_measurement_id',
    ];
}
