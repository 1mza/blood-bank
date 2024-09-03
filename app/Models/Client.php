<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientGovernorate;
use App\Models\Governorate;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Client extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'clients';
    public $timestamps = true;
    protected $casts = [
        'pin_code_expires_at' => 'datetime',
    ];
    protected $fillable = array('phone', 'email', 'blood_type_id', 'password', 'name', 'd_o_b', 'last_donation_date','governorate_id', 'city_id','pin_code','pin_code_expires_at','remember_token');


    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }
    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }
    public function bloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites', 'client_id', 'post_id')
            ->withTimestamps();
    }


    public function notifications()
    {
        return $this->hasMany('App\Models\ClientNotification');
    }

    public function governorates()
    {
        return $this->belongsToMany(Governorate::class);
    }
    public function mainGovernorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }public function mainBloodType()
    {
        return $this->belongsTo(BloodType::class, 'blood_type_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    protected $hidden = [
        'password',
        'api_token',
    ];

}
