<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketTodas;
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
use App\Http\Requests\ComentariosRequest;
use App\Http\Requests\CategoryRequest;
use App\Category;
use App\User;
use App\Teams;
use App\Http\Requests\TeamsRequest;
use App\Http\Requests\TeamsUpdateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Helpers\LogActivity;
use App\TicketTeamTime;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Files;
use App\TickeSubtCategory;
use App\TickeDocument;
use App\TicketDocumentHasSubCategores;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewTicket;
use App\Mail\AddTeamTicket;
use App\Mail\CloseTicket;
use App\Mail\SendtoOrginTicket;
use Illuminate\Support\Facades\Gate;



class TicketController extends Controller
{
    //



    function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:myticket-creat-edit', ['only' => ['newtticket','gravar','reopenticket','savecoment','updateticketclient','updateticketnonclient']]);
         $this->middleware('permission:myticket-admin', ['only' => ['thiscategory','savecategories','agents','categories','updatethiscategory','teams','saveteam','thisteam','updatethisteam','committicket']]);
         $this->middleware('permission:myticket-customercare', ['only' => ['sendtoorgin','deleteteamlistlevel','addteamticket','addlevel']]);
         $this->middleware('permission:myticket-view', ['only' => ['myticket','viewthisticket','detalhes','searchcabecalho']]);
         $this->middleware('permission:myticket-coment', ['only' => ['savecoment']]);
         $this->middleware('permission:myticket-complet', ['only' => ['completeteamtask']]);
         $this->middleware('permission:myticket-completticket', ['only' => ['closeticket']]);
         

    }

    public function ticket_level (){
        return (!Auth::guest()) ? Auth::user()->ticket_level : null ;//user_level
    }

    private $emails;

    public function committicket ()
    {      LogActivity::addToLog('Myticket - Committicket Ticket');

        $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
        $city = (!Auth::guest()) ? Auth::user()->city : null ;//user_city
        $branch = (!Auth::guest()) ? Auth::user()->branch : null ;//user_branch
        $ticket_level = (!Auth::guest()) ? Auth::user()->ticket_level : null ;//user_branch
        //filtrando cada usuario
        //se for de nivel branchs deve ver apenas os dados da branch dele

        if ($ticket_level==1) {
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

        return view('ticket_suport.committicket',compact('reclamacoes','acteticket','completticket','committicket'));    
    }
    }


    public function myticket ()
    {      LogActivity::addToLog('Myticket - My Ticket');

        $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
        $city = (!Auth::guest()) ? Auth::user()->city : null ;//user_city
        $branch = (!Auth::guest()) ? Auth::user()->branch : null ;//user_branch
        $ticket_level = (!Auth::guest()) ? Auth::user()->ticket_level : null ;//user_branch
        //filtrando cada usuario
        //se for de nivel branchs deve ver apenas os dados da branch dele

        if ($ticket_level==2) {
            $reclamacoes = TicketTodas::where('ticke_todas.status','=','1')
            ->where('ticke_todas.branch',$branch)
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get();

        $acteticket = TicketTodas::where('status','=','1')
            ->where('branch',$branch)
            ->count();

        $completticket = TicketTodas::where('status','!=','1')
            ->where('branch',$branch)
            ->count();

        return view('ticket_suport.myticket',compact('reclamacoes','acteticket','completticket'));
        }elseif ($ticket_level==1) 

        {
        $reclamacoes = TicketTodas::where('ticke_todas.status','=','1')
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get();

        $acteticket = TicketTodas::where('status','=','1')
            ->count();

        $completticket = TicketTodas::where('status','!=','1')
            ->count();

        return view('ticket_suport.myticket',compact('reclamacoes','acteticket','completticket'));    
        }elseif ($ticket_level!='' | $ticket_level!=1 ) {
            $reclamacoes = TicketTodas::where('ticke_todas.status','=','1')
            ->where('ticke_todas.ticket_level',$ticket_level)
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get();

        $acteticket = TicketTodas::where('status','=','1')
            ->where('ticket_level',$ticket_level)
            ->count();

        $completticket = TicketTodas::where('status','!=','1')
            ->where('ticket_level',$ticket_level)
            ->count();

        return view('ticket_suport.myticket',compact('reclamacoes','acteticket','completticket'));
        }else{

        $reclamacoes = TicketTodas::where('ticke_todas.userid',$userid)
            ->where('ticke_todas.status','=','1')
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->join('ticket_team_time','ticke_todas.ticket_level','=','ticket_team_time.ticket_level')//filtro
            ->orwhere('ticket_team_time.ticket_level',$ticket_level)
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->distinct()
            ->orderby('updated_at','asc')
            ->get();

        $acteticket = TicketTodas::where('ticke_todas.userid',$userid) 
            ->where('ticke_todas.status','=','1')
            ->join('ticket_team_time','ticke_todas.ticket_level','=','ticket_team_time.ticket_level')//filtro
            ->orwhere('ticket_team_time.ticket_level',$ticket_level)
            ->distinct('ticke_todas.id')
            ->count('ticke_todas.id');

        $completticket = TicketTodas::where('ticke_todas.userid',$userid) 
            ->where('ticke_todas.status','!=','1')
            ->join('ticket_team_time','ticke_todas.ticket_level','=','ticket_team_time.ticket_level')//filtro
            ->orwhere('ticket_team_time.ticket_level',$ticket_level)
             ->where('ticke_todas.status','!=','1')
            ->distinct('ticke_todas.id')
            ->count('ticke_todas.id');
        }
        return view('ticket_suport.myticket',compact('reclamacoes','acteticket','completticket'));
    }

    public function completticket ()
    {    LogActivity::addToLog('Myticket - Complet Ticket');
        $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
        $city = (!Auth::guest()) ? Auth::user()->city : null ;//user_city
        $branch = (!Auth::guest()) ? Auth::user()->branch : null ;//user_branch
        $ticket_level = (!Auth::guest()) ? Auth::user()->ticket_level : null ;//user_branch

        //filtrando cada usuario
        //se for de nivel branchs deve ver apenas os dados da branch dele

        if ($ticket_level==2) {
        $reclamacoes = TicketTodas::where('ticke_todas.status','!=','1')
            ->where('ticke_todas.branch',$branch)
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('ticke_todas.status','desc')
            ->get();


        $acteticket = TicketTodas::where('status','=','1')
            ->where('branch',$branch)
            ->count();

        $completticket = TicketTodas::where('status','!=','1')
            ->where('branch',$branch)
            ->count();

        return view('ticket_suport.completticket',compact('reclamacoes','acteticket','completticket'));
        }elseif ($ticket_level==1) 

        {
        $reclamacoes = TicketTodas::where('ticke_todas.status','!=','1')
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')            
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->orderby('updated_at','asc')
            ->get();

        $acteticket = TicketTodas::where('status','=','1')
            ->count();

        $completticket = TicketTodas::where('status','!=','1')
            ->count();

        return view('ticket_suport.completticket',compact('reclamacoes','acteticket','completticket'));    
        }elseif ($ticket_level!='' | $ticket_level!=1) 

        {
            $reclamacoes = TicketTodas::where('ticke_todas.status','!=','1')
            ->where('ticke_todas.ticket_level',$ticket_level)
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get();


        $acteticket = TicketTodas::where('status','=','1')
            ->where('ticke_todas.ticket_level',$ticket_level)
            ->count();

        $completticket = TicketTodas::where('status','!=','1')
            ->where('ticke_todas.ticket_level',$ticket_level)
            ->count();

        return view('ticket_suport.completticket',compact('reclamacoes','acteticket','completticket'));    
        }else{

        $reclamacoes = TicketTodas::where('ticke_todas.userid',$userid)
            ->where('ticke_todas.status','!=','1')
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->join('ticket_team_time','ticke_todas.ticket_level','=','ticket_team_time.ticket_level')//filtro
            ->orwhere('ticket_team_time.ticket_level',$ticket_level)
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->where('ticke_todas.status','!=','1')            
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','ticket_category.time','ticket_category.name as tiposolicitacao','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory')
            ->distinct('ticket_team_time.idsolicitacao')
            ->orderby('updated_at','asc')
            ->get();

        $acteticket = TicketTodas::where('ticke_todas.userid',$userid) 
            ->where('ticke_todas.status','=','1')
            ->join('ticket_team_time','ticke_todas.ticket_level','=','ticket_team_time.ticket_level')//filtro
            ->orwhere('ticket_team_time.ticket_level',$ticket_level)
            ->distinct('ticke_todas.id')
            ->count('ticke_todas.id');

        $completticket = TicketTodas::where('ticke_todas.userid',$userid) 
            ->where('ticke_todas.status','!=','1')
            ->join('ticket_team_time','ticke_todas.ticket_level','=','ticket_team_time.ticket_level')//filtro
            ->orwhere('ticket_team_time.ticket_level',$ticket_level)
             ->where('ticke_todas.status','!=','1')
            ->distinct('ticke_todas.id')
            ->count('ticke_todas.id');
        }
        return view('ticket_suport.completticket',compact('reclamacoes','acteticket','completticket'));
    }

    
    public function newtticket ()
    {    LogActivity::addToLog('Myticket - New form');
        $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
        $city = (!Auth::guest()) ? Auth::user()->city : null ;//user_city
        $branch = (!Auth::guest()) ? Auth::user()->branch : null ;//user_branch
        $ticket_level = (!Auth::guest()) ? Auth::user()->ticket_level : null ;//user_branch

        if ($ticket_level==2) {
            $acteticket = TicketTodas::where('status','=','1')
            ->where('branch',$branch)
            ->count();

            $completticket = TicketTodas::where('status','!=','1')
            ->where('branch',$branch)
            ->count();

            }elseif ($ticket_level==1)
            {
                $acteticket = TicketTodas::where('status','=','1')
                ->count();

                $completticket = TicketTodas::where('status','!=','1')
                ->count();
            }elseif ($ticket_level!='' | $ticket_level!=1)
            {
                $acteticket = TicketTodas::where('status','=','1')
                ->where('ticke_todas.ticket_level',$ticket_level)
                ->count();

                $completticket = TicketTodas::where('status','!=','1')
                ->where('ticke_todas.ticket_level',$ticket_level)
                ->count();
            }else{
            $acteticket = TicketTodas::where('ticke_todas.userid',$userid) 
            ->where('ticke_todas.status','=','1')
            ->join('ticket_team_time','ticke_todas.ticket_level','=','ticket_team_time.ticket_level')//filtro
            ->orwhere('ticket_team_time.ticket_level',$ticket_level)
            ->distinct('ticke_todas.id')
            ->count('ticke_todas.id');

            $completticket = TicketTodas::where('ticke_todas.userid',$userid) 
            ->where('ticke_todas.status','!=','1')
            ->join('ticket_team_time','ticke_todas.ticket_level','=','ticket_team_time.ticket_level')//filtro
            ->orwhere('ticket_team_time.ticket_level',$ticket_level)
            ->distinct('ticke_todas.id')
            ->count('ticke_todas.id');
        }

        return view('ticket_suport.01formstep',compact('acteticket','completticket'));
    }

    public function aformstep ()
    {   $category=Category::get();
        return view('ticket_suport.aformstep',compact('category'));
    }

    public function bformstep ()
    {   $category=Category::get();
        return view('ticket_suport.bformstep',compact('category'));
    }
