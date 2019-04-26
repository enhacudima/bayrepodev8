<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Selecionaidex;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\User;
use App\Nib;
use App\Funcionario;
use App\Recibos;
use App\Provincia;
use App\Agencia;
use Hash;
use Auth;
use PDF;
use Dompdf\Dompdf;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RecibosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:recibos-view');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function seleciona()
    {   LogActivity::addToLog('Recibos-index');
            $provincia = DB::table('province')
            ->orderby('name')
            ->get();

            $recibo = DB::table('payroll')
            ->select('period')
            ->distinct()
            ->orderby('period')
            ->get();




        return view('recibos_todos.selecionaidex',compact(['provincia','recibo']));
    }


    public function index( $value1,$value2)

        {    LogActivity::addToLog('Recibos - Full table');

    $recibo = Cache::remember('reciboakey1',0.0166666667, function() use ($value1,$value2) {


        return DB::table('payroll')
            ->where('branch','=',$value1)
            ->Where('period', '=', $value2)
            ->orderby('agentName')
            ->get();
});



    $recibo= Cache::get('reciboakey1');



        return view('recibos_todos.recibos',compact(['recibo']));

    }



    public function downloadPDF($id){
         LogActivity::addToLog('Recibos - Simple pdf');
      $today = $dayOfWeek = today();

      $recibo =Recibos::find($id);

      $pdf = PDF::loadView('recibos_todos.recibosPdf', compact('recibo','today'));

      return $pdf->download($recibo->agentName.'-'.$recibo->period.'-'.'recibo.pdf');

    }


public function grupdownloadPDF($value1,$value2)

{    LogActivity::addToLog('Recibos-Group pdf');
    $today = $dayOfWeek = today();

    $recibo = Cache::remember('reciboakey2',0.0166666667, function() use ($value1,$value2) {


        return DB::table('payroll')
            ->where('branch','=',$value1)
            ->Where('period', '=', $value2)
            ->orderby('agentName')
            ->get();
});



      $recibo= Cache::get('reciboakey2');

      $data['recibo']=$recibo->toArray();
      $pdf = PDF::loadView('recibos_todos.recibosPdfGroup', compact('recibo','today'));
      return $pdf->download($value1.'-'.$value2.'-'.'recibo.pdf');


}





public function search(Request $request)

{

if($request->ajax())

{

$output="";




$products = Cache::remember('agenciakey',0.0166666667, function() use ($request) {


    return DB::table('agencia')
            ->where('fk_province','=',$request->search)
            ->select('outletSyncNameCorrected')
            ->distinct()
            ->orderby('outletSyncNameCorrected','asc')
            ->get();
});



$products = Cache::get('agenciakey');


if($products)

{

foreach ($products as $key => $product) {

$output.='<option value="'.$product->outletSyncNameCorrected.'">' .$product->outletSyncNameCorrected.'</option>';


}



return Response($output);



   }



   }



}




}
