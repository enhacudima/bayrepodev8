<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reclamacoes;
use Illuminate\Support\Facades\Storage;
use PDF;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Http\Requests\EditarEstadoRequest;
use App\ModeloEditarEstado;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\ReclaaprovacaoRequest;
use App\Provincia;
use App\Agencia;
use App\Helpers\LogActivity;


class ReclamacoesController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createStep1(Request $request)
    {
        $product = $request->session()->get('product');
        return view('ticket_suport.formstep1',compact('product', $product));
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function createStep0()
     {
             $provincia = DB::table('province')
             ->orderby('name')
             ->get();

         return view('ticket_suport.formstep1',compact(['provincia']));
     }

     public function postCreateStep0(Request $request)
     {
     $validatedData = $request->validate([
         'province' =>'required|max:255|string',
         'agencia' =>'required|max:255',

     ]);


         if(empty($request->session()->get('product'))){
             $product = new Reclamacoes;
             $product->fill($validatedData);
             $request->session()->put('product', $product);
         }else{
             $product = $request->session()->get('product');
             $product->fill($validatedData);
             $request->session()->put('product', $product);
         }

         return redirect('/create-step1');

     }




     public function search(Request $request)

     {

     if($request->ajax())

     {

     $output="";




     $products = Cache::remember('agenciakey',0.0166666667, function() use ($request) {


         return DB::table('agencia')
                 ->where('fk_province','=',$request->search)
                 ->select('outletSyncNameCorrected','id_agencia')
                 ->distinct()
                 ->orderby('outletSyncNameCorrected','asc')
                 ->get();
     });



     $products = Cache::get('agenciakey');


     if($products)

     {

     foreach ($products as $key => $product) {

     $output.='<option value="'.$product->id_agencia.'">' .$product->outletSyncNameCorrected.'</option>';


     }



     return Response($output);



        }



        }



     }



    public function postCreateStep1(Request $request)
    {

        $validatedData = $request->validate([
            'loanid' => 'exists:client_details|min:12|max:255',
            'description' => 'required|min:3|max:255',
            'tipodecliente' => 'required|',
            'nuit' =>'min:9|max:9',
            'nome' =>'min:3|max:255|string',
            'entidade' =>'min:3|max:255|string',
            'documentodeidentificacao' =>'string',
            'numerododocumento' =>'min:3|max:255|string',
            'emitidoem' =>'min:3|max:255|string',
            'provinciade' =>'min:3|max:255|string',
            'datadeemissao' =>'string',
            'nomedobanco' =>'min:1|max:255|string',
            'nib' =>'min:12|max:255|string',
            'titulardaconta' =>'min:3|max:255|string',

        ]);

            $product = $request->session()->get('product');
            $product->fill($validatedData);
            $request->session()->put('product', $product);


        return redirect('/create-step2');

    }

    public function createStep2(Request $request)
    {
        $product = $request->session()->get('product');
        return view('reclamacao2',compact('product', $product));
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep2(Request $request)
    {
        $product = $request->session()->get('product');
        if(!isset($product->productImg)) {
            $request->validate([
                'productimg' => 'required|mimes:pdf|max:10000',
            ]);

            $fileName = "productImage-" . time() . '.' . request()->productimg->getClientOriginalExtension();

            $request->productimg->storeAs('productimg', $fileName);



            $product = $request->session()->get('product');

            $product->productImg = $fileName;
            $request->session()->put('product', $product);
        }
        //Capturando detalhes do Cliente na Tabela client_details
        $loanid=$product->loanid;
        $detalhe=DB::table('client_details')
                    ->where('loanid','=',$loanid)
                    ->limit(1)
                    ->get();
        foreach ($detalhe as $key => $detalhes){
        $product = $request->session()->get('product');

        $ClientFirstNames=$detalhes->ClientFirstNames;
        $ClientSurname=$detalhes->ClientSurname;
        $LoanTerm=$detalhes->LoanTerm;
        $LoanAmount=$detalhes->LoanAmount;
        $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id

        $product->ClientFirstNames=$ClientFirstNames;
        $product->ClientSurname=$ClientSurname;
        $product->LoanTerm=$LoanTerm;
        $product->LoanAmount=$LoanAmount;
        $product->userid=$userid;

        $request->session()->put('product', $product);


            return redirect('/create-step3');


        }

    }

    /**
     * Show the Product Review page
     *
     * @return \Illuminate\Http\Response
     */
    public function removeImage(Request $request)
    {
        $product = $request->session()->get('product');
        $imagem=$product->productImg;
        Storage::delete('/productimg/'.$imagem);

        $product->productImg = null;
        return view('reclamacao2',compact('product', $product));
    }


    public function createStep3(Request $request)
    {
        $product = $request->session()->get('product');
        $agencia=Agencia::where('id_agencia',$product->agencia)->get();
        $provincia=Provincia::where('province_id',$product->province)->get();

        return view('reclamacao3',compact('product',$product,'agencia',$agencia,'provincia',$provincia));
    }



    /**
     * Store product
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $request->session()->get('product');
        $product->save();
        Session::flash('success', 'Solicitação de '.$product->ClientFirstNames.' submetida com sucesso');
        session()->forget('product');
        return redirect('/create-step0');
    }

    public function todas ()
    {
        //$reclamacoes=Reclamacoes::all();
        $reclamacoes = Reclamacoes::join('users','reclamacoes.userid','=','users.id')
            ->select('reclamacoes.*','users.name')
            ->orderby('created_at')
            ->get();
        return view('ticket_suport.index',compact('reclamacoes',$reclamacoes));
    }
    public function complet_tickes ()
    {
        //$reclamacoes=Reclamacoes::all();
        $reclamacoes = Reclamacoes::join('users','reclamacoes.userid','=','users.id')
            ->select('reclamacoes.*','users.name')
            ->orderby('created_at')
            ->get();
        return view('ticket_suport.complet',compact('reclamacoes',$reclamacoes));
    }






    public function aprovacao ()
    {
        //$reclamacoes=Reclamacoes::all();
        $reclamacoes = Reclamacoes::where('reclamacoes.status','=','3')
            ->join('users','reclamacoes.userid','=','users.id')
            ->select('reclamacoes.*','users.name')
            ->orderby('created_at')
            ->get();
        return view('reclaaprovacao',compact('reclamacoes',$reclamacoes));
    }

    public function financas ()
    {
        //$reclamacoes=Reclamacoes::all();
        $reclamacoes = Reclamacoes::whereBetween('reclamacoes.status',[5,6])
            ->join('users','reclamacoes.userid','=','users.id')
            ->select('reclamacoes.*','users.name')
            ->orderby('created_at')
            ->get();
        return view('reclafinancas',compact('reclamacoes',$reclamacoes));
    }

    public function gravaralteracao (EditarEstadoRequest $request)
    {
        $data=$request->all();

        $save=ModeloEditarEstado::create($data);

        Reclamacoes::where('id',$data['idsolicitacao'])

            ->update(['status'=>$data['novoestado']]);


        Session::flash('success', 'Editado com sucesso');
        return back();
    }

    public function gravaraprovacao (ReclaaprovacaoRequest $request)
    {
        $data=$request->all();

        $save=ModeloEditarEstado::create($data);


        Reclamacoes::where('id',$data['idsolicitacao'])

            ->update(['status'=>$data['novoestado']]);





        Session::flash('success', 'Editado com sucesso');
        return back();
    }
//ver detalhes
    public function detalhes(Request $request)

    {

        if($request->ajax())

        {

            $output="";



            $products = DB::table('edicaodeestado')
                    ->where('edicaodeestado.idsolicitacao','=',$request->detalhes)
                    ->join('users','edicaodeestado.idusuario','=','users.id')
                    ->select('edicaodeestado.*','users.name')
                    ->orderby('created_at')
                    ->get();


            if($products)


            {

                foreach ($products as $key => $product) {

                    $output.='<div class="container1">'.
                    '<span class="time-left"><strong><i class="fa fa-user-circle fa-2x" aria-hidden="true"></i> '.$product->name.'</strong></span>'.
                    '<hr>'.
                    '<p class="name">'.$product->comentarios.'</p>'.
                    '<span class="time-right">'.$product->created_at.'</span>'.
                  '</div>';


                }

                return Response($output);


            }



        }
    }

    public function searchcabecalho(Request $request)

    {

        if($request->ajax())

        {

            $output="";


            $products = DB::table('ticke_todas')
                    ->where('ticke_todas.id','=',$request->searchcabecalho)
                    ->join('users','ticke_todas.userid','=','users.id')
                    ->select('ticke_todas.*','users.name')
                    ->orderby('created_at')
                    ->get();




                foreach ($products as $key => $product) {


                $output.='<div class="container1 darker">'.
                    '<span class="time-left"><strong>Número do Contrato:</strong> '.$product->loanid.' &nbsp  | &nbsp  <strong>NUIT:</strong>'.$product->nuit.' &nbsp  | &nbsp  <strong>Tipo de Cliente:</strong>'.$product->tipodecliente.'</strong></span>'.
                    '<hr>'.
                    '<p class="name"><strong>Nome:</strong> '.$product->ClientFirstNames.' '.$product->ClientSurname.'</p>'.
                    '<p class="name"><strong>Documento de Identificação:</strong> '.$product->numerododocumento.'</p>'.
                    '<p class="name"><strong>Entidade:</strong> '.$product->entidade.'</p>'.
                    '<p class="name"><strong>NIB:</strong> '.$product->nib.'</p>'.
                    '<p class="name"><strong>Titular da conta:</strong> '.$product->titulardaconta.'</p>'.
                    '<p class="name"><strong>Descrição:</strong> '.$product->description.'</p>'.
                    '<p class="name"><strong>Montante Desembolsado:</strong> '.number_format($product->LoanAmount,2,',',' ').'</p>'.
                    '<p class="name"><strong>Período:<strong> '.$product->LoanTerm.' Meses'.'</p>'.
                    '<span class="time-right"><strong>Criado por'.':</strong> '.$product->name.' '.$product->created_at.'</span>'.
                  '</div>';



                }
             return Response($output);
        }
    }


}
