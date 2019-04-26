<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use App\TicketTodas;
use DB;
use Carbon\Carbon;
use App\Charts\ArquivoCharts;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;
use Charts;
use App\User;
use App\Helpers\LogActivity;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class TicketChartController extends Controller
{
        function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:myticket-admin', ['only' => ['getLaraChart']]);
    }

    public function getLaraChart()
    {	      LogActivity::addToLog('Myticket - Dashboard');

    	$reclamacoes = TicketTodas::where('ticke_todas.status','=','1')
            ->join('ticket_team_time','ticke_todas.id','=','ticket_team_time.idsolicitacao')
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get();
      $committicket=$reclamacoes->count();

    	$acteticket = TicketTodas::where('status','=','1')
            ->count();

      $completticket = TicketTodas::where('status','!=','1')
            ->count();

      
//**performace by day
		$lava = new Lavacharts; // See note below for Laravel

		$finances = $lava->DataTable();

		$data = TicketTodas::
            where('ticke_todas.status','=','1')
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select(DB::raw('date_format(ticke_todas.created_at, "%Y-%m-%d") as "0"'),DB::raw('count(*) as "1"'))
            ->groupBy('0')
            ->get()->toArray();





//dd($data);
		$finances->addDateColumn('Data')
				 ->addNumberColumn('Tickets')
		         //->setDateTimeFormat('Y')
		         ->addRows($data);

		$lava->ColumnChart('Finances', $finances, [
		    'title' => 'Performace do Tickets',
		    'titleTextStyle' => [
		        'color'    => '#eb6b2c',
		        'fontSize' => 14
		    ]
		]);

//**performace by category
		$categorydata = TicketTodas:: join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get()
            ->groupBy('tiposolicitacao')
            ->map(function ($item) {
                  // Return the number of persons
                  return count($item);
              });
            
//dd($categorydata);

          $category = new ArquivoCharts;
          $category->labels($categorydata->keys());
          $category->title('Por Categoria');
          $category->dataset('Nome', 'pie', $categorydata->values())->options([
              'color' => [
            '#f5b7b1', '#d2b4de', '#85c1e9','#DAF7A6','#FFC300','#FF5733','#ebdef0','#f5b7b1',
          ],
          ]);

//**performace by subcategory
		$subcategorydata = TicketTodas:: join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get()
            ->groupBy('subcategory')
            ->map(function ($item) {
                  // Return the number of persons
                  return count($item);
              });
            
//dd($categorydata);

          $subcategory = new ArquivoCharts;
          $subcategory->labels($subcategorydata->keys());
          $subcategory->title('Por Sub-Categoria');
          $subcategory->dataset('total', 'pie', $subcategorydata->values())->options([
              'color' => [
            '#85c1e9', '#DAF7A6', '#FFC300','#FF5733','#C70039','#900C3F','#d2b4de','#85c1e9','#DAF7A6','#FFC300','#FF5733','#C70039',
          ],
          ]);          



//**performace by subcategoryday
		$subcategorydaydataactive = TicketTodas:: join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select(DB::raw('date_format(ticke_todas.created_at, "%Y-%m") as "date"'),'ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->where('ticke_todas.status','!=','1')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get()
            ->groupBy('date')
            ->map(function ($item) {
                  // Return the number of persons
                  return count($item);
              });

            $subcategorydaydata = TicketTodas:: join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select(DB::raw('date_format(ticke_todas.created_at, "%Y-%m") as "date"'),'ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get()
            ->groupBy('date')
            ->map(function ($item) {
                  // Return the number of persons
                  return count($item);
              });
            
//dd($subcategorydaydata);

          $subcategoryday = new ArquivoCharts;
          $subcategoryday->labels($subcategorydaydata->keys());
          $subcategoryday->title('Ativos & fechados / Mês');
          $subcategoryday->dataset('Fechados', 'line', $subcategorydaydataactive->values());
          $subcategoryday->dataset('Activos', 'line', $subcategorydaydata->values());






          $bybranch = TicketTodas:: join('users','ticke_todas.userid','=','users.id')
          ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
          ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
          ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
          ->select('agencia.outletSyncNameCorrected')
          ->distinct('ticket_team_time.idsolicitacao')
          ->get()
          ->groupBy('outletSyncNameCorrected')
          ->map(function ($item) {
                // Return the number of persons
                return count($item);
            });
            

//dd($subcategorydaydata);

          $subcategorybybranch= new ArquivoCharts;
          $subcategorybybranch->labels($bybranch->keys());
          $subcategorybybranch->title('Ativos & fechados / Balcão');
          $subcategorybybranch->dataset('Activos', 'bar', $subcategorydaydata->values()); 
          $subcategorybybranch->dataset('Fechados', 'line', $subcategorydaydataactive->values());
                   




        return  view('ticket_suport.chart.chart',compact('lava','acteticket','completticket','committicket','category','subcategory','subcategoryday','subcategorybybranch'));
    }


}