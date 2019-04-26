<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlackList;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class BranchsController extends Controller
{

            function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:blacklists-branchs-view', ['only' => ['index','show','search']]);
         $this->middleware('permission:blacklists-branchs-create', ['only' => ['create','store']]);
         $this->middleware('permission:blacklists-branchs-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:blacklists-branchs-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { LogActivity::addToLog('Blacklist - Branches index');

        return view ('blacklist.branchs.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request){
        LogActivity::addToLog('Blacklist - Branches search'.$request->search);
        
        $data= BlackList::where('employee_number','like','%'.$request->search.'%')
                          ->orWhere('account_number','like','%'.$request->search.'%')
                          ->orWhere('mobile_number','like','%'.$request->search.'%') 
                          ->orWhere('id_number','like','%'.$request->search.'%')->limit(5)->get();

                          if($data)

                          {
              
                              foreach ($data as $key => $data) {
              
                                  $data.='<tr>'.
                                      '<td>'.$data->first_name.'</td>'.
                                      '<td>'.$data->surname.'</td>'.
                                      '<td>'.$data->date_of_birth.'</td>'.
                                      '<td>'.$data->employee_number.'</td>'.
                                      '<td>'.$data->created_at.'</td>'.
                                      '</tr>';

                              }
                        }
              


        return Response($data);

    }
}
