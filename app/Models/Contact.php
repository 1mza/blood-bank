<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable = array('subject', 'message', 'email','phone','name');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

}
