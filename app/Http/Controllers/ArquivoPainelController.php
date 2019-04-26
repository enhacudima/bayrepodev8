<?php
namespace App\Http\Controllers;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Charts\ArquivoCharts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Auth;
use App\User;
use App\ArquivoMaster;
use Carbon\Carbon;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class ArquivoPainelController extends Controller

{




        public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:arquivomaster-dashboard');
    }

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */



          public function arquipainel(){LogActivity::addToLog('ArquivoMaster - Painel');
          $date=Carbon::now();
          $userlevel = (!Auth::guest()) ? Auth::user()->level : null ;//user_level
          $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id

          $porarquivarin=DB::table('client_details')
                              ->count();

         $totalarquivado=ArquivoMaster::where('apoliceseguro','!=','0')
                  ->count();                   

          $referencias=ArquivoMaster::whereYear('arquivomaster.updated_at','=',$date->format('Y'))
                              ->whereMonth('arquivomaster.updated_at','=',$date->format('m'))
                              ->where('apoliceseguro','=','0')
                              ->count();

          $arquivo=ArquivoMaster::whereYear('arquivomaster.updated_at','=',$date->format('Y'))
                              ->whereMonth('arquivomaster.updated_at','=',$date->format('m'))
                              ->where('apoliceseguro','!=','0')
                              ->count();

          $porarquivar=   $porarquivarin-$totalarquivado;               


          $datareferencias=ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                              ->whereYear('arquivomaster.updated_at','=',$date->format('Y'))
                              ->whereMonth('arquivomaster.updated_at','=',$date->format('m'))
                              ->where('apoliceseguro','=','0')
                              ->select('arquivomaster.*','users.name')
                              ->orderby('updated_at')
                              ->get()
                              ->groupBy('name')
                              ->map(function ($item) {
                                  // Return the number of persons
                                  return count($item);
                              });

          $datareferencias=ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                              ->whereYear('arquivomaster.updated_at','=',$date->format('Y'))
                              ->whereMonth('arquivomaster.updated_at','=',$date->format('m'))
                              ->where('apoliceseguro','=','0')
                              ->select('arquivomaster.*','users.name')
                              ->orderby('updated_at')
                              ->get()
                              ->groupBy('name')
                              ->map(function ($item) {
                                  // Return the number of persons with that age
                                  return count($item);
                              });
          $dataarquivo=ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                              ->whereYear('arquivomaster.updated_at','=',$date->format('Y'))
                              ->whereMonth('arquivomaster.updated_at','=',$date->format('m'))
                              ->where('apoliceseguro','!=','0')
                              ->select('arquivomaster.*','users.name')
                              ->orderby('updated_at')
                              ->get()
                              ->groupBy('name')
                              ->map(function ($item) {
                                  // Return the number of persons with that age
                                  return count($item);
                              });

            $arquivoglobal=ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                                ->whereYear('arquivomaster.updated_at','=',$date->format('Y'))
                                ->whereMonth('arquivomaster.updated_at','=',$date->format('m'))
                                //->where('apoliceseguro','!=','0')
                                ->select('arquivomaster.*','users.name')
                                ->orderby('updated_at')
                                ->get()
                                ->groupBy('name')
                                ->map(function ($item) {
                                    // Return the number of persons with that age
                                    return count($item);
                                });
            //user graf
           $datareferenciasuser=ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                    ->whereYear('arquivomaster.updated_at','=',$date->format('Y'))
                    ->whereMonth('arquivomaster.updated_at','=',$date->format('m'))
                    ->where('apoliceseguro','=','0')
                    ->where('arquivomaster.idusuario','=',$userid)
                    ->select('arquivomaster.*','users.name')
                    ->orderby('updated_at')
                    ->get()
                    ->groupBy(DB::raw("DAY(arquivomaster.updated_at)"))
                    ->map(function ($item) {
                        // Return the number of persons with that age
                        return count($item);
                    }); 

          $dataarquivouser=ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                    ->whereYear('arquivomaster.updated_at','=',$date->format('Y'))
                    ->whereMonth('arquivomaster.updated_at','=',$date->format('m'))
                    ->where('apoliceseguro','!=','0')
                    ->where('arquivomaster.idusuario','=',$userid)
                    ->select('arquivomaster.*','users.name')
                    ->orderby('updated_at')
                    ->get()
                    ->groupby(DB::raw("DAY(arquivomaster.updated_at)"))
                    ->map(function ($item) {
                        // Return the number of persons with that age
                        return count($item);
                    });


           //user graf 

                             

            /*  $data = User::get()
              ->groupBy('level')
              ->map(function ($item) {
                  // Return the number of persons with that age
                  return count($item);
              });*/

          $chart = new ArquivoCharts;
          $chart->labels($datareferencias->keys());
          $chart->title('Atividades por Usuario Referencias');
          $chart->dataset('Nome', 'bar', $datareferencias->values())->options([
              'color' => '#ff0000',
          ]);;


          $chart1 = new ArquivoCharts;
          $chart1->labels($dataarquivo->keys());
          $chart1->title('Atividades por Usuario Arquivado');
          $chart1->dataset('Nome', 'bar', $dataarquivo->values());


          $chart2 = new ArquivoCharts;
          $chart2->labels($arquivoglobal->keys());
          $chart2->title('Atividades por Usuario Master');
          $chart2->dataset('Nome', 'pie', $arquivoglobal->values())->options([
              'color' => [
            '#1A237E', '#3F51B5', '#7986CB',
          ],
          ]);

          $chart3 = new ArquivoCharts;
          $chart3->labels($datareferenciasuser->keys());
          $chart3->title('Atividades por Usuario ');
          $chart3->dataset('Nome', 'bar', $dataarquivouser->values());
          $chart3->dataset('Nome', 'bar', $datareferenciasuser->values())->options([
              'color' => '#ff0000',
          ]);



            return view('arquivo_todos.arquivoPainel', compact('chart','chart1','chart2','chart3','porarquivar','referencias','arquivo'));
            //return view('arquivoPainel', ['chart' => $chart]);
           }
}
