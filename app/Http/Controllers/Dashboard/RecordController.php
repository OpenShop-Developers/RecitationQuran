<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * @var string
     */
    private $mainRetrun;

    public function __construct()
    {
        $this->mainRetrun = 'dashboard.records.';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $records = Record::paginate(10);
        return view($this->mainRetrun . 'index', compact('records'));
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Record::findOrFail($id);

        $record->delete();
        flash()->success('تم الحذف بنجاح');
        return back();

    }

    public function filter(Request $request)
    {
        $records = Record::where(function ($query) use($request){
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
