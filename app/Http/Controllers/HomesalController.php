<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\User;
use App\Nib;
use App\Funcionario;
use App\FuncionarioDb;
use Hash;
use Auth;
use App\Http\Requests\FuncionarionovoRequest;
use Session;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomesalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:qa-sal', ['only' => ['index']]);
         $this->middleware('permission:qa-new', ['only' => ['savefuncionario','funcionarionovo']]);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('qa_todos.homesal');


        //return view('settings');
    }


public function funcionarionovo()
{  LogActivity::addToLog('QA - Novo funcionario novo form');

    return view('qa_todos.novofuncionario');
}


public function savefuncionario(FuncionarionovoRequest $request)
{   LogActivity::addToLog('QA - Save funcionario');
    $data=$request->all();

    $save=FuncionarioDb::create($data);

    Session::flash('flash_message', 'Funcionario'&' $data->nome '&' restaurado com sucesso');
    return redirect()->back();
}

}