//voltando ao form A/B
    public function aformback (Request $request)
    {   
      
        $product = $request->session()->get('product');
        $category=Category::get();

        return view('ticket_suport.aformstep',compact('product','category'));
    }

    public function bformback (Request $request)
    {   
        $product = $request->session()->get('product');
        $category=Category::get();

        return view('ticket_suport.bformstep',compact('product','category'));
    }


//form a

    public function createStepa1 (Request $request)
    {
            $validatedData = $request->validate([
            'loanid' => 'required|min:12|max:15|exists:client_details',
            'description' => 'required|min:3',
            'tipodecliente' => 'required|string',
            'assunto' =>'required|min:9|max:100|string',
            'prioridade' =>'required|max:10|string',
            'categoria' =>'required',
            'subcategoria' =>'required',
            'telefone1'=>'required|min:8|max:10|string',
            'telefone2'=>'max:10',
            'email'=>'',
            'status'=>'required',
            'recorentencia'=>'required',
            'm_comunicacao'=>'required',

        ],
         [
            'loanid.required' => 'O campo loanid é de caracter obrigatorio',
            'loanid.min' => 'O campo loanid deve conter no minimo 12 e no maximo 15 caracteres',
            'loanid.max'=> 'O campo loanid não pode conter mas de 15 caracteres',
            'loanid.exists'=> 'Infelizmente não foi possivel localizar o loanid na base da dados tente um loanid valido',
            'description.required'=> 'O campo da descrição é de caracter obrigatorio',
            'description.min'=> 'O campo descrição deve ter no minimo 3 caracteres e no maximo 255',
            'description.max'=>'A sua descrição não pode conter mas de 255 caracteres',
            'assunto.required'=>'É obrigatorio descrever o assunto que pretende levantar',
            'assunto.min'=>'O campo assunto deve conter no minimo 9 caracteres e no maximo 100',
            'assunto.max'=>'O campo assunto não pode conter mas de 100 caracteres',
            'prioridade.required'=> 'O campo Nivel de prioridade é de caracter obrigatorio',
            'telefone1.required'=> 'O campo Telefone-1 é de caracter obrigatorio',
            'telefone1.min'=> 'O campo Telefone-1 deve ter no minimo 8 caracteres e no maximo 10',
            'telefone1.max'=>'A sua Telefone-1 não pode conter mas de 10 caracteres',
            'telefone2.max'=>'A sua Telefone-2 não pode conter mas de 10 caracteres',
            'm_comunicacao.required'=> 'O campo Meio de Comunicação é de caracter obrigatorio',



         ]   
    );


         if(empty($request->session()->get('product'))){
             $product = new TicketTodas;
             $product->fill($validatedData);
             $request->session()->put('product', $product);
         }else{
             $product = $request->session()->get('product');
             $product->fill($validatedData);
             $request->session()->put('product', $product);
         }

         return redirect('/form-ticket-a-1');
    }
    public function aformstep1(Request $request)
    {
        $product = $request->session()->get('product');
        $subcategory=$product->subcategoria;
        $file=TickeDocument::join('ticket_document_has_subcategores','ticket_document.id','ticket_document_has_subcategores.document_id')
            ->where('ticket_document_has_subcategores.subcategores_id',$subcategory)
            ->select('ticket_document.*')
            ->get();

        $fileyesno=TickeSubtCategory::find($subcategory);
       
            if($fileyesno->file=='sim'){
                    if(Auth::user()->can('myticket-leavefiles') ){
                        return $this->aformstep1preperdata($request);
                    }else
                    {
                        
                        return view('ticket_suport.02formstepa',compact('product', $product,'file'));
                    }
                    
            }else{
                
                return $this->aformstep1preperdata($request);
            }
        
    }

    public function aformstep1preperdata(Request $request)
    {

        $product = $request->session()->get('product');
        $subcategory=$product->subcategoria;


                    $namesolicitacao = "productImage-" . time();
                    $product->productImg = $namesolicitacao;
                    $request->session()->put('product', $product);
                    //Capturando detalhes do Cliente na Tabela client_details
                    $loanid=$product->loanid;
                    $detalhe=DB::table('client_details')
                                ->where('loanid','=',$loanid)
                                ->limit(1)
                                ->get();
                    foreach ($detalhe as $key => $detalhes){
                    $product = $request->session()->get('product');

                    $ticket_level = (!Auth::guest()) ? Auth::user()->ticket_level : null ;//user_branch
                    $ClientFirstNames=$detalhes->ClientFirstNames;
                    $ClientSurname=$detalhes->ClientSurname;
                    $LoanTerm=$detalhes->LoanTerm;
                    $LoanAmount=$detalhes->LoanAmount;
                    $nib=$detalhes->ClientBankAccountNumber;
                    $numerododocumento=$detalhes->ClientPassportNumber;
                    $nuit=$detalhes->ClientIDNumber;
                    $entidade=$detalhes->CustomFieldValue1;
                    $datadenascimento=$detalhes->ClientDateOfBirth;
                    $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
                    $city = (!Auth::guest()) ? Auth::user()->city : null ;//user_city
                    $branch = (!Auth::guest()) ? Auth::user()->branch : null ;//user_branch

                    $product->ticket_level=$ticket_level;
                    $product->ClientFirstNames=$ClientFirstNames;
                    $product->ClientSurname=$ClientSurname;
                    $product->LoanTerm=$LoanTerm;
                    $product->LoanAmount=$LoanAmount;
                    $product->nib=$nib;
                    $product->numerododocumento=$numerododocumento;
                    $product->nuit=$nuit;
                    $product->entidade=$entidade;
                    $product->userid=$userid;
                    $product->city=$city;
                    $product->branch=$branch;}


                    $request->session()->put('product', $product);


                    return $this->aformstep2($request);
        
    }

     public function createStepa2(Request $request)
    {
        $product = $request->session()->get('product');

        if(!isset($product->productImg)) {

            $request->validate([
                'filetype' => 'required',
                'productimg' => 'required',
                'productimg.*' => 'mimes:jpeg,png,pdf|max:10000',
            ],
            [
                'productimg.*.mimes'=>'O formato do ficheiro deve ser: jpeg,png,pdf',
                'productimg.*.max'=>'O formato do ficheiro deve ter no maximo 10MB',
                'productimg.required'=>'É necessario um anexo',
            ]
        );

            $namesolicitacao = "productImage-" . time();

            foreach($request->file('productimg') as $key=>$file)
            {
                
                $name="productImage-" . time() . '-'.$key.'.'. $file->getClientOriginalExtension();
                $file->storeAs('productimg', $name);
                $file= new Files();
                $file->filename=$name;
                $file->namesolicitacao=$namesolicitacao;
                $file->filetype=$request->filetype[$key];
                $file->save();

            }

            //$request->productimg->storeAs('productimg', $namesolicitacao);

            $product = $request->session()->get('product');

            $product->productImg = $namesolicitacao;
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

        $ticket_level = (!Auth::guest()) ? Auth::user()->ticket_level : null ;//user_branch
        $ClientFirstNames=$detalhes->ClientFirstNames;
        $ClientSurname=$detalhes->ClientSurname;
        $LoanTerm=$detalhes->LoanTerm;
        $LoanAmount=$detalhes->LoanAmount;
        $nib=$detalhes->ClientBankAccountNumber;
        $numerododocumento=$detalhes->ClientPassportNumber;
        $nuit=$detalhes->ClientIDNumber;
        $entidade=$detalhes->CustomFieldValue1;
        $datadenascimento=$detalhes->ClientDateOfBirth;
        $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
        $city = (!Auth::guest()) ? Auth::user()->city : null ;//user_city
        $branch = (!Auth::guest()) ? Auth::user()->branch : null ;//user_branch

        $product->ticket_level=$ticket_level;
        $product->ClientFirstNames=$ClientFirstNames;
        $product->ClientSurname=$ClientSurname;
        $product->LoanTerm=$LoanTerm;
        $product->LoanAmount=$LoanAmount;
        $product->nib=$nib;
        $product->numerododocumento=$numerododocumento;
        $product->nuit=$nuit;
        $product->entidade=$entidade;
        $product->userid=$userid;
        $product->city=$city;
        $product->branch=$branch;


        $request->session()->put('product', $product);


            return redirect('/form-ticket-a-2');


        }

    }

    public function anexosticket(Request $request,$anexo)
    { $product = $request->session()->get('product');

        if(isset($product->productImg)) 
        {

        $files=Files::where('namesolicitacao',$anexo)
                ->join('ticket_document','files.filetype','ticket_document.id')
                ->select('files.*','ticket_document.name as filetype')
                ->get();
        $subcategory=$product->subcategoria;
        $file=TickeDocument::join('ticket_document_has_subcategores','ticket_document.id','ticket_document_has_subcategores.document_id')
            ->where('ticket_document_has_subcategores.subcategores_id',$subcategory)
            ->select('ticket_document.*')
            ->get();
         if ($product->tipodecliente=='Non') {
                $url='form-ticket-b-2';
            }elseif($product->tipodecliente=='Cliente'){
                $url='form-ticket-a-2';
            }   
         

        return view('ticket_suport.files',compact('files','product','file','url'));
        }

    }



    public function aformstep2(Request $request)
    {
        $product = $request->session()->get('product');

        return view('ticket_suport.03formstepa',compact('product',$product));
    }





