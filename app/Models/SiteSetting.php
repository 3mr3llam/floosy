<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class SiteSetting extends Model
{
    use HasFactory, HasTranslations;
    protected $translatable = ['site_name'];
    protected $fillable = ['default_lang', 'email', 'facebook', 'snapchat', 'twitter', 'tiktok', 'instagram', 'whatsapp', 'url', 'second_mobile', 'mobile', 'is_open', 'meta_keyWords', 'meta_author', 'fav_icon', 'meta_description', 'meta_title', 'site_name', 'default_payment', 'default_currancy', 'telr_store_id', 'telr_auth_key', 'telr_is_testing', 'whatsapp_token', 'whatsapp_instance'];
}
