<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientNotification extends Model
{

    protected $table = 'client_notification';
    public $timestamps = true;
    protected $fillable = array('client_id', 'notification_id', 'is_read');
    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }
}
