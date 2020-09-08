<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use LaravelEntrustUserTrait;

    protected $appends = ['roles_list'];

    public function getImagePathAttribute()
    {
        $image = User::where('id', $this->id)->first()->image;

        if (!$image) {
            return asset('uploads/images/default.png');
        } else {
            return asset('uploads/images/' . $this->image);
        }
    }

    public function getClientGenderAttribute()
    {
        $gender = User::where('id', $this->id)->first()->gender;

        if ($gender == 'male')
        {
            return 'ذكر';
        } else {
            return 'انثي';
        }
    }

    public function getRolesListAttribute()
    {
        return $this->roles()->pluck( 'id')->toArray();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'facebook_link', 'twitter_link', 'gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function records()
    {
        return $this->hasMany('App\Models\Record');
    }

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }


}
