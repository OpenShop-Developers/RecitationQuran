<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @var string
     */
    private $mainRetrun;

    public function __construct()
    {
        $this->mainRetrun = 'dashboard.users.';
    }

    public function changePassword()
    {
        return view($this->mainRetrun. 'reset-password');
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'old-password' => 'required',
            'password'     => 'required|confirmed'
        ];

        $messages = [
            'old-password' => 'كلمة المرور الحاليه مطلوبه',
            'password'     => 'كلمة المرور مطلوبه'
        ];

        $this->validate($request , $rules , $messages);

        $user = auth()->user();

        if(Hash::check($request->input('old-password') , $user->password)){
            $user->password = bcrypt($request->input('password'));
            $user->save();

            flash()->success('تم تغيير كلمة المرور بنجاح');
            return back();

        } else
            flash()->error('كلمة المرور غير صحيحه');
        return back();

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = User::paginate(20);

        return view($this->mainRetrun . 'index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->mainRetrun . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required|confirmed|min:8',
            'gender' => 'required|in:male,female',
            'facebook_link' => 'required|url',
            'twitter_link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'roles_list'=> 'required',

        ];
        $messages = [
            'name.required' => 'الاسم مطلوب',
            'name.max' => 'الاسم لا يجب ان يتخطي 55 حرف',
            'email.required' => 'البريدالالكتروني مطلوب',
            'email.unique' => 'قيمة البريدالالكتروني مستخدمه من قبل',
            'email.email' => 'البريدالالكتروني يجب ان يكون ايميل',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.numeric' => 'رقم الهاتف يجب ان يكون ارقام فقط',
            'phone.unique' => 'رقم الهاتف مستخدم من قبل',
            'password.required' => 'كلمة المرور مطلوبه',
            'password.confirmed' => 'كلمة المرور يجب ان تكون متطابقه',
            'gender.required' => 'الجنس مطلوب',
            'gender.in' => 'الجنس يجب ان يكون ذكرا او انثي',
            'facebook_link.required' => 'رابط الفيسبوك مطلوب',
            'facebook_link.url' => 'رابط فيسبوك يجب ان يكون صحيحا',
            'twitter_link.required' => 'رابط تويتر مطلوب',
            'twitter_link.url' => 'رابط تويتر يجب ان يكون صحيحا',
            'image.required' => 'الصوره مطلوبه',
            'image.image' => 'الصوره يحب ان تكون صوره',
            'image.mimes' => 'الصوره يجب ان تكون احد هذه الانواع : jpeg,png,jpg,gif ',
            'roles_list.required' => 'الصلاحيات مطلوبه',
        ];

        $this->validate($request, $rules, $messages);

        $request->merge(['password' => bcrypt('password')]);
        $record = User::create($request->except('roles_list'));
        $record->roles()->attach($request->input('roles_list'));

        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/images/';
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $image->move($destinationPath, $name); // uploading file to given path
            $record->image = $name;
            $record->save();
        }

        flash()->success('تم اضافة المشرف بنجاح');
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = User::findOrFail($id);
        return view($this->mainRetrun. 'edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,'.$id,
            'phone' => 'numeric|unique:users,phone,'.$id,
            'gender' => 'in:male,female',
            'facebook_link' => 'url',
            'twitter_link' => 'url',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'roles_list'=> 'required',
        ];
        $messages = [
            'name.max' => 'الاسم لا يجب ان يتخطي 55 حرف',
            'email.unique' => 'قيمة البريدالالكتروني مستخدمه من قبل',
            'email.email' => 'البريدالالكتروني يجب ان يكون ايميل',
            'phone.numeric' => 'رقم الهاتف يجب ان يكون ارقام فقط',
            'phone.unique' => 'رقم الهاتف مستخدم من قبل',
            'gender.in' => 'الجنس يجب ان يكون ذكرا او انثي',
            'facebook_link.url' => 'رابط فيسبوك يجب ان يكون صحيحا',
            'twitter_link.url' => 'رابط تويتر يجب ان يكون صحيحا',
            'image.image' => 'الصوره يحب ان تكون صوره',
            'image.mimes' => 'الصوره يجب ان تكون احد هذه الانواع : jpeg,png,jpg,gif ',
            'roles_list.required' => 'الصلاحيات مطلوبه',
        ];

        $this->validate($request, $rules, $messages);

        $record = User::findOrFail($id);

        $record->roles()->sync((array) $request->input('roles_list'));

        $update = $record->update($request->all());

        if ($request->hasFile('image')) {

            $path = public_path();
            $destinationPath = $path . '/uploads/images/';
            if (file_exists($destinationPath . $record->image)) {
                unlink($destinationPath . $record->image);
            }
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $image->move($destinationPath, $name); // uploading file to given path
            $record->image = $name;
            $record->save();
        }

        flash()->success('تم تعديل بيانات المشرف بنجاح');
        return redirect(route('users.edit', $record->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::findOrFail($id);
//        dd($record->image);
        $path = public_path();
        $destinationPath = $path . '/uploads/images/';
        if (file_exists($destinationPath . $record->image)) {
            unlink($destinationPath . $record->image);
        }

        $record->delete();
        flash()->success('تم الحذف بنجاح');
        return back();
    }



    public function changeUserPassword(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->password = bcrypt($request->password);
        $user->save();
        flash()->success('تم تعديل كلمة المرور بنجاح');
        return back();
    }


    public function filter(Request $request)
    {
        $records = User::where(function ($query) use($request){
            if ($request->input('from') && $request->input('to'))
            {
                if($request->input('to') >= $request->input('from')){
                    $query->whereBetween('created_at', [$request->input('from'), $request->input('to')]);
                }
                if($request->input('to') <= $request->input('from')){
                    $query->whereBetween('created_at', [$request->input('to'), $request->input('from')]);
                }
            }
            if ($request->input('name'))
            {
                $query->where('name', 'like', '%' . $request->name. '%');
            }
            if ($request->input('email'))
            {
                $query->where('email', 'like', '%' . $request->email. '%');
            }
            if ($request->input('gender'))
            {
                $query->where('gender', $request->gender);
            }

            if ($request->input('roles_list'))
            {
                $query->whereHas('roles',function ($role) use($request){
                    $role->where('id',$request->roles_list);
                });
            }
        })->paginate(20);
        return view($this->mainRetrun. 'index', compact('records'));
    }
}
