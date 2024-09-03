<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('notification_settings_text', 'about_app_ar','intro_text_ar_1','intro_text_ar_2','intro_text_ar_3','about_app_en','intro_text_en_1','intro_text_en_2','intro_text_en_3','promoting_text_ar','promoting_text_en');

}
