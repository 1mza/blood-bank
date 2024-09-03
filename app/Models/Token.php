<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('client_id', 'token', 'type');

    public function clients()
    {
        return $this->belongsTo('App\Models\Client');
    }

}
