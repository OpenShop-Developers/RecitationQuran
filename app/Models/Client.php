<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'gender','pin_code');

    public function getClientGenderAttribute()
    {
        $gender = Client::where('id', $this->id)->first()->gender;

        if ($gender == 'male')
        {
            return 'ذكر';
        } else {
            return 'انثي';
        }
    }





    public function records()
    {
        return $this->hasMany('App\Models\Record');
    }

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

    protected $hidden = [
        'password', 'api_token', 'pin_code'
    ];

}
