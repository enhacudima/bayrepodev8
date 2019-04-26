<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pep;
use DB;
use Session;
use Excel;
use File;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PepsController extends Controller
{   
                    function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:blacklists-peps-view', ['only' => ['index','show',]]);
         $this->middleware('permission:blacklists-peps-create', ['only' => ['create','store']]);
         $this->middleware('permission:blacklists-peps-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:blacklists-peps-delete', ['only' => ['destroy']]);
         $this->middleware('permission:blacklists-peps-uploud', ['only' => ['import','checkFormat']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   LogActivity::addToLog('Blacklist - peps index');

        $peps= Pep::orderBy('created_at','desc')->get();
        return view ('blacklist.peps.index')->with('peps',$peps);
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
    {   LogActivity::addToLog('Blacklist - peps show');

        $peps= Pep::orderBy('created_at','desc')->get();
        return view ('blacklist.peps.index')->with('peps',$peps);
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

    public function import(Request $request){
        LogActivity::addToLog('Blacklist - peps import');
        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));

        
 
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

                //Limpar a BD
                $delete=DB::delete('delete from peps');
 
                $path = $request->file->getRealPath();
    
                Excel::filter('chunk')->load($path)->chunk(999, function($reader)  {


                        foreach($reader as $kay => $value)
                        {
                            //save in database or do whatever you like here
                            //$userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id

                            $value->dob=$this->checkFormat($value->dob);
                            $value->dobs=$this->checkFormat($value->dobs);
                            $value->deceased=$this->checkFormat($value->deceased);
                            $value->entered=$this->checkFormat($value->entered);
                            $value->updated=$this->checkFormat($value->updated);
                            $value->editor=$this->checkFormat($value->editor);
                            $value->age_date_as_of_date=$this->checkFormat($value->age_date_as_of_date);

                            //dd($value->deceased);

                            $insert[] = [
                                'uid' => $value->uid,
                                'last_name' => $value->last_name,
                                'first_name' => $value->first_name,
                                'aliases' => $value->aliases,
                                'alternative_spelling' => $value->alternative_spelling,
                                'category' => $value->category,
                                'title' => $value->title,
                                'sub_category' => $value->sub_category,
                                'position' => $value->position,
                                'age' => $value->age,
                                'dob' => $value->dob,
                                'dobs' => $value->dobs,
                                'place_of_birth' => $value->place_of_birth,
                                'deceased' => $value->deceased,
                                'passports' => $value->passports,
                                'ssn' => $value->ssn,
                                'identification_numbers' => $value->identification_numbers,
                                'locations' => $value->locations,
                                'countries' => $value->countries,
                                'citizenship' => $value->citizenship,
                                'companies' => $value->companies,
                                'e_i' => $value->e_i,
                                'linked_to' => $value->linked_to,
                                'further_information' => $value->further_information,
                                'keywords' => $value->keywords,
                                'external_sources' => $value->external_sources,
                                'entered' => $value->entered,
                                'updated' => $value->updated,
                                'editor' => $value->editor,
                                'age_date_as_of_date' => $value->age_date_as_of_date,
                                ];
    
                        }
    
                        if(!empty($insert)){
 
                            $insertData = Pep::insert($insert);
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
    }//close function

    public function checkFormat($date)
    {
        if($date!=date('Y/m/d',strtotime($date)))
                            { 
                                $date=null;
                            }
                            return $date;                    
                            
    }
}//close class
