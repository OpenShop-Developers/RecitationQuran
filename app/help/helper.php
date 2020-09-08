<?php
function responseJson($status , $message , $data=null)
{
    $response = [
        'status' => $status,
        'message'=>$message,
        'data'   =>$data
    ];
    return response()->json($response);
}


function gender()
{
    return [
        'male'      => 'ذكر',
        'female'    => 'انثي'
    ];
}

function review($review)
{
    if ($review == 1)
    {
        return 'غاضب';
    } elseif ($review == 2)
    {
        return 'غير راضي';
    } elseif ($review == 3)
    {
        return 'راضي';
    } elseif ($review == 4)
    {
        return 'سعيد';
    } elseif ($review == 5)
    {
        return 'سعيد جدا';
    }
}


 function fcm_send($token, $body = 'Tasmee3', $data = '', $title = 'Tasmee3')
{
    $api_key = 'AIzaSyCd59DcYvNArN-I886icsQOzUWsPuhrEDQ';
    $push_url = 'https://fcm.googleapis.com/fcm/send';
    if (!is_array($token)) {
        $token = [$token];
    }
    // $array_token =array();
    $msg =
        [
            'body' => $body,
            'title' => $title,
            'click_action' => 'home'
            //'custom_url'   => $url
        ];
    $fields =
        [
            'registration_ids' => $token,
            'notification' => $msg,
        ];
    if (!empty($data)) {

        $fields['data'] = $data;
    }
    $headers =
        [
            'Authorization' => 'key=' . $api_key,
            'Content-Type' => 'application/json'
        ];
    //        dd($fields);
    $client = new \GuzzleHttp\Client();
    $response = $client->post($push_url, [
        'headers' => $headers,
        'body' => json_encode($fields)
    ]);
    $result = $response->getBody();
    return $result;
} //end of // push notification function


function countUnreadMessages($user_id)
{
    return  \App\Models\Contact::where('user_id', $user_id)
        ->where('is_read', 0)
        ->count();
}

function unreadMessages($user_id)
{
    return \App\Models\Contact::where('user_id', $user_id)
        ->where('is_read', 0)->get();
}
