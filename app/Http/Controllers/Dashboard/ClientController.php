<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\TestFixture\C;

class ClientController extends Controller
{

    /**
     * @var string
     */
    private $mainRetrun;

    public function __construct()
    {
        $this->mainRetrun = 'dashboard.clients.';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $records = Client::paginate(15);
        return view($this->mainRetrun . 'index', compact('records'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->mainRetrun . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $rules = [

            'name' => 'required|max:255',
            'email' => 'required|email|unique:clients',
            'password' => 'required|confirmed',
            'gender' => 'required|in:male,female'
        ];
        $messages = [

            'name.required' => 'الاسم مطلوب',
            'name.max' => 'الاسم لا يجب ان يتخطي 55 حرف',
            'email.required' => 'البريدالالكتروني مطلوب',
            'email.unique' => 'قيمة البريدالالكتروني مستخدمه من قبل',
            'email.email' => 'البريدالالكتروني يجب ان يكون ايميل',
            'password.required' => 'كلمة المرور مطلوبه',
            'password.confirmed' => 'كلمة المرور يجب ان تكون متطابقه',
            'gender.required' => 'الجنس مطلوب',
            'gender.in' => 'الجنس يجب ان يكون ذكرا او انثي'
        ];

        $this->validate($request, $rules, $messages);

        $request->merge(['password' => bcrypt('password')]);
        $records = Client::create($request->all());
        flash()->success('تم الاضافة بنجاح');
        return redirect(route('clients.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $model = Client::findOrFail($id);
        return view($this->mainRetrun . 'edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:clients,email,'. $id,
            'password' => 'confirmed',
            'gender' => 'in:male,female'
        ];
        $messages = [
            'name.max' => 'الاسم لا يجب ان يتخطي 55 حرف',
            'email.unique' => 'قيمة البريدالالكتروني مستخدمه من قبل',
            'email.email' => 'البريدالالكتروني يجب ان يكون ايميل',
            'password.confirmed' => 'كلمة المرور يجب ان تكون متطابقه',
            'gender.in' => 'الجنس يجب ان يكون ذكرا او انثي'
        ];

        $this->validate($request, $rules, $messages);

        $record = Client::findOrFail($id);

        $record->update($request->all());
        $record->save();

        if ($record) {
            flash()->success('تم التعديل بنجاح');
            return redirect(route('clients.index'));
        }
        flash()->error('حدث خطأ برجاء المحاوله مره اخري');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Client::findOrFail($id);
            $record->delete();
            flash()->success('تم الحذف بنجاح');
            return back();
    }

    public function changePassword(Request $request)
    {
        $user = Client::findOrFail($request->user_id);
        $user->password = bcrypt($request->password);
        $user->save();
        flash()->success('تم تعديل كلمة المرور بنجاح');
        return back();
    }

    public function filter(Request $request)
    {
        $records = Client::where(function ($query) use($request){
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
        })->paginate(20);
        return view($this->mainRetrun. 'index', compact('records'));
    }




}