//form b
        public function createStepb1 (Request $request)
    {   
            $this->validate($request,[
            'description' => 'required|min:3',
            'tipodecliente' => 'required',
            //'nuit' =>'min:9|max:9',
            'ClientFirstNames' =>'required|min:3|max:100|string',
            'ClientSurname'=>'required|min:3|max:100|string',
            'entidade' =>'required|min:3|max:255|string',
            //'documentodeidentificacao' =>'required|string',
            //'numerododocumento' =>'required|min:3|max:255|string',
            //'emitidoem' =>'required|min:3|max:255|string',
            //'provinciade' =>'required|min:3|max:255|string',
            //'datadeemissao' =>'required|string',
            //'nomedobanco' =>'required|min:1|max:255|string',
            //'nib' =>'required|min:12|max:255|string',
            //'titulardaconta' =>'required|min:3|max:255|string',
            'assunto' =>'required|min:9|max:100|string',
            'prioridade' =>'required|max:10|string',            
            'categoria' =>'required',
            'subcategoria' =>'required',
            'telefone1'=>'required|min:1|max:10|string',
            'telefone2'=>'max:10',
            'email'=>'',
            //'datadenascimento'=>'required',
            'status'=>'required',
            'recorentencia'=>'required',
            'm_comunicacao'=>'required',

        ],
         [

            'description.required'=> 'O campo da descrição é de caracter obrigatorio',
            'nuit.required'=> 'O campo NUIT é de caracter obrigatorio',
            'nuit.min'=> 'O campo NUIT deve ter no minimo 9 caracteres e no maximo 9',
            'nuit.max'=> 'O campo NUIT deve ter no maximo 9',
            'entidade.required'=>'O campo Entidade é de caracter obrigatorio',
            'entidade.min'=>'O campo Entidade deve ter no minimo 3 caracteres e no maximo 255',
            'documentodeidentificacao.required'=>'O campo Documento de Identificação é de caracter obrigatorio',
            'numerododocumento.required'=>'O campo Número de Documento de Identificação é de caracter obrigatorio',
            'description.min'=> 'O campo descrição deve ter no minimo 3 caracteres e no maximo 255',
            'description.max'=>'A sua descrição não pode conter mas de 255 caracteres',
            'assunto.required'=>'É obrigatorio descrever o assunto que pretende levantar',
            'assunto.min'=>'O campo assunto deve conter no minimo 9 caracteres e no maximo 100',
            'assunto.max'=>'O campo assunto não pode conter mas de 100 caracteres',
            'prioridade.required'=> 'O campo Nivel de prioridade é de caracter obrigatorio',
            'telefone1.required'=> 'O campo Telefone-1 é de caracter obrigatorio',
            'telefone1.min'=> 'O campo Telefone-1 deve ter no minimo 8 caracteres e no maximo 10',
            'telefone1.max'=>'A sua Telefone-1 não pode conter mas de 10 caracteres',
            'telefone2.max'=>'A sua Telefone-2 não pode conter mas de 10 caracteres',
            'm_comunicacao.required'=> 'O campo Meio de Comunicação é de caracter obrigatorio',



         ] );


         if(empty($request->session()->get('product'))){
             $product = new TicketTodas;
             $product->fill($request->all());
             $request->session()->put('product', $product);
         }else{
             $product = $request->session()->get('product');
             $product->fill($request->all());
             $request->session()->put('product', $product);
         }

         return redirect('/form-ticket-b-1');
    }
    public function bformstep1(Request $request)
    {
        $product = $request->session()->get('product');
        $subcategory=$product->subcategoria;
        $file=TickeDocument::join('ticket_document_has_subcategores','ticket_document.id','ticket_document_has_subcategores.document_id')
            ->where('ticket_document_has_subcategores.subcategores_id',$subcategory)
            ->select('ticket_document.*')
            ->get();
         $fileyesno=TickeSubtCategory::find($subcategory);

        
            if($fileyesno->file=='sim'){
                    if(Auth::user()->can('myticket-leavefiles') ){
                        return $this->bformstep1prepardata($request);
                    }else
                    {
                        
                         return view('ticket_suport.02formstepb',compact('product', 'file'));
                    }
                    
            }else{
                
                return $this->bformstep1prepardata($request);
            }
        

        
    }

        public function bformstep1prepardata(Request $request)
    {
        $product = $request->session()->get('product');
        $subcategory=$product->subcategoria;
        $file=TickeDocument::join('ticket_document_has_subcategores','ticket_document.id','ticket_document_has_subcategores.document_id')
            ->where('ticket_document_has_subcategores.subcategores_id',$subcategory)
            ->select('ticket_document.*')
            ->get();

                    $namesolicitacao = "productImage-" . time();
                    $product->productImg = $namesolicitacao;
                    $request->session()->put('product', $product);
                    //Capturando detalhes do Cliente na Tabela client_details
                    $ticket_level = (!Auth::guest()) ? Auth::user()->ticket_level : null ;//user_branch
                    $product = $request->session()->get('product');
                    $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
                    $city = (!Auth::guest()) ? Auth::user()->city : null ;//user_city
                    $branch = (!Auth::guest()) ? Auth::user()->branch : null ;//user_branch

                    $product->ticket_level=$ticket_level;
                    $product->userid=$userid;
                    $product->city=$city;
                    $product->branch=$branch;

                    $request->session()->put('product', $product);

                    return $this->bformstep2($request);
        

        
    }

    public function createStepb2(Request $request)
    {
        $product = $request->session()->get('product');
        if(!isset($product->productImg)) {
             $request->validate([
                'filetype' => 'required',
                'productimg' => 'required',
                'productimg.*' => 'mimes:jpeg,png,pdf|max:10000',
            ],
            [
                'productimg.*.mimes'=>'O formato do ficheiro deve ser: jpeg,png,pdf',
                'productimg.*.max'=>'O formato do ficheiro deve ter no maximo 10MB',
                'productimg.required'=>'É necessario um anexo',
            ]
        );
            $namesolicitacao = "productImage-" . time();

            foreach($request->file('productimg') as $key=>$file)
            {
                
                $name="productImage-" . time() . '-'.$key.'.'. $file->getClientOriginalExtension();
                $file->storeAs('productimg', $name);
                $file= new Files();
                $file->filename=$name;
                $file->namesolicitacao=$namesolicitacao;
                $file->filetype=$request->filetype[$key];
                $file->save();

            }

            //$request->productimg->storeAs('productimg', $namesolicitacao);

            $product = $request->session()->get('product');

            $product->productImg = $namesolicitacao;
            $request->session()->put('product', $product);
        }
        //Capturando detalhes do Cliente na Tabela client_details

            $ticket_level = (!Auth::guest()) ? Auth::user()->ticket_level : null ;//user_branch
            $product = $request->session()->get('product');
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
            $city = (!Auth::guest()) ? Auth::user()->city : null ;//user_city
            $branch = (!Auth::guest()) ? Auth::user()->branch : null ;//user_branch

            $product->ticket_level=$ticket_level;
            $product->userid=$userid;
            $product->city=$city;
            $product->branch=$branch;
            $request->session()->put('product', $product);

            return redirect('/form-ticket-b-2');

    }

    public function bformstep2(Request $request)
    {
        $product = $request->session()->get('product');

        return view('ticket_suport.03formstepb',compact('product',$product));
    }

    
