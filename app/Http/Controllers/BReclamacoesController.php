<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reclamacoes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use PDF;
use Response;
use App\PaymentPlan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Http\Requests\EditarEstadoRequest;
use App\ModeloEditarEstado;
use Illuminate\Support\Facades\Cache;
use App\Provincia;
use App\Agencia;
use App\Helpers\LogActivity;

class BReclamacoesController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createStep1B(Request $request)
    {
        $product = $request->session()->get('product');
        return view('reclamacao',compact('product', $product));
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep1B(Request $request)
    {

        $validatedData = $request->validate([
            'tipodecliente' => 'required|',
            'nuit' =>'required|min:9|max:9',
            'nome' =>'min:3|max:255|string',
            'entidade' =>'min:3|max:255|string',
            'documentodeidentificacao' =>'string',
            'numerododocumento' =>'min:3|max:255|string',
            'emitidoem' =>'min:3|max:255|string',
            'provinciade' =>'min:3|max:255|string',
            'datadeemissao' =>'required|string',
            'nomedobanco' =>'min:1|max:255|string',
            'nib' =>'min:12|max:255|string',
            'titulardaconta' =>'min:3|max:255|string',
            'description' => 'required|min:3|max:255',

        ]);


            $product = $request->session()->get('product');
            $product->fill($validatedData);
            $request->session()->put('product', $product);


        return redirect('/create-step2B');

    }



    public function createStep2B(Request $request)
    {
        $product = $request->session()->get('product');
        return view('reclamacao2B',compact('product', $product));
    }


    public function postCreateStep2B(Request $request)
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
            $product = $request->session()->get('product');
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
            $product->userid=$userid;
            $request->session()->put('product', $product);

            return redirect('/create-step3B');

    }


    public function removeImage(Request $request)
    {
        $product = $request->session()->get('product');
        $imagem=$product->productImg;
        Storage::delete('/productimg/'.$imagem);

        $product->productImg = null;
        return view('reclamacao2B',compact('product', $product));
    }


    public function createStep3B(Request $request)
    {
        $product = $request->session()->get('product');
        $agencia=Agencia::where('id_agencia',$product->agencia)->get();
        $provincia=Provincia::where('province_id',$product->province)->get();

        return view('reclamacao3B',compact('product',$product,'agencia',$agencia,'provincia',$provincia));
    }

}
