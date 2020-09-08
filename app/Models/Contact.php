<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable = array('client_id', 'user_id', 'message', 'message_reply', 'type', 'is_read');

    //determine if message has replies or not
    public function getAdminReplyAttribute()
    {
        $reply = Contact::where('id', $this->id)->first()->message_reply;

        if (!empty($reply))
        {
            return $reply;

        }  else {
            return 'لا يوجد رد علي هذه الرساله حاليا';
        }
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