//remove anexo
        public function removeanexo(Request $request, $anexo)
    {
        $product = $request->session()->get('product');
        $imagem=$anexo;
        Storage::delete('/productimg/'.$imagem);
        Files::where('filename',$imagem)->delete();

        //$product->productImg = null;
        return back();
    }


        public function removeanexoa(Request $request)
    {
        $product = $request->session()->get('product');
        $imagem=$product->productImg;
        Storage::delete('/productimg/'.$imagem);

        $product->productImg = null;
        return view('ticket_suport.02formstepa',compact('product',$product));
    }

        public function removeanexob(Request $request)
    {
        $product = $request->session()->get('product');
        $imagem=$product->productImg;
        Storage::delete('/productimg/'.$imagem);

        $product->productImg = null;
        return view('ticket_suport.02formstepb',compact('product',$product));
    }
//gravando na base de dados 

        public function gravar(Request $request)
    {    LogActivity::addToLog('Myticket - Save ticket');
        $product = $request->session()->get('product');
        $posts=$product;
        $product->save();

        $useremail = (!Auth::guest()) ? Auth::user()->email : null ;//user_email
        $ticket_level = (!Auth::guest()) ? Auth::user()->ticket_level : null ;//user_level

        $user=User::where(function($query ){
                            $query->where('ticket_level','!=',null)
                                  ->Where('ticket_level',$this->ticket_level())
                                  ->orWhere('ticket_level',1);
                        })->where('ticket_notification','Yes')


        ->get()->toArray();

       
        

        Mail::to($user)->cc([$useremail])->send(new NewTicket($posts));

        Session::flash('success', 'Ticke de '.$product->assunto.' criado com sucesso');
        session()->forget('product');
        return redirect('/myticket');
    }
//ver ticket

        public function viewthisticket($id)
    {    LogActivity::addToLog('Myticket - view ticket'.$id);
        $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
        $city = (!Auth::guest()) ? Auth::user()->city : null ;//user_city
        $branch = (!Auth::guest()) ? Auth::user()->branch : null ;//user_branch
        $ticket_level = (!Auth::guest()) ? Auth::user()->ticket_level : null ;//user_branch

        if ($ticket_level==2) {

            $acteticket = TicketTodas::where('status','=','1')
            ->where('branch',$branch)
            ->count();

            $completticket = TicketTodas::where('status','!=','1')
            ->where('branch',$branch)
            ->count();

            }elseif ($ticket_level==1)
            {

                $acteticket = TicketTodas::where('status','=','1')
                ->count();

                $completticket = TicketTodas::where('status','!=','1')
                ->count();

            }elseif ($ticket_level!='' | $ticket_level!=1)
            {
                $acteticket = TicketTodas::where('status','=','1')
                ->where('ticke_todas.ticket_level',$ticket_level)
                ->count();

                $completticket = TicketTodas::where('status','!=','1')
                ->where('ticke_todas.ticket_level',$ticket_level)
                ->count();
            }else{
            $acteticket = TicketTodas::where('ticke_todas.userid',$userid) 
            ->where('ticke_todas.status','=','1')
            ->join('ticket_team_time','ticke_todas.ticket_level','=','ticket_team_time.ticket_level')//filtro
            ->orwhere('ticket_team_time.ticket_level',$ticket_level)
            ->distinct('ticke_todas.id')
            ->count('ticke_todas.id');

            $completticket = TicketTodas::where('ticke_todas.userid',$userid) 
            ->where('ticke_todas.status','!=','1')
            ->join('ticket_team_time','ticke_todas.ticket_level','=','ticket_team_time.ticket_level')//filtro
            ->orwhere('ticket_team_time.ticket_level',$ticket_level)
            ->where('ticke_todas.status','!=','1')
            ->distinct('ticke_todas.id')
            ->count('ticke_todas.id'); 
            }








        $ticket = TicketTodas::where('ticke_todas.id',$id)
            ->join('users','ticke_todas.userid','=','users.id')
            ->join('ticket_category','ticke_todas.categoria','=','ticket_category.id')
            ->leftjoin('ticket_teams','ticke_todas.ticket_level','ticket_teams.id')
            ->leftjoin('agencia','ticke_todas.branch','=','agencia.id_agencia')
            ->leftjoin('ticket_subcategory','ticke_todas.subcategoria','=','ticket_subcategory.id')
            ->select('ticke_todas.*','users.name','users.lname','ticket_category.name as tiposolicitacao','ticket_category.time','ticket_teams.name as ticket_level','agencia.outletSyncNameCorrected','ticket_subcategory.name as subcategory','ticket_subcategory.id as subcategory_id')
            ->first();

            

        $coment = ModeloEditarEstado::where('edicaodeestado.idsolicitacao',$id)
            ->join('users','edicaodeestado.idusuario','=','users.id')
            ->leftjoin('ticket_teams','edicaodeestado.ticket_level','ticket_teams.id')
            ->select('edicaodeestado.*','users.name','users.lname','ticket_teams.name as ticket_level')
            ->orderby('created_at')
            ->paginate(5);

        $nucomment = ModeloEditarEstado::where('idsolicitacao',$id)
            ->count();
        $category=Category::get();    

        $teams=Teams::get();

        $teamstatus=TicketTeamTime::where('ticket_team_time.idsolicitacao',$id)
            ->leftjoin('ticket_teams','ticket_team_time.ticket_level','ticket_teams.id')
            ->select('ticket_team_time.*','ticket_teams.name as teamstatus_level')
            ->get();

        $teamon=TicketTeamTime::where('ticket_team_time.idsolicitacao',$id)->where('status',0)->select('status')->get();
        

        $anexos=Files::where('namesolicitacao',$ticket->productimg)
                        ->join('ticket_document','files.filetype','ticket_document.id')
                        ->select('files.*','ticket_document.name as file_name')->get(); 

        $file=TickeDocument::join('ticket_document_has_subcategores','ticket_document.id','ticket_document_has_subcategores.document_id')
            ->where('ticket_document_has_subcategores.subcategores_id',$ticket->subcategory_id)
            ->select('ticket_document.*')
            ->get();                 

        return view('ticket_suport.thisticket',compact('acteticket','completticket','ticket','coment','nucomment','category','teams','teamstatus','anexos','file','teamon'));
    }

