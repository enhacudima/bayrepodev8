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
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeFuncionarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:qa-nib', ['only' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   LogActivity::addToLog('QA - Index QA');


        return view('qa_todos.homeFuncionario');


        //return view('settings');
    }


public function search(Request $request)
 
{
 
if($request->ajax())
 
{
 
$output="";




/*$nibfuncionario = DB::table('nibfuncionarios')

          

         //->join('nibfuncionarios', 'funcionario.nuit', '=', 'nibfuncionarios.NUIT')

            ->select(

                'nibfuncionarios.*'

              ///'nibfuncionarios.NIB as nib'

                   )
            ->where('nuit','LIKE','%'.$request->search."%")
            ->limit(2)
            ->orderby('NOME')
            ->get();*/

    // redis has posts.all key exists 
    // posts found then it will return all post without touching the database




$products = Cache::remember('cachekey',0.0166666667, function() use ($request) {


    return DB::table('funcionarios_view')
            ->where('nuit','LIKE','%'.$request->search."%")
            ->orWhere('nome','=','%'.$request->search."%")
            ->limit(5)
            ->orderby('nuit','asc')
            ->get(); 
});



/*

$products = DB::table('funcionarios_view')

            ->where('nuit','LIKE',$request->search."%")
            ->limit(5)
            ->orderby('nuit','desc')
            ->get();

*/



$products = Cache::get('cachekey');

/*
$products = $products->flatten()->filter(function($request) {
    return ($request->nuit === $request->search);
});
 /*
//$products=DB::table('funcionario')->where('nuit','LIKE','%'.$request->search."%")->get();
/*
$products = DB::table('funcionarios_view')

            ->where('nuit','LIKE',$request->search."%")
            ->limit(5)
            ->orderby('nuit','desc')
            ->get();


*/

 
if($products)
 
{
 
foreach ($products as $key => $product) {
 
$output.='<tr>'. 
'<td>'.$product->nuit.'</td>'. 
'<td>'.$product->nome.'</td>'.
'<td>'.$product->dataDeNascimento.'</td>'.
'<td>'.$product->codigoOrganico.'</td>'.
'<td>'.$product->descricaoDoOrganico.'</td>'.
'<td>'.$product->tipoDeQuadro.'</td>'.
'<td>'.$product->tipoDeContrato.'</td>'.
'<td>'.$product->dataDoFimDeContrato.'</td>'.
'<td>'.$product->estadoDeConformidadeDaVinculacao.'</td>'.
'<td>'.$product->nib.'</td>'.
'</tr>';
 
}
 
 
 
return Response($output);
 
 
 
   }
 
 
 
   }
 
 
 
}

    public function ajaxData(Request $request){

        $query = $request->get('query','');        

        $posts = Funcionario::where('nuit','LIKE','%'.$query.'%')->get();        

        return response()->json($posts);

    }




}
