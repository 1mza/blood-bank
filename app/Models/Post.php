<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'image','detailed_title', 'content', 'category_id');

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(Client::class, 'favorites', 'post_id', 'client_id')
            ->withTimestamps();
    }

}