//save commet

        public function savecoment (ComentariosRequest $request)
    {    LogActivity::addToLog('Myticket-Save coment');
        $data=$request->all();

        $save=ModeloEditarEstado::create($data);


        Session::flash('success', 'Comentario adicionado!');
        return back();
    }
        public function updateticketnonclient(Request $request)
    {        LogActivity::addToLog('Myticket - update ticket none');
            $validatedData = $request->validate([
            'description' => 'required|min:3',
            'nuit' =>'required|min:9|max:9',
            'ClientFirstNames' =>'required|min:3|max:100|string',
            'ClientSurname'=>'required|min:3|max:100|string',
            'entidade' =>'required|min:3|max:255|string',
            //'numerododocumento' =>'required|min:3|max:255|string',
            //'nomedobanco' =>'required|min:1|max:255|string',
            //'nib' =>'required|min:12|max:255|string',
            //'titulardaconta' =>'required|min:3|max:255|string',
            'assunto' =>'required|min:9|max:100|string',
            'prioridade' =>'required|max:10|string',
            'categoria' =>'required',
            'subcategoria' =>'required',
            'telefone1'=>'required|min:1|max:10|string',
            'telefone2'=>'max:10',
            'email'=>'',
            'recorentencia'=>'required',

        ],
         [

            'description.required'=> 'O campo da descrição é de caracter obrigatorio',
            'nuit.required'=> 'O campo NUIT é de caracter obrigatorio',
            'nuit.min'=> 'O campo NUIT deve ter no minimo 9 caracteres e no maximo 9',
            'nuit.max'=> 'O campo NUIT deve ter no maximo 9',
            'entidade.required'=>'O campo Entidade é de caracter obrigatorio',
            'entidade.min'=>'O campo Entidade deve ter no minimo 3 caracteres e no maximo 255',
            'documentodeidentificacao.required'=>'O campo Documento de Identificação é de caracter obrigatorio',
            'numerododocumento.required'=>'O campo Número de Documento de Identificação é de caracter obrigatorio',
            'description.min'=> 'O campo descrição deve ter no minimo 3 caracteres e no maximo 255',
            'description.max'=>'A sua descrição não pode conter mas de 255 caracteres',
            'assunto.required'=>'É obrigatorio descrever o assunto que pretende levantar',
            'assunto.min'=>'O campo assunto deve conter no minimo 9 caracteres e no maximo 100',
            'assunto.max'=>'O campo assunto não pode conter mas de 100 caracteres',
            'prioridade.required'=> 'O campo Nivel de prioridade é de caracter obrigatorio',
            'telefone1.required'=> 'O campo Telefone-1 é de caracter obrigatorio',
            'telefone1.min'=> 'O campo Telefone-1 deve ter no minimo 8 caracteres e no maximo 10',
            'telefone1.max'=>'A sua Telefone-1 não pode conter mas de 10 caracteres',


         ]);


            if (isset($request->productimg)) {
                //dd($request->productimg);

            $file = $request->validate([
                'productimg' => 'mimes:jpeg,png,pdf|max:10000',
            ],
                [
                    'productimg.mimes'=>'É necessario um anexo no formato jpeg,png,pdf',
                ]
            );

            $fileName = "productImage-" . time() . '.' . $request['productimg']->getClientOriginalExtension();

            $request->productimg->storeAs('productimg', $fileName);

            $imagem=$request['oldpdf'];
            Storage::delete('/productimg/'.$imagem);



                     TicketTodas::where('id',$request['idsolicitacao'])
                            ->update([  'assunto'=>$validatedData['assunto'],
                                        'description'=>$validatedData['description'],
                                        'nuit'=>$validatedData['nuit'],
                                        'ClientFirstNames'=>$validatedData['ClientFirstNames'],
                                        'ClientSurname'=>$validatedData['ClientSurname'],
                                        'entidade'=>$validatedData['entidade'],
                                        'numerododocumento'=>$validatedData['numerododocumento'],
                                        'nomedobanco'=>$validatedData['nomedobanco'],
                                        'nib'=>$validatedData['nib'],
                                        'titulardaconta'=>$validatedData['titulardaconta'],
                                        'assunto'=>$validatedData['assunto'],
                                        'prioridade'=>$validatedData['prioridade'],
                                        'categoria'=>$validatedData['categoria'],
                                        'subcategoria'=>$validatedData['subcategoria'],
                                        'telefone1'=>$validatedData['telefone1'],
                                        'telefone2'=>$validatedData['telefone2'],
                                        'email'=>$validatedData['email'],
                                        'recorentencia'=>$validatedData['recorentencia'],
                                        'productimg'=>$fileName,
                                    ]
                                );
            ModeloEditarEstado::create([
                        'comentarios'=>"Alterou o Ticket e adicionou um novo anexo",
                        'idsolicitacao'=>$request['idsolicitacao'],
                        'idusuario' => (!Auth::guest()) ? Auth::user()->id : null ,//user_id
                        'novoestado'=>$request['novoestado'],

              ]);               
              //Session::flash('success', 'Ticket Alterado com sucesso');
            return back()->with('success', 'Ticket Alterado com sucesso');         


            }elseif (!$request->productimg) {
                TicketTodas::where('id',$request['idsolicitacao'])
                            ->update([  'assunto'=>$validatedData['assunto'],
                                        'description'=>$validatedData['description'],
                                        'nuit'=>$validatedData['nuit'],
                                        'ClientFirstNames'=>$validatedData['ClientFirstNames'],
                                        'ClientSurname'=>$validatedData['ClientSurname'],
                                        'entidade'=>$validatedData['entidade'],
                                        'numerododocumento'=>$validatedData['numerododocumento'],
                                        'nomedobanco'=>$validatedData['nomedobanco'],
                                        'nib'=>$validatedData['nib'],
                                        'titulardaconta'=>$validatedData['titulardaconta'],
                                        'assunto'=>$validatedData['assunto'],
                                        'prioridade'=>$validatedData['prioridade'],
                                        'categoria'=>$validatedData['categoria'],
                                        'subcategoria'=>$validatedData['subcategoria'],
                                        'telefone1'=>$validatedData['telefone1'],
                                        'telefone2'=>$validatedData['telefone2'],
                                        'email'=>$validatedData['email'],
                                        'recorentencia'=>$validatedData['recorentencia'],

                                    ]
                                );
             ModeloEditarEstado::create([
                        'comentarios'=>"Alterou o Ticket",
                        'idsolicitacao'=>$request['idsolicitacao'],
                        'idusuario' => (!Auth::guest()) ? Auth::user()->id : null ,//user_id
                        'novoestado'=>$request['novoestado'],

              ]);                
              //Session::flash('success', 'Ticket Alterado com sucesso');
            return back()->with('success', 'Ticket Alterado com sucesso');               
            }
             

           

    }


        public function updateticketclient(Request $request)
    {    LogActivity::addToLog('Myticket-update ticket client ');

            $validatedData = $request->validate([
            'loanid' => 'required|min:12|max:15|exists:client_details',
            'description' => 'required|min:3',
            'ClientFirstNames' =>'required|min:3|max:100|string',
            'ClientSurname'=>'required|min:3|max:100|string',
            'nib' =>'required|min:12|max:255|string',
            'assunto' =>'required|min:9|max:100|string',
            'prioridade' =>'required|max:10|string',
            'categoria' =>'required',
            'subcategoria' =>'required',
            'telefone1'=>'required|min:8|max:10|string',
            'telefone2'=>'max:10',
            'email'=>'',
            'recorentencia'=>'required',

        ],
         [
            'loanid.min' => 'O campo loanid deve conter no minimo 12 e no maximo 15 caracteres',
            'loanid.max'=> 'O campo loanid não pode conter mas de 15 caracteres',
            'loanid.exists'=> 'Infelizmente não foi possivel localizar o loanid na base da dados tente um loanid valido',
            'description.required'=> 'O campo da descrição é de caracter obrigatorio',
            'description.min'=> 'O campo descrição deve ter no minimo 3 caracteres e no maximo 255',
            'description.max'=>'A sua descrição não pode conter mas de 255 caracteres',
            'assunto.required'=>'É obrigatorio descrever o assunto que pretende levantar',
            'assunto.min'=>'O campo assunto deve conter no minimo 9 caracteres e no maximo 100',
            'assunto.max'=>'O campo assunto não pode conter mas de 100 caracteres',
            'prioridade.required'=> 'O campo Nivel de prioridade é de caracter obrigatorio',
            'telefone1.required'=> 'O campo Telefone-1 é de caracter obrigatorio',
            'telefone1.min'=> 'O campo Telefone-1 deve ter no minimo 8 caracteres e no maximo 10',
            'telefone1.max'=>'A sua Telefone-1 não pode conter mas de 10 caracteres',
            'telefone2.max'=>'A sua Telefone-2 não pode conter mas de 10 caracteres',



         ]   
    );


            if (isset($request->productimg)) {
                //dd($request->productimg);

            $file = $request->validate([
                'productimg' => 'mimes:jpeg,png,pdf|max:10000',
            ],
                [
                    'productimg.mimes'=>'É necessario um anexo no formato jpeg,png,pdf',
                ]
            );

            $fileName = "productImage-" . time() . '.' . $request['productimg']->getClientOriginalExtension();

            $request->productimg->storeAs('productimg', $fileName);

            $imagem=$request['oldpdf'];
            Storage::delete('/productimg/'.$imagem);



                     TicketTodas::where('id',$request['idsolicitacao'])
                            ->update([  'assunto'=>$validatedData['assunto'],
                                        'description'=>$validatedData['description'],
                                        'ClientFirstNames'=>$validatedData['ClientFirstNames'],
                                        'ClientSurname'=>$validatedData['ClientSurname'],
                                        'nib'=>$validatedData['nib'],
                                        'assunto'=>$validatedData['assunto'],
                                        'prioridade'=>$validatedData['prioridade'],
                                        'categoria'=>$validatedData['categoria'],
                                        'subcategoria'=>$validatedData['subcategoria'],
                                        'telefone1'=>$validatedData['telefone1'],
                                        'telefone2'=>$validatedData['telefone2'],
                                        'email'=>$validatedData['email'],
                                        'recorentencia'=>$validatedData['recorentencia'],
                                        'productimg'=>$fileName,
                                    ]
                                );
            ModeloEditarEstado::create([
                        'comentarios'=>"Alterou o Ticket e adicionou um novo anexo",
                        'idsolicitacao'=>$request['idsolicitacao'],
                        'idusuario' => (!Auth::guest()) ? Auth::user()->id : null ,//user_id
                        'novoestado'=>$request['novoestado'],

              ]);               
            //Session::flash('success', 'Ticket Alterado com sucesso');
            return back()->with('success', 'Ticket Alterado com sucesso');          


            }elseif (!$request->productimg) {
                TicketTodas::where('id',$request['idsolicitacao'])
                            ->update([  'assunto'=>$validatedData['assunto'],
                                        'description'=>$validatedData['description'],
                                        'ClientFirstNames'=>$validatedData['ClientFirstNames'],
                                        'ClientSurname'=>$validatedData['ClientSurname'],
                                        'nib'=>$validatedData['nib'],
                                        'assunto'=>$validatedData['assunto'],
                                        'prioridade'=>$validatedData['prioridade'],
                                        'categoria'=>$validatedData['categoria'],
                                        'subcategoria'=>$validatedData['subcategoria'],
                                        'telefone1'=>$validatedData['telefone1'],
                                        'telefone2'=>$validatedData['telefone2'],
                                        'email'=>$validatedData['email'],
                                        'recorentencia'=>$validatedData['recorentencia'],

                                    ]
                                );
              ModeloEditarEstado::create([
                        'comentarios'=>"Alterou o Ticket",
                        'idsolicitacao'=>$request['idsolicitacao'],
                        'idusuario' => (!Auth::guest()) ? Auth::user()->id : null ,//user_id
                        'novoestado'=>$request['novoestado'],

              ]);              
            //Session::flash('success', 'Ticket Alterado com sucesso');
            return back()->with('success', 'Ticket Alterado com sucesso');               
            }
             

           
    }


    //reopen ticket

        public function reopenticket($id)
    {    LogActivity::addToLog('Myticket-Reopen ticket');
                        TicketTodas::where('id',$id)
                            ->update([  
                                        'status'=>"1",
                                        'data_fecho'=>null,

                                    ]
                                );
              ModeloEditarEstado::create([
                        'comentarios'=>"Abriu o Ticket",
                        'idsolicitacao'=>$id,
                        'idusuario' => (!Auth::guest()) ? Auth::user()->id : null ,//user_id
                        'novoestado'=>"1",

              ]);              
              //Session::flash('success', 'Ticket Aberto com sucesso');
            $useremail = (!Auth::guest()) ? Auth::user()->email : null ;//user_email
            //$user=User::where('ticket_notification','Yes')->where('ticket_level','!=',null)->get()->toArray();
                        $user=User::where(function($query ){
                            $query->where('ticket_level','!=',null)
                                  ->Where('ticket_level',$this->emails)
                                  ->orWhere('ticket_level',1);
                        })->where('ticket_notification','Yes')


             ->get()->toArray();

            $posts=TicketTodas::find($id);

            Mail::to($user)->cc([$useremail])->send(new NewTicket($posts));

            return back()->with('success', 'Ticket aberto com sucesso');  
    } 

        //close ticket

        

        public function closeticket(Request $request)
    {    
            $validatedData = $request->validate([
                'comentarios' => 'required'
                ],
                [
                    'comentarios.required'=>'Deve adicionar um comentario',
                ]
            );

            LogActivity::addToLog('Myticket-Close Ticket'.$request['idsolicitacao']);


                        TicketTodas::where('id',$request['idsolicitacao'])
                            ->update([  
                                        'status'=>"2",
                                        'data_fecho'=>now(),
                                        'comentario_fecho'=>$validatedData['comentarios']

                                    ]
                                );
              ModeloEditarEstado::create([
                        'comentarios'=>"Fechou o Ticket com seguinte comentario: ".$validatedData['comentarios'],
                        'idsolicitacao'=>$request['idsolicitacao'],
                        'idusuario' => (!Auth::guest()) ? Auth::user()->id : null ,//user_id
                        'novoestado'=>"2",

              ]);  

              //Session::flash('success', 'Ticket Fechado com sucesso');
            $this->emails=TicketTodas::find($request['idsolicitacao']);  
            $useremail = (!Auth::guest()) ? Auth::user()->email : null ;//user_email
            //$user=User::where('ticket_level',$posts->ticket_level)->where('ticket_notification','Yes')->get()->toArray(); 
            $user=User::where(function($query ){
                            $query->where('ticket_level','!=',null)
                                  ->Where('ticket_level',$this->emails)
                                  ->orWhere('ticket_level',1);
                        })->where('ticket_notification','Yes')


             ->get()->toArray();
             $posts=TicketTodas::find($request['idsolicitacao']);
            
            Mail::to($user)->cc([$useremail])->send(new CloseTicket($posts));
            return back()->with('success','Ticket Fechado com sucesso'); 
    } 

