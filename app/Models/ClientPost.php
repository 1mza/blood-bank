<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientPost extends Model 
{

    protected $table = 'client_post';
    public $timestamps = true;
    protected $fillable = array('client_id', 'post_id');

    public function posts()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

}