<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlackList;
use DB;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class BlackListsController extends Controller
{

        function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:blacklists-view', ['only' => ['index','show']]);
         $this->middleware('permission:blacklists-create', ['only' => ['create','store']]);
         $this->middleware('permission:blacklists-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:blacklists-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { LogActivity::addToLog('BlackList - view');

        $blacklists= BlackList::orderBy('created_at','desc')->get();
        return view ('blacklist.blacklists.index')->with('blacklists',$blacklists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  LogActivity::addToLog('BlackList create');
        return view ('blacklist.blacklists.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  LogActivity::addToLog('BlackList - Save create');

        $this->validate($request,[

            'employee_number'=>'required|unique:black_lists|min:9',
            'account_number'=>'required|unique:black_lists',
            'mobile_number'=>'required|unique:black_lists|min:9|max:9',
            'id_number'=>'required|unique:black_lists',

        ]);
        
       
        $blacklist=new BlackList;
        
        $blacklist->reference=$request->input('reference');
        $blacklist->employee_number=$request->input('employee_number');
        $blacklist->account_number=$request->input('account_number');
        $blacklist->mobile_number=$request->input('mobile_number');
        $blacklist->world_check_reference=$request->input('world_check_reference');
        $blacklist->id_number=$request->input('id_number');
        $blacklist->first_name=$request->input('first_name');
        $blacklist->surname=$request->input('surname');
        $blacklist->date_of_birth=$request->input('date_of_birth');
        $blacklist->employer_type=$request->input('employer_type');
        $blacklist->notes=$request->input('notes');
        $blacklist->world_check_uid=$request->input('world_check_uid');
        $blacklist->category=$request->input('category');
        $blacklist->title=$request->input('title');
        $blacklist->sub_category=$request->input('sub_category');
        $blacklist->position=$request->input('position');
        $blacklist->further_information_wc=$request->input('further_information_wc');
        $blacklist->userid=$request->input('userid');
        $blacklist->save();

        return redirect ('/blacklists')->with('success','Successfully Added to List');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {  LogActivity::addToLog('BlackList - view');
        return view ('blacklist.blacklists.add');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  LogActivity::addToLog('BlackList - edit');
        $blacklist = BlackList:: find($id);
        
        return view ('blacklist.blacklists.edit')->with('blacklist',$blacklist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {    LogActivity::addToLog('BlackList - update');
        $this->validate($request,[

            'employee_number'=>'required||min:9',
            'account_number'=>'required',
            'mobile_number'=>'required|min:9|max:9',
            'id_number'=>'required',

        ]);
        
       
        $blacklist=BlackList::find($id);
        
        $blacklist->reference=$request->input('reference');
        $blacklist->employee_number=$request->input('employee_number');
        $blacklist->account_number=$request->input('account_number');
        $blacklist->mobile_number=$request->input('mobile_number');
        $blacklist->world_check_reference=$request->input('world_check_reference');
        $blacklist->id_number=$request->input('id_number');
        $blacklist->first_name=$request->input('first_name');
        $blacklist->surname=$request->input('surname');
        $blacklist->date_of_birth=$request->input('date_of_birth');
        $blacklist->employer_type=$request->input('employer_type');
        $blacklist->notes=$request->input('notes');
        $blacklist->world_check_uid=$request->input('world_check_uid');
        $blacklist->category=$request->input('category');
        $blacklist->title=$request->input('title');
        $blacklist->sub_category=$request->input('sub_category');
        $blacklist->position=$request->input('position');
        $blacklist->further_information_wc=$request->input('further_information_wc');

        $blacklist->save();

        return redirect ('/blacklists')->with('success','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  LogActivity::addToLog('BlackList - delete');
        $blacklist=BlackList::find($id);

        $blacklist->delete();

        return redirect ('/blacklists')->with('success','Successfully Deleted');
    }
}
