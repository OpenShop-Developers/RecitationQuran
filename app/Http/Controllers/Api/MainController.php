<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Review;
use App\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function review(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'review' => 'required|in:1,2,3,4,5',
            'comment' => 'required|max:255',
        ]);

        if ($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0,$validator->errors()->first(), $data);
        }
        $client = $request->user();
        $client->reviews()->create($request->all());
        return responseJson(1,'شكرا علي تقييمك لنا');
    }

    public function reviewList(Request $request)
    {
        $reviews = Review::paginate(10);
        return responseJson(1,'success', $reviews);
    }


    public function showAllAdmins(Request $request)
    {
        $gender = $request->user()->gender;
        $admins = User::where('gender', $gender)->get();

        if (count($admins))
        {
            return responseJson(1,'success', $admins);
        } else {
            return responseJson(0,'لا يوجد محفظين');
        }
    }

    public function filterAdmins(Request $request)
    {
        $name = $request->name;
        $gender = $request->user()->gender;
        $search = User::where('gender', $gender)
        ->where('name', 'like', '%' . $name . '%' )->get();

        if (count($search))
        {
            return responseJson(1,'success', $search);
        } else {
            return responseJson(1,'لا يوجد اسماء مشابهه للذي ادخلته');

        }
    }

    public function contactMessages(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'message' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0,$validator->errors()->first(), $data);
        }

        $user_id = $request->user_id;

        $client = $request->user();


        $client->contacts()->create([
            'message' => $request->message,
            'user_id' => $user_id,
            'type'    => 1
        ]);

        return responseJson(1,'تم الارسال بنجاح');

    }

    public function contactAudio(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'audio' => 'nullable|mimes:audio/mpeg,mpga,mp3,wav,aac',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0,$validator->errors()->first(), $data);
        }

        $client = $request->user();
        $user_id = $request->user_id;

        if ($request->hasFile('audio')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/audio'; // upload path
            $audio = $request->file('audio');
            $extension = $audio->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $audio->move($destinationPath, $name); // uploading file to given path

            // save voice message to records table
            $client->records()->create([
                'record'  => $name,
                'user_id' => $user_id

            ]);

            // save voice message to messages table
            $client->contacts()->create([
                'message' => $name,
                'user_id' => $user_id,
                'type'    => 2
            ]);
            $client->save();

        }
        return responseJson(1,'تم الارسال بنجاح');
    }

    public function messageReply(Request $request)
    {
        $client = $request->user();

        $message = $request->message_id;

        $reply = Contact::where('id', $message)->pluck('message_reply');


//        $reply = $message->where('message_reply', $message->message_reply)->get();

        return responseJson(1,'success', $reply);
    }

    public function adminProfile(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0,$validator->errors()->first(), $data);
        }

        $gender = $request->user()->gender;
        $user = User::where('gender', $gender)
        ->where('id', $request->user_id)->first();

        if ($user) {
            return responseJson(1,'success', $user);
        } else {
            return responseJson(0,'لا يوجد محفظين');
        }
    }


    public function notificationList(Request $request)
    {
        $notifications = $request->user()->notifications()->get();

        if (count($notifications))
        {
            return responseJson(1,'success', $notifications);
        } else {
            return responseJson(0,'لا يوجد اشعارات حاليا');
        }
    }


    public function notificationUpdate(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'notification_id' => 'required|exists:notifications,id'
        ]);

        if ($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0,$validator->errors()->first(), $data);
        }



        $notification = $request->user()->notifications()->find($request->notification_id);

        if ($notification->is_read == 0) {
            if (!isset($notification))
            {
                return responseJson(0,'حدث خطأ ما');
            }
            $notification->is_read = 1;
            $notification->save();
            return responseJson(1,'تم التحديث بنجاح');
        } else  {
            return responseJson(0,'هذا الاشعار قد تمت مشاهدته من قبل العميل');
        }

    }
}
