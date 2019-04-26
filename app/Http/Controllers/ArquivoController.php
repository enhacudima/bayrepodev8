<?php

namespace App\Http\Controllers;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Requests\ArquivoPrincipalRequest;
use App\Http\Requests\ArquivoReferenciasRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Hash;
use Session;
use Auth;
use App\PaymentPlan;
use Carbon\Carbon;
use App\ArquivoMaster;
use Excel;
use File;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class ArquivoController extends Controller
{
    // Criar Construtor

    function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:arquivomaster-view', ['only' => ['arquivosearchinformation','arquivosearchformulario','arquivosearchnfom','arquivomaster','arquivoreferencias','arquivopaineitest']]);
         $this->middleware('permission:arquivomaster-save', ['only' => ['arquivogravar','arquivoreferencia']]);
         $this->middleware('permission:arquivomaster-report', ['only' => ['arquivoreportindexreport','arquivofiltroreport']]);

    }


    public  function arquivomaster()
    {
      return View('arquivo_todos.arquivoPrincipal');
    }

    public function arquivoreferencias(){
      return View('arquivo_todos.arquivoReferencias');
    }

    public function arquivopaineitest(){
      return View('arquivo_todos.arquivoPainel');
    }


    public function arquivosearchinformation(Request $request)

    { LogActivity::addToLog('ArquivoMaster - Search Information '.$request->arquivosearchinformation);

        if($request->ajax())

        {

            $output="";

            $products = Cache::remember('cachekeyarquivo1',0.0166666667, function() use ($request) {


                return DB::table('client_details')
                    ->where('LoanID','=',$request->arquivosearchinformation)
                    ->get();
            });

            $products = Cache::get('cachekeyarquivo1');


            if($products)

            {

                foreach ($products as $key => $product) {

                    $output.='<tr>'.
                        '<td>'.'<strong>'.'Número do Contrato: '.'</strong>'.'</td>'.
                        '<td>'.$product->LoanID.'</td>'.
                        '</tr>';

                    $output.='<tr>'.
                        '<td>'.'<strong>'.'Nome do Cliente: '.'</strong>'.'</td>'.
                        '<td>'.$product->ClientFirstNames.' '.$product->ClientSurname.'</td>'.
                        '</tr>';

                    $output.='<tr>'.
                        '<td>'.'<strong>'.'Montante Desembolsado: '.'</strong>'.'</td>'.
                        '<td>'.number_format($product->LoanAmount,2,',',' ').'</td>'.
                        '</tr>';

                    $output.='<tr>'.
                        '<td>'.'<strong>'.'Período: '.'</strong>'.'</td>'.
                        '<td>'.$product->LoanTerm.' Meses'.'</td>'.
                        '</tr>';
                  $output.='<tr>'.
                      '<td>'.'<strong>'.'Data de Desembolso: '.'</strong>'.'</td>'.
                      '<td>'.$product->LoanCreationTimeStamp.'</td>'.
                      '</tr>';
                      //novos campos
                  $output.='<tr>'.
                      '<td>'.'<strong>'.'Provincia: '.'</strong>'.'</td>'.
                      '<td>'.$product->PostalAddressRegion.'</td>'.
                      '</tr>';

                  $output.='<tr>'.
                      '<td>'.'<strong>'.'Genero: '.'</strong>'.'</td>'.
                      '<td>'.$product->ClientGender.'</td>'.
                      '</tr>';

                  $output.='<tr>'.
                      '<td>'.'<strong>'.'Data de Nascimento: '.'</strong>'.'</td>'.
                      '<td>'.$product->ClientDateOfBirth.'</td>'.
                      '</tr>';

                  $output.='<tr>'.
                      '<td>'.'<strong>'.'Número do Documento: '.'</strong>'.'</td>'.
                      '<td>'.$product->ClientPassportNumber.'</td>'.
                      '</tr>';

                  $output.='<tr>'.
                      '<td>'.'<strong>'.'Email: '.'</strong>'.'</td>'.
                      '<td>'.$product->ClientEmail.'</td>'.
                      '</tr>';

                  $output.='<tr>'.
                      '<td>'.'<strong>'.'Balcão: '.'</strong>'.'</td>'.
                      '<td>'.$product->OutletSyncName.'</td>'.
                      '</tr>';
                  $output.='<tr>'.
                      '<td>'.'<strong>'.'Data de Criação: '.'</strong>'.'</td>'.
                      '<td>'.$product->LoanCreationTimeStamp.'</td>'.
                      '</tr>';    



                    return Response($output);



                }




            }



        }
    }



    public function arquivogravar(ArquivoPrincipalRequest $request)

    {LogActivity::addToLog('ArquivoMaster - Save');

      if($request->ajax())
      {
        $data=$request->all();

        //$save=ArquivoMaster::create($data);
        $save = ArquivoMaster::updateOrCreate(

        ['loanid'=>$data['loanid']],

        $data);
        $id=$save->id;//last id after create

         //actualizando a referencia 
        $datalone=DB::table('client_details')
                    ->where('LoanID','=',$data['loanid'])
                    ->first();
        $datalone=$datalone->LoanCreationTimeStamp;
        $datalone=new Carbon($datalone);
        $datalone=$datalone->format('m.Y-'.$id);

        $referencia=$datalone;

        ArquivoMaster::where('LoanID','=',$data['loanid'])
                     ->update (

        ['referencia'=>$referencia]
      ); 

        return response()->json(['success'=>'Os seus dados foram gravados com sucesso! Com a seguinte Referência: '.$referencia]);
      }
    }

      public function arquivoreferencia(ArquivoReferenciasRequest $request)

      {LogActivity::addToLog('ArquivoMaster - Save Referencia');
        if($request->ajax())
        {
          $data=$request->all();

          $save=ArquivoMaster::create($data);
          $id=$save->id;//last id after create

                   //actualizando a referencia 
        $datalone=DB::table('client_details')
                    ->where('LoanID','=',$data['loanid'])
                    ->first();
        $datalone=$datalone->LoanCreationTimeStamp;
        $datalone=new Carbon($datalone);
        $datalone=$datalone->format('m.Y-'.$id);

        $referencia=$datalone;

        ArquivoMaster::where('LoanID','=',$data['loanid'])
                     ->update (

        ['referencia'=>$referencia]
        ); 



          return response()->json(['success'=>'Referencia Gerada com sucesso! Com a seguinte Referência: '.$referencia]);
        }


    }


        public function arquivosearchformulario(Request $request)

        {LogActivity::addToLog('ArquivoMaster - Open Formulario');

                $output= ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                        ->where('arquivomaster.loanid','=',$request->arquivosearchformulario)
                        ->select('arquivomaster.*','users.name')
                        ->first();


                        return  response()->json([
                          'data' => $output
                      ], 200);

        }
        public function arquivosearchnfom(Request $request)

        {LogActivity::addToLog('ArquivoMaster-Search Formulario');

                $output= ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                        ->where('arquivomaster.nform','=',$request->arquivosearchnfom)
                        ->select('arquivomaster.*','users.name')
                        ->first();


                        return  response()->json([
                          'data' => $output
                      ], 200);

        }

        public function arquivoreportindexreport()
        {LogActivity::addToLog('ArquivoMaster - Report Export');
          $date=Carbon::now();
          $userlevel = (!Auth::guest()) ? Auth::user()->level : null ;//user_level
          $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id



          if ( Auth::user()->can('arquivomaster-user')) {
          $data=ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                              ->where('arquivomaster.idusuario','=',$userid)
                              ->whereYear('arquivomaster.updated_at','=',$date->format('Y'))
                              ->whereMonth('arquivomaster.updated_at','=',$date->format('m'))
                              ->select('arquivomaster.*','users.name')
                              ->orderby('updated_at')
                              ->simplepaginate(5000);
                              //->get();

          return view('arquivo_todos.aruivoindexreport',compact(['data']));
          }else
          {

          $data=ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                              ->whereYear('arquivomaster.updated_at','=',$date->format('Y'))
                              ->whereMonth('arquivomaster.updated_at','=',$date->format('m'))
                              ->select('arquivomaster.*','users.name')
                              ->orderby('updated_at')
                              ->simplepaginate(5000);
                              //->get();

          return view('arquivo_todos.aruivoindexreport',compact(['data']));
          }

        }

        public function arquivofiltroreport(Request $request)
        {LogActivity::addToLog('ArquivoMaster-Filtre Report');
          $inicio=Carbon::parse($request->inicio);
          $fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
          $radio=$request->radio;
          $radio2=$request->radio2;
          $userlevel = (!Auth::guest()) ? Auth::user()->level : null ;//user_level
          $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
          $username=(!Auth::guest()) ? Auth::user()->name : null ;//user_name

          //dd($inicio);
          //obter o excel dos dados filtrados 
          if ($radio2=='excel') {
            //levando dados do modelo
            if ($radio=='criacao') {
              $dataexcel = ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                                ->join('client_details','arquivomaster.loanid','=','client_details.loanID')
                                ->whereBetween('arquivomaster.created_at',[$inicio,$fim])
                                ->select('arquivomaster.*','users.name','client_details.ClientFirstNames','client_details.ClientSurname')
                                ->orderby('created_at');

              Excel::create('Report-'.time(), function($excel) use ($dataexcel) {
                  $excel->sheet('report', function($sheet) use($dataexcel) {
                      $sheet->appendRow(array(
                          'Referênciacriacao','loanid','Nome do cliente','Apelido do cliente', 'Número do formulario',  'Apolice de seguro',  'Nuit', 'Bi', 'Localização do ficheiro','Folha de salario', 'Arquivado em',  'Provimento',  'Status', 'Observação', 'Número de paginas', 'Usuario',  'Extrato',  'Nib',  'Declaração de salario', 'Outros','Atualizado em:','Criado em:','LoanCreationTimeStamp',
                      ));
                      $dataexcel->chunk(1000, function($rows) use ($sheet)
                      {
                          foreach ($rows as $row)
                          {
                              $sheet->appendRow(array(
                                  $row->id,$row->loanid,$row->ClientFirstNames,$row->ClientSurname,$row->nform,$row->apoliceseguro,$row->nuit,$row->bi,$row->lficheiro,$row->fsalario,$row->arquivo,$row->tprovimento,$row->status,$row->observacao,$row->npaginas,$row->name,$row->extrato,$row->nib,$row->dsalario,$row->outros,Carbon::parse($row->updated_at)->format('Y/m/d'),Carbon::parse($row->created_at)->format('Y/m/d'),Carbon::parse($row->LoanCreationTimeStamp)->format('Y/m/d'),
                              ));
                          }
                      });
                  });
              })->download('xlsx');
            }else if ($radio=='atualizacao') {
              
                        $dataexcel = ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                                ->join('client_details','arquivomaster.loanid','=','client_details.loanID')
                                ->whereBetween('arquivomaster.updated_at',[$inicio,$fim])
                                ->select('arquivomaster.*','users.name','client_details.LoanCreationTimeStamp','client_details.ClientFirstNames','client_details.ClientSurname')
                                ->orderby('updated_at');

              Excel::create('Reportatualizacao-'.time(), function($excel) use ($dataexcel) {
                  $excel->sheet('report', function($sheet) use($dataexcel) {
                      $sheet->appendRow(array(
                          'Referência','loanid','Nome do cliente','Apelido do cliente', 'Número do formulario',  'Apolice de seguro',  'Nuit', 'Bi', 'Localização do ficheiro','Folha de salario', 'Arquivado em',  'Provimento',  'Status', 'Observação', 'Número de paginas', 'Usuario',  'Extrato',  'Nib',  'Declaração de salario', 'Outros','Atualizado em:','Criado em:','LoanCreationTimeStamp',
                      ));
                      $dataexcel->chunk(1000, function($rows) use ($sheet)
                      {
                          foreach ($rows as $row)
                          {
                              $sheet->appendRow(array(
                                  $row->id,$row->loanid,$row->ClientFirstNames,$row->ClientSurname,$row->nform,$row->apoliceseguro,$row->nuit,$row->bi,$row->lficheiro,$row->fsalario,$row->arquivo,$row->tprovimento,$row->status,$row->observacao,$row->npaginas,$row->name,$row->extrato,$row->nib,$row->dsalario,$row->outros,Carbon::parse($row->updated_at)->format('Y/m/d'),Carbon::parse($row->created_at)->format('Y/m/d'),Carbon::parse($row->LoanCreationTimeStamp)->format('Y/m/d'),
                              ));
                          }
                      });
                  });
              })->download('xlsx');

            }else if ($radio=='loan') {
              
                        $dataexcel = ArquivoMaster::leftjoin('users','arquivomaster.idusuario','=','users.id')
                                ->rightJoin('client_details','arquivomaster.loanid','=','client_details.loanID')
                                ->whereBetween('client_details.LoanCreationTimeStamp',[$inicio,$fim])
                                ->select('arquivomaster.*','users.name','client_details.LoanID as LoanID2','client_details.LoanCreationTimeStamp','client_details.ClientFirstNames','client_details.ClientSurname')
                                ->orderby('LoanCreationTimeStamp');

              Excel::create('Reportloan-'.time(), function($excel) use ($dataexcel) {
                  $excel->sheet('report', function($sheet) use($dataexcel) {
                      $sheet->appendRow(array(
                          'Referência','loanid','Nome do cliente','Apelido do cliente', 'Número do formulario',  'Apolice de seguro',  'Nuit', 'Bi', 'Localização do ficheiro','Folha de salario', 'Arquivado em',  'Provimento',  'Status', 'Observação', 'Número de paginas', 'Usuario',  'Extrato',  'Nib',  'Declaração de salario', 'Outros','Atualizado em:','Criado em:','LoanCreationTimeStamp',
                      ));
                      $dataexcel->chunk(1000, function($rows) use ($sheet)
                      {
                          foreach ($rows as $row)
                          {
                              $sheet->appendRow(array(
                                  $row->id,$row->LoanID2,$row->ClientFirstNames,$row->ClientSurname,$row->nform,$row->apoliceseguro,$row->nuit,$row->bi,$row->lficheiro,$row->fsalario,$row->arquivo,$row->tprovimento,$row->status,$row->observacao,$row->npaginas,$row->name,$row->extrato,$row->nib,$row->dsalario,$row->outros,Carbon::parse($row->updated_at)->format('Y/m/d'),Carbon::parse($row->created_at)->format('Y/m/d'),Carbon::parse($row->LoanCreationTimeStamp)->format('Y/m/d'),
                              ));
                          }
                      });
                  });
              })->download('xlsx');

            }
          }else

          if (Auth::user()->can('arquivomaster-user')) {

          if ($radio=='criacao') {
            $data=ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                                ->where('arquivomaster.idusuario','=',$userid)
                                ->whereBetween('arquivomaster.created_at',[$inicio,$fim])
                                ->select('arquivomaster.*','users.name')
                                ->orderby('created_at')
                                ->simplepaginate(5000);

            Session::flash('success', ' Filtrou com sucesso ['.$inicio.' á '.$fim.'] Sub filtro: '.$radio.','.$username);
            return view('arquivo_todos.aruivoindexreport',compact(['data']));

          }elseif ($radio=='atualizacao') {
            $data=ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                                ->where('arquivomaster.idusuario','=',$userid)
                                ->whereBetween('arquivomaster.updated_at',[$inicio,$fim])
                                ->select('arquivomaster.*','users.name')
                                ->orderby('updated_at')
                                ->simplepaginate(5000);

            Session::flash('success', 'Filtrou com sucesso ['.$inicio.' á '.$fim.'] Sub filtro: '.$radio.','.$username);
            return view('arquivo_todos.aruivoindexreport',compact(['data']));

          }

          }else
          {
          if ($radio=='criacao') {
            $data=ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                                ->whereBetween('arquivomaster.created_at',[$inicio,$fim])
                                ->select('arquivomaster.*','users.name')
                                ->orderby('created_at')
                                ->simplepaginate(5000);

            Session::flash('success', 'Filtrou com sucesso ['.$inicio.' á '.$fim.'] Sub filtro: '.$radio);
            return view('arquivo_todos.aruivoindexreport',compact(['data']));

          }elseif ($radio=='atualizacao') {
            $data=ArquivoMaster::join('users','arquivomaster.idusuario','=','users.id')
                                ->whereBetween('arquivomaster.updated_at',[$inicio,$fim])
                                ->select('arquivomaster.*','users.name')
                                ->orderby('updated_at')
                                ->simplepaginate(5000);

            Session::flash('success', 'Filtrou com sucesso ['.$inicio.' á '.$fim.'] Sub filtro: '.$radio);
            return view('arquivo_todos.aruivoindexreport',compact(['data']));
          }elseif ($radio=='loan') {
            $data= ArquivoMaster::leftjoin('users','arquivomaster.idusuario','=','users.id')
                                ->leftJoin('client_details','arquivomaster.loanid','=','client_details.loanID')
                                ->whereBetween('client_details.LoanCreationTimeStamp',[$inicio,$fim])
                                ->select('arquivomaster.*','users.name','client_details.LoanCreationTimeStamp')
                                ->orderby('LoanCreationTimeStamp')
                                ->simplepaginate(5000);

            Session::flash('success', 'Filtrou com sucesso ['.$inicio.' á '.$fim.'] Sub filtro: '.$radio);
            return view('arquivo_todos.aruivoindexreport',compact(['data']));

          }
          }



        }

}