//category
        public function categories()
    {    LogActivity::addToLog('Myticket-categores');

            $acteticket = TicketTodas::where('status','=','1')
            ->count();

            $completticket = TicketTodas::where('status','!=','1')
            ->count();
        

        $category=Category::get();
        return view('ticket_suport.categories',compact('category','acteticket','completticket'));
    } 


         public function savecategories(CategoryRequest $request)
     {
         LogActivity::addToLog('Myticket-save categories');
        $this->validate($request, [
            'name' => 'required|unique:ticket_category',
            'time' => 'required',
            'description' =>'required',

        ]);

        Category::create($request->all());
        //Session::flash('success', 'Category successfully created');
        return back()->with('success', 'Category successfully created'); 
     }

        public function thiscategory($id)
     {
        $category=Category::find($id); 
        $acteticket = TicketTodas::where('status','=','1')
            ->count();

        $completticket = TicketTodas::where('status','!=','1')
            ->count();
        return view ('ticket_suport.thiscategory',compact('category','acteticket','completticket'));
     }

        public function updatethiscategory(TeamsUpdateRequest $request)
     {   LogActivity::addToLog('Myticket-update categories');
             $this->validate($request, [
            'name' => 'required',
            'time' => 'required',
            'description' =>'required',
            'category_id' =>'required',
            
        ]);
            Category::where('id',$request['id'])
                    ->update([
                        'name'=>$request['name'],
                        'time'=>$request['time'],
                        'description'=>$request['description'],
                        'idusuario'=>$request['idusuario'],
                    ]);
                    //Session::flash('success', 'Category successfully updated');
                    return $this->categories()->with('success', 'Category successfully updated');
     }          


