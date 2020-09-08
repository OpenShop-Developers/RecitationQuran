<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @var string
     */
    private $mainRetrun;

    public function __construct()
    {
        $this->mainRetrun = 'dashboard.roles.';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $records = Role::all();
        return view($this->mainRetrun . 'index', compact('records'));
        //
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
//     */
    public function create()
    {
        return view($this->mainRetrun . 'create');
    }

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param \Illuminate\Http\Request $request
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
    public function store(Request $request)
    {

        $rules = [

            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'permissions_list' => 'required|array',
        ];
        $messages = [

            'name.required' => 'الاسم مطلوب',
            'display_name.required' => 'الاسم المعروض مطلوب',
            'name.unique' => 'قيمة الاسم مستخدمه من قبل',
            'permissions_list.required' => 'مجموعة الصلاحيات مطلوبه',
            'permissions_list.array' => 'مجموعة الصلاحيات يجب ان تكون مصفوفه',

        ];

        $this->validate($request, $rules, $messages);
        $records = Role::create($request->all());
        $records->permissions()->attach($request->permissions_list);
        flash()->success('تم اضافة الرتبه بنجاح');
        return redirect(route('roles.index'));

    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param int $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }
//
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param int $id
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
    public function edit($id)
    {
        $model = Role::findOrFail($id);
        return view($this->mainRetrun . 'edit', compact('model'));
    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param \Illuminate\Http\Request $request
//     * @param int $id
//     * @return \Illuminate\Http\Response
//     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|unique:roles,name,'.$id,
            'display_name' => 'required',
            'permissions_list' => 'required|array',
        ];
        $messages = [

            'name.required' => 'الاسم مطلوب',
            'display_name.required' => 'الاسم المعروض مطلوب',
            'name.unique' => 'قيمة الاسم مستخدمه من قبل',
            'permissions_list.required' => 'مجموعة الصلاحيات مطلوبه',
            'permissions_list.array' => 'مجموعة الصلاحيات يجب ان تكون مصفوفه',
        ];

        $this->validate($request, $rules, $messages);
        $record = Role::findOrFail($id);
        $record->update($request->all());
        $record->permissions()->sync($request->permissions_list);

        if ($record) {
            flash()->success('تم التعديل بنجاح');
            return back();
        }
        flash()->error('حدث خطأ برجاء المحاوله مره اخري');
        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Role::findOrFail($id);
        $record->delete();
        flash()->success('تم الحذف بنجاح');
        return back();

    }
}
