<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['title', 'content'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    protected $hidden = ['is_read'];
}
