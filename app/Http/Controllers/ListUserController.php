<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EdituserRequest;
use App\Http\Requests\LeveluserRequest;
use App\Http\Requests\EditpasswordRequest;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Nib;
use App\Funcionario;
use Hash;
use Auth;
use Session;
use App\Leveluser;
use Illuminate\Support\Facades\Cache;
use App\Helpers\LogActivity;

class ListUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $user;
    public function __construct(user $user)
    {
        $this->middleware('auth');
        $this->user=$user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
    {   LogActivity::addToLog('Admin - Lista de usuarios activos ');
            $users = DB::table('users')
            ->where('status',1)
            ->join('leveluser','users.level','=','leveluser.id')
            ->select('users.*','leveluser.discricao')
            ->orderby('name')

            ->get();

    
        return view('ListUser',compact(['users']));

        //return view('settings');
    }


            public function indexdelete()
    {   LogActivity::addToLog('Admin - lista de usuarios delectados');
            $users = DB::table('users')
            ->where('status',0)
            ->join('leveluser','users.level','=','leveluser.id')
            ->select('users.*','leveluser.discricao')
            ->orderby('name')
            ->get();

    
        return view('ListUserDelete',compact(['users']));

        //return view('settings');
    }

    public function edituser($id){
     LogActivity::addToLog('Admin - Editar usuario'.$id);
      $users =User::find($id);

      $nivel = DB::table('leveluser')  
            ->orderby('discricao')
            ->get();

      
      return view('auth.edituser',compact(['users','nivel']));

    }

    public function editpassword($id){
        LogActivity::addToLog('Admin - Editar password usuario'.$id);
      $users =User::find($id);

      $nivel = DB::table('leveluser')  
            ->orderby('discricao')
            ->get();


      return view('auth.editpassword',compact(['users','nivel']));

    }





    protected function update($id,EdituserRequest $request)
    {  LogActivity::addToLog('Admin - update usuario'.$id);
        
        $user=User::findOrFail($id);
        $input=([
            'name' => $request['name'],
            'email' => $request['email'],
            'level'=>$request['level'],
            'id'=>$request['id'],
            'phone'=>$request['phone'],
        ]);

        $user->fill($input)->save();



    Session::flash('flash_message', 'Usuario Atualizado com sucesso');

    return redirect()->back();
    }

        protected function updatepassword($id,EditpasswordRequest $request)
    {  LogActivity::addToLog('Admin - find usuario'.$id);
        
        $user=User::findOrFail($id);
        $input=([
            'password' => Hash::make($request['password']),
        ]);

        $user->fill($input)->save();



    Session::flash('flash_message', 'Password atualizado com sucesso');

    return redirect()->back();
    }


    public function deleteuser($id){
      LogActivity::addToLog('Admin - Delete usuario'.$id);

    $users = DB::table('users')
            ->where('id','=',$id)
            ->update(['status'=>0]);     
      
    Session::flash('flash_message', 'Usuario apagado com sucesso');

    return redirect()->back();

    }


    
    public function activeuser($id){
    LogActivity::addToLog('Admin - Active user'.$id);    

    $users = DB::table('users')
            ->where('id','=',$id)
            ->update(['status'=>1]);     
      
    Session::flash('flash_message', 'Usuario restaurado com sucesso');

    return redirect()->back();

    }

        public function showChangePasswordForm(){
    return view('auth.changepassword');
    }

    public function changePassword(Request $request){
    LogActivity::addToLog('Admin - changePassword usuario');
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
 
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
 
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
 
        return redirect()->back()->with("success","Password changed successfully !");
 
    }
 

 
     public function leveluser(){


      $nivel = DB::table('leveluser')  
            ->orderby('discricao')
            ->get();       

     
      
      return view('auth.leveluser',compact(['nivel']));

    }

         public function editleveluser(LeveluserRequest $request){
            LogActivity::addToLog('Admin - Edit level user form');
            $data=$request;

          $leveluser = Leveluser::updateOrCreate(

          ['id'=>$data['id']],

          [
            'discricao' => $data['discricao'],
            'detalhes' => $data['detalhes'],
           'fk_user_id' => $data['fk_user_id']

         ]);


   
          Session::flash('flash_message', 'Nivel atualizado com sucesso');

    return redirect()->back();

    }

        public function saveleveluser(LeveluserRequest $request)
    {    LogActivity::addToLog('Admin-Save level user');  
        $data=$request->all();
        $save=Leveluser::Create($data);
        Session::flash('success', 'Sucess');
        return back();
    }   


    public function registra(){
         LogActivity::addToLog('Admin-Route register');  
      $nivel = DB::table('leveluser')  
            ->orderby('discricao')
            ->get();

      
      return view('auth.register',compact(['nivel']));

    }


    public function searchbranch(Request $request)
        {
            if($request->ajax())
                {
                $output="";
                $branch = Cache::remember('agenciakey',0.0166666667, function() use ($request) {
                return DB::table('agencia')
                        ->where('fk_province','=',$request->searchbranch)
                        ->select('outletSyncNameCorrected','id_agencia')
                        ->orderby('outletSyncNameCorrected','asc')
                        ->distinct('outletSyncNameCorrected')
                        ->get();
                        });

                $branche = Cache::get('agenciakey');


            if($branch)
            {
        foreach ($branch as $key => $cil) {         
            $output.='<option value="'.$cil->id_agencia.'">' .$cil->outletSyncNameCorrected.'</option>';
            }

    return Response($output);
       }
       }
    }



 
   }