//subcategory
        public function subcategories()
    {    LogActivity::addToLog('Myticket-subcategores');

            $acteticket = TicketTodas::where('status','=','1')
            ->count();

            $completticket = TicketTodas::where('status','!=','1')
            ->count();
        

        $category=Category::get();
        $subcategory=TickeSubtCategory::join('ticket_category','ticket_subcategory.category_id','ticket_category.id')
                    ->select('ticket_subcategory.*','ticket_category.name as category')
                    ->get();
        return view('ticket_suport.subcategories',compact('category','subcategory','acteticket','completticket'));
    } 


         public function savesubcategories(CategoryRequest $request)
     {
        LogActivity::addToLog('Myticket-save subcategories');
        $this->validate($request, [
            'name' => 'required|unique:ticket_subcategory',
            'time' => 'required',
            'description' =>'required',
            'category_id' =>'required',
            'file'=>'required',
            
        ]);
        TickeSubtCategory::create($request->all());
        //Session::flash('success', 'Sub-Category successfully created');
        return back()->with('success', 'Sub-Category successfully created');
     }

        public function thissubcategory($id)
     {
        $subcategory=TickeSubtCategory::find($id); 
        $acteticket = TicketTodas::where('status','=','1')
            ->count();

        $completticket = TicketTodas::where('status','!=','1')
            ->count();
        $category=Category::get();    
        return view ('ticket_suport.thissubcategory',compact('category','subcategory','acteticket','completticket'));
     }

        public function updatethissubcategory(TeamsUpdateRequest $request)
     {   LogActivity::addToLog('Myticket-update subcategories');

        $this->validate($request, [
            'name' => 'required',
            'time' => 'required',
            'description' =>'required',
            'category_id' =>'required',
            'file'=>'required',
            
        ]);
            TickeSubtCategory::where('id',$request['id'])
                    ->update([
                        'name'=>$request['name'],
                        'time'=>$request['time'],
                        'description'=>$request['description'],
                        'category_id'=>$request['category_id'],
                        'file'=>$request['file'],
                        'idusuario'=>$request['idusuario'],
                    ]);
                    //Session::flash('success', 'Sub-Category successfully updated');
                    return $this->subcategories()->with('success', 'Sub-Category successfully updated');
     }   
