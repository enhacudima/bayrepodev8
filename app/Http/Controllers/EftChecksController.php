<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eft;
use App\Nib;
use DB;
use Session;
use Excel;
use File;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class EftChecksController extends Controller
{   
                function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:eft-eft-view', ['only' => ['index','show',]]);
         $this->middleware('permission:eft-eft-create', ['only' => ['create','store']]);
         $this->middleware('permission:eft-eft-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:eft-eft-delete', ['only' => ['destroy']]);
         $this->middleware('permission:eft-eft-uploud', ['only' => ['download','upload']]);

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
    {   LogActivity::addToLog('Eft - show');

       $eft= Eft::leftjoin('users','eft.userid','users.id')
                        ->select('eft.*','users.name','users.lname')
                        ->orderBy('eft.identificador_de_bulk','desc')
                        ->get();


        return view ('eft_todos.index',compact('eft'));
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
        LogActivity::addToLog('Eft - upload');

        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));

        
 
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
 
                $path = $request->file->getRealPath();
                //dd(1);
                
   
                Excel::filter('chunk')->load($path)->chunk(500, function($reader)  {


                            foreach($reader as $kay => $value)
                            {

                                $request = new Request([
                                    'clientidnumber' => $value->clientidnumber,
                                    'accountnumber' => $value->accountnumber,
                                ]);
                                    

                                $this->validate($request,[
            
                                    'clientidnumber'=>'required',
                                    'accountnumber'=>'required',
                        
                                ]);
                            }

                                 //Identificador de Bulk
                            $identificador_de_bulk='Upload'.'_'.time();

                        foreach($reader as $kay => $value)
                        {
                            $data=$this->removeplica($value->accountnumber);
                            $lendata=strlen($data);

                            $eft0=Nib::where('NUIT',$value->clientidnumber)
                                                ->first();  

                            $eft=Nib::where('NUIT',$value->clientidnumber)
                                                ->where('NIB',$data)
                                                ->first();
                                             
                  
                            if($eft0==null) {
                                  $verificacao="Impossivel verificar, cliente nao existente na base de dados";
                            }elseif($eft==null){
                                $verificacao ="Nib errado";
                            }
                            else{
                                $verificacao="Nib correcto";
                            }


                             $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id


                       

                            


                            $insert[] = [
                                'identificador_de_bulk' => $identificador_de_bulk,
                                'userid'=>$userid,
                                'verificacao' => $verificacao,
                                'lendata'=>$lendata,
                                'paymentid' => $value->paymentestaid,
                                'loanid' => $value->loanid,
                                'clientidnumber' => $value->clientidnumber,
                                'bankname' => $value->bankname,
                                'bankcode' => $value->bankcode,
                                'branchname' => $value->branchname,
                                'branchcode' => $value->branchcode,
                                'accountholder' => $value->accountholder,
                                'accountnumber' => $value->accountnumber,
                                'accounttype' => $value->accounttype,
                                'amount' => $value->amount,
                                'term' => $value->term,
                                'workflowstate' => $value->workflowstate,
                                'observacoes' => $value->observacoes,
                                'division_paypoint' => $value->division_paypoint,
                                'balcao' => $value->balcao,
                                'codigo_organico' => $value->codigo_organico,
                                ];
    
                        }
    
                        if(!empty($insert)){
 
                            $insertData = Eft::insert($insert);
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

    public function removeplica($var)
    {   $data=ltrim($var, "'");
        return $data;
    }

    public function download ($identificador_de_bulk){
        LogActivity::addToLog('Eft - download');

        $eft= Eft::where('identificador_de_bulk',$identificador_de_bulk)
                        ->select('identificador_de_bulk','paymentid','loanid','clientidnumber','bankname',
                        'bankcode','branchname','branchcode','accountholder','accountnumber','accounttype','amount','term','workflowstate','observacoes','division_paypoint','balcao','codigo_organico','verificacao','lendata')
                        ->get();

                
            Excel::create($identificador_de_bulk,function($excel) use($eft){

            $excel->sheet('Sheet 1',function($sheet) use($eft){
                $sheet->fromArray($eft);
                $sheet->setColumnFormat(array('F'=>'@'));
                $sheet->protect('MISteam2018');
            });           

        })->export('xlsx');



    }
}
