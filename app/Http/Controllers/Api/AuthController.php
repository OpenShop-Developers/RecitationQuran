<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ClientResetPassword;
use App\Models\Client;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:clients',
            'password' => 'required|confirmed|min:8',
            'gender' => 'required|in:male,female'
        ]);

        if ($validator->fails()) {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }

        $request->merge(['password' => bcrypt($request->password)]);

        $client = Client::create($request->all());

        $client->api_token = Str::random(60);

        $client->save();

        if ($client) {
            return responseJson(1, 'تم التسجيل بنجاح', [
                'api_token' => $client->api_token,
                'client' => $client
            ]);
        } else {
            return responseJson(0, 'حدث خطأ برجاء المحاوله مره أخري');
        }
    }

    public function login(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'email' => 'required|email|exists:clients',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $data = $validator->errors();

            return responseJson(0, $validator->errors()->first(), $data);
        }

        $client = Client::where('email', $request->email)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                return responseJson(1, 'تم تسجيل الدخول بنجاح', [
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
            } else {
                return responseJson(0, 'بيانات الدخول غير صحيحه');
            }
        } else {
            return responseJson(0, 'بيانات الدخول غير صحيحه');
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'email' => 'required|email|exists:clients,email'
        ]);

        if ($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }

        $client =Client::where('email', $request->email)->first();

        if ($client)
        {
            $code = rand(1111, 9999);
            $update =$client->update(['pin_code' => $code]);

            if ($update)
            {
                //send mail
                Mail::to($client->email)
                    ->bcc("abdo.muhammed1122@gmail.com")
                    ->send(new ClientResetPassword($code));

                return responseJson(1, 'برجاء فحص بريدك الالكتروني', ['pin code for test' => $code]);
            } else {
                return responseJson(0, 'حدث خطأ ، برجاء المحاوله مره أخري');
            }
        } else {
                return responseJson(0,'البريد الالكتروني الذي ادخلته غير صحيح');
        }
    }

    public function newPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'pin_code' => 'required',
            'password' => 'required|confirmed'
        ]);
        if ($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0,$validator->errors()->first(), $data);
        }

        $client = Client::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)->first();

        if ($client)
        {
            $client->password = bcrypt($request->password);

            $client->pin_code = null;

            if ($client->save()) {
                return responseJson(1, 'تم تغيير كلمة المرور بنجاح');
            } else {
                return responseJson(0, 'حدث خطأ برجاء المحاوله مره أخري');
            }
        } else {
            return responseJson(0, 'هذا الكود غير صالح');
        }
    }

    public function profile(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name'      => 'max:50',
            'email'     => 'email|unique:clients,email,'.$request->user()->id,
            'password'  => 'confirmed',
            'gender'    => 'in:male,female'
        ]);

        if ($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0,$validator->errors()->first(), $data);
        }

        $loginUser = $request->user();
        $loginUser->update($request->all());

        if ($request->has('password'))
        {
            $loginUser->password = bcrypt($request->password);
        }

        $loginUser->save();
        $data = $request->user();
        return responseJson(1,'تم تعديل البيانات بنجاح', $data);
    }

    public function changePassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'old_password'  => 'required',
            'password'    => 'required|confirmed|min:8'
        ]);

        if ($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0,$validator->errors()->first(), $data);
        }

        $user = $request->user();
        if (Hash::check($request->old_password, $user->password))
        {
            $user->password = bcrypt($request->password);

            if ($user->save())
            {
                return responseJson(1,'تم تغيير كلمة المرور بنجاح');
            } else {
                return responseJson(0,'حدث خطأ ، برجاء المحاوله مره أخري');
            }
        } else {
            responseJson(0,'عفوا كلمة المرور التي ادخلتها غير صحيحه');
        }
    }


    public function registerToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'token'  => 'required',
            'type'    => 'required|in:android,ios'
        ]);

        if ($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0,$validator->errors()->first(), $data);
        }

        Token::where('token', $request->token)->delete();

        $token = $request->user()->tokens()->create($request->all());
        return responseJson(1,'تم التسجيل بنجاح');
    }


    public function removeToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'token'  => 'required',
        ]);

        if ($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0,$validator->errors()->first(), $data);
        }

        Token::where('token', $request->token)->delete();
        return responseJson(1 , 'تم الحذف بنجاح');
    }
}
