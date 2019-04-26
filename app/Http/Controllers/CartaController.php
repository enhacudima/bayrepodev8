<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Reclamacoes;
use App\ModeloCarta;
use Response;
use Session;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\CartaRequest;
use Hash;
use Auth;
use PDF;
use Dompdf\Dompdf;
use Carbon\Carbon;
use App\Helpers\LogActivity;


class CartaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function carta(CartaRequest $request){
    	$data=$request->all();

    	$save=ModeloCarta::create($data);

    	    Reclamacoes::where('id',$data['idsolicitacaocarta'])

            ->update(['status'=>8]);

        Session::flash('success', 'Carta gerada com sucesso');

        return back();
    }

    public function pdf($id){
    	$today = $dayOfWeek = today()->format('d/m/Y');

    	$data=Reclamacoes::where('reclamacoes.id',$id)
            ->join('agencia','reclamacoes.agencia','=','agencia.id_agencia')
            ->join('province','reclamacoes.province','=','province.province_id')
            ->join('cartas_reclamacao','reclamacoes.id','=','cartas_reclamacao.idsolicitacaocarta')
            ->select('reclamacoes.*','agencia.outletSyncNameCorrected','province.name','cartas_reclamacao.comentarios')
            ->first();
      $create =$data->created_at ->format('d/m/Y');

            //dd($data);


            //$data['data']=$data->toArray();
    	$pdf = PDF::loadView('cartaPdf', compact('today',$today,'data',$data,'create',$create));

      return $pdf->download($data->ClientFirstNames.'-'.$today.'-'.'carta.pdf');;

    }
}
