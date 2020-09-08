<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('review', 'client_id', 'comment');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }


}
