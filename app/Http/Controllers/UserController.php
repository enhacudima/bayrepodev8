<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use App\LogActivity;
use Carbon\Carbon;
use App\Helpers\LogActivity as LogActivit;
use Spatie\Permission\Models\Permission;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\jobs\SendReminderEmail;

class UserController extends Controller
{


        function __construct()
    {
         $this->middleware('permission:user-profile', ['only' => ['showprofile']]);
         $this->middleware('permission:user-list');
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
         
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(300);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $citys = DB::table('province')
            ->orderby('name')
            ->get();
        return view('users.create',compact('roles','citys'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:confirm-password',
            'roles' => 'required',
            'city'=>'required',
            'branch'=>'required',
            'lname'=>'required|string|min:3|max:100',
            'username'=>'required|string|min:3|max:100|unique:users,username',
            'title'=>'required|string|min:3|max:100',
        ]);


        $input = $request->all();
        $posts=$request->all();
        $input['password'] = Hash::make($input['password']);


            $user = User::create($input);
            $user->assignRole($request->input('roles'));

        //dispatch(new SendReminderEmail($posts));
        Mail::to($posts['email'])->send(new WelcomeMail($posts));

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::leftjoin('province','users.city','province.province_id')
                ->leftjoin('agencia','users.branch','agencia.id_agencia')
                ->select('users.*','province.name as city','agencia.outletSyncNameCorrected as branch')
                ->find($id);

        $logs = LogActivity:: where('log_activities.user_id',$id)->orderby('log_activities.updated_at','DESC')
                ->join('users','log_activities.user_id','=','users.id')
                ->select('log_activities.*','users.name','users.lname','users.level')
                ->paginate(5);

        return view('users.show',compact('user','logs'));
    }

    public function showprofile()
    {

        $id = (!Auth::guest()) ? Auth::user()->id : null ;//user_id

        $user = User::leftjoin('province','users.city','province.province_id')
                ->leftjoin('agencia','users.branch','agencia.id_agencia')
                ->select('users.*','province.name as city','agencia.outletSyncNameCorrected as branch')
                ->find($id);

        return view('users.userprofile',compact('user'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $citys = DB::table('province')
            ->orderby('name')
            ->get();


        return view('users.edit',compact('user','roles','userRole','citys'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   LogActivit::addToLog('Admin-update usuario'.$id);
        $this->validate($request, [
            'name' => 'required',
            'lname'=>'required|string|min:3|max:100',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);


        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}