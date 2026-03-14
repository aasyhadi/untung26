<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'site_name',
        'site_domain_text',
        'lokasi',
        'email',
        'whatsapp_number',
        'whatsapp_default_message',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'profil_ringkas',
    ];
}
