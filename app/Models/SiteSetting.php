<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class SiteSetting extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    protected $table = 'site_settings';

    protected $fillable = [
        'company_name',
        'primary_mobile_no',
        'secondary_mobile_no',
        'primary_email',
        'secondary_email',
        'address',
        'embedded_map',
        'logo_image',
        'footer_text',
        'fav_icon_image',
        'instagram_link',
        'facebook_link',
        'whatsapp_link',
        'linkedin_link',
    ];
}
