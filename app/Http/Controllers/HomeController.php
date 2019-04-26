<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use App\User;
use App\Nib;
use App\Funcionario;
use Hash;
use Auth;
use App\Token;
use Session;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\UpdateConfirmacaoRequest;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use App\Charts\ArquivoCharts;
use App\LogActivity as LogActivityModel;
use App\TicketTodas;






class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:home-only');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   LogActivity::addToLog('Home - My Page');
        


        //return view('home');
         // aqui configuramos o seu telefone
         $userphone = (!Auth::guest()) ? Auth::user()->phone : null ;//user_phone
         $user_id = (!Auth::guest()) ? Auth::user()->id : null ;//user_phone
         $user_branch = (!Auth::guest()) ? Auth::user()->branch : null ;//user_phone

         if ($userphone) {

            $logs = LogActivityModel::orderby('log_activities.updated_at','DESC')
                ->where('log_activities.user_id',$user_id)
                ->leftjoin('users','log_activities.user_id','=','users.id')
                ->select('log_activities.*','users.name','users.lname','users.level')
                ->get();

            $login=  LogActivityModel::orderby('log_activities.updated_at','DESC')
                    ->where('log_activities.subject',"Acesso-Login")
                    ->where('log_activities.user_id',$user_id)
                    ->leftjoin('users','log_activities.user_id','=','users.id')
                    ->select('log_activities.*','users.name','users.lname','users.level')
                    ->count();
            $logout=  LogActivityModel::orderby('log_activities.updated_at','DESC')
                    ->where('log_activities.subject',"Acesso-Logout")
                    ->where('log_activities.user_id',$user_id)
                    ->leftjoin('users','log_activities.user_id','=','users.id')
                    ->select('log_activities.*','users.name','users.lname','users.level')
                    ->count();
             $branchmenbers=User::where('branch',$user_branch)->count(); 

             $last5activity= LogActivityModel::orderby('log_activities.updated_at','DESC')->where('log_activities.user_id',$user_id)->take(11)->get(); 

             $last5saves= LogActivityModel::orderby('log_activities.updated_at','DESC')->where('log_activities.user_id',$user_id)->where('log_activities.subject','like','%'."save".'%')->take(5)->get(); 
  

            $totallogs=$logs->count();

            $reclamacoes = TicketTodas::where('ticke_todas.userid',$user_id)
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get()->take(4);



            return view('home',compact('logs','totallogs','login','logout','branchmenbers','last5activity','last5saves','reclamacoes'));
         }else{
            return redirect('updatephone');
         }
        


        //return view('settings');
    }

//validacao do contacto
        public function enviarsmsphone(Request $request){
              LogActivity::addToLog('Admin - Configuration phone');

            $validatedData = $request->validate([
            'phone' => 'required|unique:users',
            ]);
            $pnumber=$validatedData['phone'];
            $useremail = (!Auth::guest()) ? Auth::user()->email : null ;//user_phone
            $token=str_random(6);
             
            //create a new token to be sent to the user. 
            Token::updateOrCreate(

            ['email'=>$useremail],
            [
                'email' => $useremail,
                'token' => $token, //change 60 to any length you want
                
            ]);

   
                // Configure client
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU1Mjk5NTk0OCwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY5MDY3LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.NuZQGGd8CoCRyTNgsth8yAgbASnxUgFmFnyrChHSFfg');
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        // Sending a SMS Message

        $sendMessageRequest2 = new SendMessageRequest([
            'phoneNumber' => $pnumber,
            'message' =>'Receba o codigo de confirmacao para configuracao do seu telemovel '.$token,
            'deviceId' => 110202
        ]);
        $sendMessages = $messageClient->sendMessages([
                $sendMessageRequest2
        ]);

        $respons=print_r($sendMessages);
        Session::flash('success', 'Introduza o codigo de confirmação de 6 digitos enviado para: *****'.substr ($pnumber, -4));
        return view('auth.confirmupdatephone')->with(
            ['token' => $token, 'email' => $useremail,'pnumber'=>$pnumber]
        );

    }

 public function confirmupdatephone(UpdateConfirmacaoRequest $request){
      LogActivity::addToLog('Admin - validate phone');
            $data=$request->all();
            
       
        $token=$data['tokens'];
        
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $dadostoken="";
        $tokenData = DB::table('tokens')
         ->where('token', $token)->first();

         $dadostoken=$tokenData;
        
        if ($dadostoken!="") {
           
                        $user = User::where('email', $tokenData->email)->update(['phone' => $request->pnumber]);

                        // If the user shouldn't reuse the token later, delete the token
                        DB::table('tokens')->where('email', $request->email)->delete();
                        return redirect('home');

        }else{
            
            Session::flash('error', 'Chave de confirmação errada!!');
            return view('auth.confirmupdatephone')->with(
            ['token' => $request->token, 'email' => $request->email,'pnumber'=>$request->pnumber]
        );

        }
 }   


 public function search(Request $request)
    {   LogActivity::addToLog('QA - Search');
       

        $posts = Cache::remember('cachekey777',0.0166666667, function() use ($request) {


           return  $posts=$this->dadospost($request);




        });

        $posts = Cache::get('cachekey777');




        return response()->json($posts);
    }

    public function dadospost(Request $request){

        $posts= Funcionario::where('nuit','LIKE','%'.$request->keywords."%")
            ->limit(10)
            ->orderby('nuit','asc')
            ->get();

        return $posts;
    }


}
