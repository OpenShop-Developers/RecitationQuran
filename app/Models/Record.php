<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{

    protected $table = 'records';
    public $timestamps = true;
    protected $fillable = array('record', 'client_id', 'user_id');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
