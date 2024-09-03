<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientGovernorate extends Model
{

    protected $table = 'client_governorate';
    public $timestamps = true;
    protected $fillable = array('governorate_id', 'client_id');



}
