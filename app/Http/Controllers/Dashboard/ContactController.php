<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @var string
     */
    private $mainRetrun;

    public function __construct()
    {
        $this->mainRetrun = 'dashboard.contacts.';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $records = Contact::paginate(20);
        return view($this->mainRetrun . 'index', compact('records'));
        //
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
//     */
//    public function create()
//    {
//        return view($this->mainRetrun . 'create');
//    }

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param \Illuminate\Http\Request $request
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function store(Request $request)
//    {
//        $rules = [
//
//            'name' => 'required|max:255',
//            'email' => 'required|email|unique:clients',
//            'password' => 'required|confirmed',
//            'gender' => 'required|in:male,female'
//        ];
//        $messages = [
//
//            'name.required' => 'الاسم مطلوب',
//            'name.max' => 'الاسم لا يجب ان يتخطي 55 حرف',
//            'email.required' => 'البريدالالكتروني مطلوب',
//            'email.unique' => 'قيمة البريدالالكتروني مستخدمه من قبل',
//            'email.email' => 'البريدالالكتروني يجب ان يكون ايميل',
//            'password.required' => 'كلمة المرور مطلوبه',
//            'password.confirmed' => 'كلمة المرور يجب ان تكون متطابقه',
//            'gender.required' => 'الجنس مطلوب',
//            'gender.in' => 'الجنس يجب ان يكون ذكرا او انثي'
//
//        ];
//
//        $this->validate($request, $rules, $messages);
//
//        $request->merge(['password' => bcrypt('password')]);
//        $records = Contact::create($request->all());
//        flash()->success('تم الاضافة بنجاح');
//        return redirect(route('clients.index'));
//
//    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        //
//    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {



        $model = Contact::findOrFail($id);

        if ($model->user_id != auth()->user()->id)
        {
            abort(403);
        }
        $model->fill(['is_read' => 1])->save();
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
            'message_reply' => 'required',
        ];
        $messages = [
            'message_reply.required' => 'الرساله مطلوبه'
        ];

        $this->validate($request, $rules, $messages);

        $record = Contact::findOrFail($id);

        $record->update($request->all());
        $record->save();

        $client = Client::where('id', $record->client_id)->first();

        $notification = $client->notifications()->create([
            'title'     => 'لديك اشعار جديد',
            'content'   => 'لقد قام المحفظ بالرد علي رسالتك'
        ]);

        $token = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();

        if (count($token))
        {
            $title      = $notification->title;
            $body       = $notification->contentl;
            $data       = [
                'client_id' => $client->id
            ];

            $send = fcm_send($token, $body, $title, $data);
            info("firebase result :" . $send);
//                    dd($send);
        }


        if ($record) {
            flash()->success('تم التعديل بنجاح');
            return redirect(route('contacts.index'));
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
        $record = Contact::findOrFail($id);
        $record->delete();
        flash()->success('تم الحذف بنجاح');
        return back();
    }

    public function filter(Request $request)
    {
        $records = Contact::where(function ($query) use($request){
            if ($request->input('from') && $request->input('to'))
            {
                if($request->input('to') >= $request->input('from')){
                    $query->whereBetween('created_at', [$request->input('from'), $request->input('to')]);
                }
                if($request->input('to') <= $request->input('from')){
                    $query->whereBetween('created_at', [$request->input('to'), $request->input('from')]);
                }
            }
            if ($request->input('client_id'))
            {
                $query->where('client_id',$request->client_id);
            }
            if ($request->input('user_id'))
            {
                $query->where('user_id',$request->user_id);
            }
        })->paginate(20);
        return view($this->mainRetrun. 'index', compact('records'));
    }
}
