<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\TicketTodas;
use DB;
use Carbon\Carbon;
use App\Charts\ArquivoCharts;
use Charts;
use App\User;
use App\Helpers\LogActivity;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;



class TicketReportController extends Controller
{
        function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:myticket-admin', ['only' => ['index','filter']]);
    }

   Public function index()
   {
        LogActivity::addToLog('Myticket- Index Report');
        //declaracao de variaveis 
         $date=Carbon::now();//agora 




         $reclamacoes = TicketTodas::whereYear('ticke_todas.updated_at','=',$date->format('Y'))
            ->whereMonth('ticke_todas.updated_at','=',$date->format('m'))
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->leftjoin('province','agencia.fk_province','=','province.province_id')
            ->select('ticke_todas.*','users.name','users.lname','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory','province.name as province')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->limit(5000)
            ->get();


      $data = TicketTodas::whereYear('ticke_todas.updated_at','=',$date->format('Y'))
            ->whereMonth('ticke_todas.updated_at','=',$date->format('m'))
            ->join('ticket_team_time','ticke_todas.id','=','ticket_team_time.idsolicitacao')
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get();  

        $committicket=$data->count();
            
        $acteticket = TicketTodas::where('status','=','1')
            ->whereYear('ticke_todas.updated_at','=',$date->format('Y'))
            ->whereMonth('ticke_todas.updated_at','=',$date->format('m'))
            ->count();

        $completticket = TicketTodas::where('status','!=','1')
            ->whereYear('ticke_todas.updated_at','=',$date->format('Y'))
            ->whereMonth('ticke_todas.updated_at','=',$date->format('m'))
            ->count();

        return view('ticket_suport.report.report',compact('reclamacoes','acteticket','completticket','committicket'));   
   }

   Public function filter(Request $request)
   {  LogActivity::addToLog('Myticket- Index Report filter');
          $inicio=Carbon::parse($request->inicio);
          $fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
          $radio=$request->radio;
          $userlevel = (!Auth::guest()) ? Auth::user()->level : null ;//user_level
          $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id


          if ($radio=='criacao') {
                  
      $reclamacoes = TicketTodas::whereBetween('ticke_todas.created_at',[$inicio,$fim])
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','users.lname','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->limit(5000)
            ->get();


      $data = TicketTodas::whereBetween('ticke_todas.created_at',[$inicio,$fim])
            ->join('ticket_team_time','ticke_todas.id','=','ticket_team_time.idsolicitacao')
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get();  

        $committicket=$data->count();
            
        $acteticket = TicketTodas::where('status','=','1')
            ->whereBetween('ticke_todas.created_at',[$inicio,$fim])
            ->count();

        $completticket = TicketTodas::where('status','!=','1')
            ->whereBetween('ticke_todas.created_at',[$inicio,$fim])
            ->count();

        return view('ticket_suport.report.report',compact('reclamacoes','acteticket','completticket','committicket'));   

            }else if ($radio=='atualizacao') {

      $reclamacoes = TicketTodas::whereBetween('ticke_todas.updated_at',[$inicio,$fim])
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','users.lname','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->limit(5000)
            ->get();


      $data = TicketTodas::whereBetween('ticke_todas.updated_at',[$inicio,$fim])
            ->join('ticket_team_time','ticke_todas.id','=','ticket_team_time.idsolicitacao')
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get();  

        $committicket=$data->count();
            
        $acteticket = TicketTodas::where('status','=','1')
            ->whereBetween('ticke_todas.updated_at',[$inicio,$fim])
            ->count();

        $completticket = TicketTodas::where('status','!=','1')
            ->whereBetween('ticke_todas.updated_at',[$inicio,$fim])
            ->count();

        return back()->compact('reclamacoes','acteticket','completticket','committicket');  

            }



   }


}