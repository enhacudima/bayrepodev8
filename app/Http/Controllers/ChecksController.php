<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Check;
use App\BlackList;
use App\Pep;
use DB;
use Session;
use Excel;
use File;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class ChecksController extends Controller
{   

    public $identificador_de_bulk;

                function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:blacklists-checks-view', ['only' => ['index','show',]]);
         $this->middleware('permission:blacklists-checks-create', ['only' => ['create','store']]);
         $this->middleware('permission:blacklists-checks-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:blacklists-checks-delete', ['only' => ['destroy']]);
         $this->middleware('permission:blacklists-checks-uploud', ['only' => ['download','upload']]);



    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    {   LogActivity::addToLog('Blacklist - chacks show');
        //$checks= Check::orderBy('identificador_de_bulk','desc')->paginate(5);

        $checks= Check::leftjoin('users','checks.userid','users.id')
                        ->select('checks.*','users.name','users.lname')
                        ->orderBy('checks.identificador_de_bulk','desc')
                        //->take(1)
                        ->get();
        //$checks=DB::table('checks_view')->paginate(5);
       



        return view ('blacklist.checks.index')->with('checks',$checks);
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

    public function upload(Request $request){
        LogActivity::addToLog('Blacklist - chacks upload');

        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));

        
 
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
 
                $path = $request->file->getRealPath();
                
                        //Identificador de Bulk
                $this->identificador_de_bulk='Upload'.'_'.time();
   
                Excel::filter('chunk')->load($path)->chunk(100, function($reader)  {

                            foreach($reader as $kay => $value)
                            {

                                $request = new Request([
                                    'date_of_birth' => $value->date_of_birth,
                                    'employee_number' => $value->employee_number,
                                    'id_number' => $value->id_number,
                                    'account_number' => $value->account_number,
                                    'mobile_number' => $value->mobile_number,
                                    'surname' => $value->surname,
                                ]);
            
                                $this->validate($request,[
            
                                    'date_of_birth'=>'required|date|date_format:Y-m-d|before:today',
                                    'employee_number'=> 'required|min:9|max:9',
                                    'id_number'=> 'required',
                                    'account_number'=>'required|min:21|max:21',
                                    'surname'=>'required',
                                    'mobile_number'=>'required|min:9',
                        
                                ]);
                            }


                        foreach($reader as $kay => $value)
                        {


                            $employee_number=BlackList::where('employee_number',$value->employee_number)->first();
                            if($employee_number==null){
                                $employee_number_verification =null;
                            }
                            else{
                                $employee_number_verification="Black Listed";
                            }

                            $id_number=BlackList::where('id_number',$value->id_number)->first();
                            if($id_number==null){
                                $id_number_verification =null;
                            }
                            else{
                                $id_number_verification="Black Listed";
                            }

                            $account_number=BlackList::where('account_number',$value->account_number)->first();
                            if($account_number==null){
                                $account_number_verification =null;
                            }
                            else{
                                $account_number_verification="Black Listed";
                            }

                            $mobile_number=BlackList::where('mobile_number',$value->mobile_number)->first();
                            if($mobile_number==null){
                                $mobile_number_verification =null;
                            }
                            else{
                                $mobile_number_verification="Black Listed";
                            }
                            $pep=Pep::where('dob',$value->date_of_birth)
                                                ->where('last_name',$value->surname)
                                                ->first();

                            if($pep==null){
                                $pep_verification =null;
                            }
                            else{
                                $pep_verification="PEP";
                            }

                             $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id


                       

                            


                            $insert[] = [
                                'identificador_de_bulk' => $this->identificador_de_bulk,
                                'employee_number' => $value->employee_number,
                                'loan_id' => $value->loan_id,
                                'data' => $value->data,
                                'first_name' => $value->first_name,
                                'employer_type' => $value->employer_type,
                                'id_number' => $value->id_number,
                                'mobile_number' => $value->mobile_number,
                                'account_number' => $value->account_number,
                                'surname' => $value->surname,
                                'date_of_birth' => $value->date_of_birth,
                                'employee_number_verification' => $employee_number_verification,
                                'id_number_verification' => $id_number_verification,
                                'mobile_number_verification' => $mobile_number_verification,
                                'account_number_verification' => $account_number_verification,
                                'pep_verification' => $pep_verification,
                                'userid'=>$userid,
                                ];
    
                        }
    
                        if(!empty($insert)){
 
                            $insertData = Check::insert($insert);
                            if ($insertData) {
                                Session::flash('success', 'Your Data has successfully imported');
                            }else {                        
                                Session::flash('error', 'Error inserting the data..');
                                return back();
                            }
                        }
    
    
                    });    

 


 
                return back();
 
            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }//close file
    
        

    }

    public function download ($identificador_de_bulk){
        LogActivity::addToLog('Blacklist chacks download');

        $checks= Check::where('identificador_de_bulk',$identificador_de_bulk)
                        ->select('id','identificador_de_bulk','employee_number','id_number','mobile_number','account_number','surname','date_of_birth',
                        'employee_number_verification','id_number_verification','mobile_number_verification','account_number_verification','pep_verification')
                        ->get();

                
                Excel::create($identificador_de_bulk,function($excel) use($checks){

            $excel->sheet('Sheet 1',function($sheet) use($checks){
                $sheet->fromArray($checks);
                $sheet->setColumnFormat(array('F'=>'@'));
                $sheet->protect('MISteam2018');
            });           

        })->export('xlsx');



    }
}