//endsubcategory


             public function teams()
    {
         LogActivity::addToLog('Myticket-teams');

            $acteticket = TicketTodas::where('status','=','1')
                ->count();

            $completticket = TicketTodas::where('status','!=','1')
                ->count();



        $teams=Teams::get();

        return view('ticket_suport.teams',compact('teams','acteticket','completticket'));
    } 


         public function saveteam(TeamsRequest $request)
     {
         LogActivity::addToLog('Myticket-save team');


        Teams::create($request->all());
        Session::flash('success', 'Team successfully created');
        return back();
     }

        public function thisteam($id)
     {
        $team=Teams::find($id); 
        $acteticket = TicketTodas::where('status','=','1')
            ->count();

        $completticket = TicketTodas::where('status','!=','1')
            ->count();
        return view ('ticket_suport.thisteam',compact('team','acteticket','completticket'));
     }

             public function updatethisteam(TeamsUpdateRequest $request)
     {       LogActivity::addToLog('Myticket-update team');
            Teams::where('id',$request['id'])
                    ->update([
                        'name'=>$request['name'],
                        'description'=>$request['description'],
                        'idusuario'=>$request['idusuario'],
                    ]);
                    //Session::flash('success', 'Team successfully updated');
                    return $this->teams()->with('success', 'Team successfully updated');
     } 


             public function agents()
     {   LogActivity::addToLog('Myticket-agents');

            $acteticket = TicketTodas::where('status','=','1')
            ->count();

            $completticket = TicketTodas::where('status','!=','1')
            ->count();



         $users=User::leftjoin('ticket_teams','users.ticket_level','ticket_teams.id')
                    ->select('users.*','ticket_teams.name as ticket_level')
                    ->get(); 
         $teams=Teams::get();
        return view ('ticket_suport.agents',compact('acteticket','completticket','users','teams'));
     } 

             public function addlevel(Request $request)
     {      LogActivity::addToLog('Myticket-addlevel');

            User::where('id',$request['id'])
                    ->update([
                        'ticket_level'=>$request['ticket_level'],
                        'ticket_notification'=>$request['ticket_notification'],
                    ]);
                    //Session::flash('success', 'Team successfully updated');
                    return $this->agents()->with('success', 'Team successfully updated');
     } 

             public function addteamticket(Request $request)
    {   LogActivity::addToLog('Myticket-Add team ticket');

                        TicketTodas::where('id',$request['idsolicitacao'])
                            ->update([  
                                        'ticket_level'=>$request['ticket_level'],

                                    ]
                                );
                            $level=$request->all();
              TicketTeamTime::create($level);   
              ModeloEditarEstado::create([
                        'comentarios'=>"Alterou responsabilidade para uma outra team ",
                        'idsolicitacao'=>$request['idsolicitacao'],
                        'idusuario' => (!Auth::guest()) ? Auth::user()->id : null ,//user_id
                        'novoestado'=>$request['novoestado'],
                        'ticket_level'=>$request['ticket_level'],

              ]);              
              //Session::flash('success', 'Team adicionado com sucesso');
            $this->emails=TicketTodas::find($request['idsolicitacao']);  
            //$user=User::where('ticket_level',$posts->ticket_level)->where('ticket_notification','Yes')->get()->toArray(); 
            $user=User::where(function($query ){
                            $query->where('ticket_level','!=',null)
                                  ->Where('ticket_level',$this->emails)
                                  ->orWhere('ticket_level',1);
                        })->where('ticket_notification','Yes')


             ->get()->toArray();
            $posts=TicketTodas::find($request['idsolicitacao']); 
            Mail::to($user)->send(new AddTeamTicket($posts));
            return back()->with('success', 'Team adicionado com sucesso'); 
    } 

    public function sendtoorgin(Request $request)
    {
        LogActivity::addToLog('Myticket-Send tickrt to orgin');

                TicketTodas::where('id',$request['idsolicitacao'])
                            ->update([  
                                        'status'=>$request['novoestado'],

                                    ]
                                );

                  ModeloEditarEstado::create([
                        'comentarios'=>"Renviou/Recusou o ticket",
                        'idsolicitacao'=>$request['idsolicitacao'],
                        'idusuario' => (!Auth::guest()) ? Auth::user()->id : null ,//user_id
                        'novoestado'=>$request['novoestado'],

              ]);            
        //Session::flash('success','Ticket enviado com sucesso');
            $this->emails=TicketTodas::find($request['idsolicitacao']);  
            //$user=User::where('ticket_level',$posts->ticket_level)->where('ticket_notification','Yes')->get()->toArray(); 
            $user=User::where(function($query ){
                            $query->where('ticket_level','!=',null)
                                  ->Where('ticket_level',$this->emails)
                                  ->orWhere('ticket_level',1);
                        })->where('ticket_notification','Yes')


             ->get()->toArray(); 
        $posts=TicketTodas::find($request['idsolicitacao']);     
        Mail::to($user)->send(new SendtoOrginTicket($posts));         
        return back()->with('success','Ticket enviado com sucesso');
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

        //cansel ticket
        public function conselartickitet (Request $request)
    {   LogActivity::addToLog('Myticket-Canselar criaçao do ticket iniciado');

       session()->forget('product');
       return $page=$this->newtticket();
    }


    public function deleteteamlistlevel($id,$idsolicitacao)
    {
               LogActivity::addToLog('Myticket-Apagar team da responsabilidade '.$id);

               TicketTeamTime::where('id',$id)->delete();

                  ModeloEditarEstado::create([
                        'comentarios'=>"Removeu uma team das responsabilidades",
                        'idsolicitacao'=>$idsolicitacao,
                        'idusuario' => (!Auth::guest()) ? Auth::user()->id : null ,//user_id
                        

              ]);            
        //Session::flash('success','Team removido com sucesso');
        return back()->with('success','Team removido com sucesso'); 
    }


    public function completeteamtask(Request $request)
    {           LogActivity::addToLog('Myticket-complet team task');

                TicketTeamTime::where('idsolicitacao',$request['idsolicitacao'])
                            ->where('ticket_level', (!Auth::guest()) ? Auth::user()->ticket_level : null )
                            ->update([  
                                        'status'=>"1",
                                        'comentarios'=>$request['comentarios'],

                                    ]
                                );

                  ModeloEditarEstado::create([
                        'comentarios'=>"Concluio uma tarefa com seguinte comentario: ".$request['comentarios'],
                        'idsolicitacao'=>$request['idsolicitacao'],
                        'idusuario' => (!Auth::guest()) ? Auth::user()->id : null ,//user_id
                        'novoestado'=>$request['novoestado'],

              ]);            
        //Session::flash('success','Tarefa Concluida com sucesso');


        return back()->with('success','Tarefa Concluida com sucesso');
    }

         public function addfiles(Request $request, $anexo)
    {
        $product = $request->session()->get('product');

        if(isset($product->productImg)) {

            $request->validate([
                'filetype' => 'required',
                'productimg' => 'required',
                'productimg.*' => 'mimes:jpeg,png,pdf|max:10000',
            ],
            [
                'productimg.*.mimes'=>'O formato do ficheiro deve ser: jpeg,png,pdf',
                'productimg.*.max'=>'O formato do ficheiro deve ter no maximo 10MB',
                'productimg.required'=>'É necessario um anexo no formato jpeg,png,pdf, de no maximo 10MB',
            ]
        );


            foreach($request->file('productimg') as $key=>$file)
            {
                
                $name="productImage-" . time() . '-'.$key.'.'. $file->getClientOriginalExtension();
                $file->storeAs('productimg', $name);
                $file= new Files();
                $file->filename=$name;
                $file->namesolicitacao=$anexo;
                $file->filetype=$request->filetype[$key];
                $file->save();

            }


            return back();


        }

    }


        public function editeaddfiles(Request $request)
    {
        if (isset($request)) {
        $this->validate($request,[
                                'filetype' => 'required',
                                'productimg' => 'required',
                                'productimg.*' => 'mimes:jpeg,png,pdf|max:10000',
                                'oldpdf'=>'required',
                            ],
                            [
                                'productimg.*.mimes'=>'O formato do ficheiro deve ser: jpeg,png,pdf',
                                'productimg.*.max'=>'O formato do ficheiro deve ter no maximo 10MB',
                                'productimg.required'=>'É necessario um anexo',
                                'oldpdf.required'=>'É necessario que a sua submissão estejá associada há um ticket',
                            ]
                        );


            foreach($request->file('productimg') as $key=>$file)
            {
                
                $name="productImage-" . time() . '-'.$key.'.'. $file->getClientOriginalExtension();
                $file->storeAs('productimg', $name);
                $file= new Files();
                $file->filename=$name;
                $file->namesolicitacao=$request->oldpdf;
                $file->filetype=$request->filetype[$key];
                $file->save();

            }
                        ModeloEditarEstado::create([
                        'comentarios'=>"Adicionou um novo anexo: ".$name,
                        'idsolicitacao'=>$request['idsolicitacao'],
                        'idusuario' => (!Auth::guest()) ? Auth::user()->id : null ,//user_id
                        'novoestado'=>$request['novoestado'],

              ]);               
            //Session::flash('success', 'Ticket Alterado com sucesso');


            return back()->with('success', 'Ticket Alterado com sucesso');
        }


        

    }

            public function documentindex(Request $request )
    {   LogActivity::addToLog('Myticket-documentindex');
        $documents = TickeDocument::orderBy('id','DESC')->paginate(500);
        return view('ticket_suport.documentindex',compact('documents'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


        public function documentcreateticket(Request $request )
    {    LogActivity::addToLog('Myticket-documentcreateticket');
        $subcategories = TickeSubtCategory::orderBy('id','DESC')->paginate(500);
        return view('ticket_suport.documentcreate',compact('subcategories'));
    }

        public function documentstore(Request $request,TicketDocumentHasSubCategores $ticketdocumenthassubcategores, TickeDocument $tickedocument)
    {    LogActivity::addToLog('Myticket-documentstore');
        $this->validate($request, [
            'name' => 'required|unique:ticket_document,name',
            'subcategores_id' => 'required',
        ]);


        $tickedocument->fill(['name' => $request->input('name')])->save();
        $document_id=$tickedocument->id; //Set  id here
        $data=$request->input('subcategores_id');

        foreach ($data as $key => $cil) {
        $ticketdocumenthassubcategores->create(['document_id' => $document_id,
                                              'subcategores_id'=>$cil, 
                                            ]);

        }

        return redirect()->route('document.index')
                        ->with('success','Document created successfully');
    }

        public function documentshow($id)
    {   LogActivity::addToLog('Myticket-documentshow');
        $document = TickeDocument::find($id);
        $subcategories = TicketDocumentHasSubCategores::join("ticket_subcategory","ticket_document_has_subcategores.subcategores_id","=","ticket_subcategory.id")
            ->where("ticket_document_has_subcategores.document_id",$id)
            ->get();

        return view('ticket_suport.documentshow',compact('document','subcategories'));
    }


        public function documentedit($id)
    {    LogActivity::addToLog('Myticket-documentedit');
        $document = TickeDocument::find($id);
        $subcategores_id = TickeSubtCategory::get();
        $documentSubcategories = DB::table("ticket_document_has_subcategores")->where("ticket_document_has_subcategores.document_id",$id)
            ->pluck('ticket_document_has_subcategores.subcategores_id','ticket_document_has_subcategores.subcategores_id')
            ->all();


        return view('ticket_suport.documentedit',compact('document','subcategores_id','documentSubcategories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function documentupdate(Request $request, $id,TicketDocumentHasSubCategores $ticketdocumenthassubcategores, TickeDocument $tickedocument)
    {    LogActivity::addToLog('Myticket-update document');
        $this->validate($request, [
            'name' => 'required',
            'subcategores_id' => 'required',
        ]);


        $document = TickeDocument::find($id);
        $document->name = $request->input('name');
        $document->save();
        $data=$request->input('subcategores_id');

        $ticketdocumenthassubcategores->where('document_id',$id)->delete();

        foreach ($data as $key => $cil) {
        $ticketdocumenthassubcategores->create(['document_id' => $id,
                                              'subcategores_id'=>$cil, 
                                            ]);

        }



        return redirect()->route('document.index')
                        ->with('success','Document updated successfully'); 
    }


    public function searchsubcategory(Request $request)

{

if($request->ajax())
{
$output="";

$data=TickeSubtCategory::where('category_id',$request->search)->get();

if($data)
{   foreach ($data as $key => $cil) {
    $output.='<option value="'.$cil->id.'">' .$cil->name.'</option>';
    }

    return Response($output);
}
}
}



    public function searchLoanid(Request $request)
    {   
         LogActivity::addToLog('Myticket-searchLoanid');


        $term = $request->get('search');
 
        if ( ! empty($term)) {
 
            // search loan  by loanid or nuit
            $loans = PaymentPlan::where('LoanID', 'LIKE', '%' . $term .'%')
                            ->orWhere('ClientIDNumber', 'LIKE', '%' . $term .'%')
                            ->orwhere('ClientID','LIKE','%'.$term.'%')
                            ->get();
 
            foreach ($loans as $loan) {
                $loan->label   = $loan->ClientFirstNames.' '.$loan->ClientSurname . ' (' . $loan->LoanID .': '.$loan->LoanAmount. ')';
            }
 
            return $loans;
        }
 
        return Response::json($loans);
    }



}
