<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'company_name',
        'primary_mobile_no',
        'secondary_mobile_no',
        'primary_email',
        'secondary_email',
        'address',
        'embedded_map',
        'footer_text',
        'logo_image',
        'fav_icon_image',
        'facebook_link',
        'instagram_link',
        'whatsapp_link',
        'linkedin_link',
    ];

}
