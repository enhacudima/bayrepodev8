<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(


);
//auth controller
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('products','ProductController');
    Route::get('user-profile','UsersListController@showprofile');
});

Route::post('/login', [
    'uses'          => 'Auth\LoginController@login',
    'middleware'    => 'checkstatus',
]);




//SMS reset password
Route::post('/resetpassword','AuthSendsPasswordResetSmsController@sendResetLinkSms');
Route::post('/resetpasswordform','AuthSendsPasswordResetSmsController@resetpasswordform');
Route::post('/reset','AuthSendsPasswordResetSmsController@reset');
Route::get('/reset','AuthSendsPasswordResetSmsController@reset');

Route::get('/resertform',function(){
	return view('auth.passwords.codereset');
});
//and sms reset password
//Update phone number
Route::get('/updatephone',function(){
	return view('auth.updatephone');
});
Route::post('/enviarsmsphone','HomeController@enviarsmsphone');
Route::post('/confirmupdatephone','HomeController@confirmupdatephone');
//and update phone
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/homefuncionario', 'HomeFuncionarioController@index')->name('homefuncionario');
Route::get('/homesal', 'HomesalController@index')->name('homesal');

Route::get('/funcionarionovo', 'HomesalController@funcionarionovo')->name('funcionarionovo');
Route::post('/savefuncionario','HomesalController@savefuncionario');
Route::get('/savefuncionario','HomesalController@savefuncionario')->name('savefuncionario');

Route::get('/settings', 'SettingsController@index')->name('settings');

Route::get('/listuser','ListUserController@index')->name('listuser');
Route::get('/listuserdelete','ListUserController@indexdelete')->name('listuserdelete');
Route::get('/changePassword','ListUserController@showChangePasswordForm');
Route::post('/changePassword','ListUserController@changePassword')->name('changePassword');

Route::get('/edituser/{id}','ListUserController@edituser');
Route::get('/editpassword/{id}','ListUserController@editpassword');
Route::post('/edituserfinal/{id}','ListUserController@update');
Route::post('/updatepassword/{id}','ListUserController@updatepassword');
Route::get('/edituserfinal/{id}','ListUserController@update')->name('edituserfinal');

Route::get('/delete/{id}','ListUserController@deleteuser');
Route::get('/activ/{id}','ListUserController@activeuser');

Route::get('/leveluser','ListUserController@leveluser')->name('leveluser');
Route::post('/editleveluser','ListUserController@editleveluser');
Route::get('/editleveluser','ListUserController@editleveluser')->name('editleveluser');

Route::get('/registra','ListUserController@registra')->name('registra');

Route::post('/editleveluser','ListUserController@editleveluser');
Route::get('/editleveluser','ListUserController@editleveluser')->name('editleveluser');

Route::get('/searchinfo','HomeController@search');
Route::get('/searchsal','HomesalController@search');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/recibos/{value1}/{value2?}','RecibosController@index');
Route::get('/filtrrecibo','RecibosController@filtrrecibo');

Route::get('/downloadPDF/{id}','RecibosController@downloadPDF');
Route::get('/grupdownloadPDF/{value1}/{value2?}','RecibosController@grupdownloadPDF');


Route::get('/selection','RecibosController@seleciona')->name('selection');
Route::get('/agencias','RecibosController@search');


Route::get ('/paymentPlan','PaymentPlanController@index')->name ('paymentPlan');

Route::get('/searchinformation','PaymentPlanController@searchinformation');

Route::get('/searchdetails','PaymentPlanController@searchdetails');



Route::get('/importdata', 'PaymentPlanController@importdata')->name('importdata');

Route::post('import', 'PaymentPlanController@import')->name('import');


Route::get('file-download', 'FileDownloadController@index')->name('file-download');


//ticket suport get
Route::get('/myticket','TicketController@myticket');
Route::get('/committicket','TicketController@committicket');
Route::get('/completticket','TicketController@completticket');
Route::get('/newtticket','TicketController@newtticket');
Route::get('/form-ticket-a','TicketController@aformstep');
Route::get('/form-ticket-b','TicketController@bformstep');
//voltar
Route::get('/form-ticket-a-back','TicketController@aformback');
Route::get('/form-ticket-b-back','TicketController@bformback');

Route::get('/form-ticket-b-1','TicketController@bformstep1');
Route::get('/form-ticket-a-1','TicketController@aformstep1');
Route::get('/form-ticket-a-2','TicketController@aformstep2');
Route::get('/form-ticket-b-2','TicketController@bformstep2');

//ticket suport post
Route::post('/create-step-a1', 'TicketController@createStepa1');
Route::post('/create-step-b1', 'TicketController@createStepb1');
Route::post('/create-step-a2', 'TicketController@createStepa2');
Route::post('/create-step-b2', 'TicketController@createStepb2');

//remover anexo form a
Route::get('/remove-anexo-form-a/{anexo}', 'TicketController@removeanexo')->name('remove-anexo-form-a');
Route::post('/remove-anexo-form-a/{anexo}', 'TicketController@removeanexo')->name('remove-anexo-form-a');
//remover anexo form b
Route::get('/remove-anexo-form-b', 'TicketController@removeanexob')->name('remove-anexo-form-b');
Route::post('/remove-anexo-form-b', 'TicketController@removeanexob')->name('remove-anexo-form-b');

//gravar
Route::post('/gravar', 'TicketController@gravar');

//ver ticket
Route::get('/viewthisticket/{id}','TicketController@viewthisticket');

//save comment
Route::post('/savecommetticket','TicketController@savecoment');
//updat ticket
Route::post('/updateticketclient','TicketController@updateticketclient');
Route::post('/updateticketnonclient','TicketController@updateticketnonclient');

//reopen ticket
Route::post('/reopenticket/{id}','TicketController@reopenticket');
Route::post('/closeticket','TicketController@closeticket');

//Categories

//Save categories
Route::post('/savecategories','TicketController@savecategories');
//All category
Route::get('/categories','TicketController@categories');
//get to edit category
Route::get('/thiscategory/{id}','TicketController@thiscategory');
//edited thiscategory
Route::post('/updatethiscategory','TicketController@updatethiscategory');

//Agents
Route::get('/agents','TicketController@agents');
//ticket add level
Route::post('/addlevel','TicketController@addlevel');



//subCategories



//subCategories

//Save subcategories
Route::post('/savesubcategories','TicketController@savesubcategories');
//All subcategory
Route::get('/subcategories','TicketController@subcategories');
//get to edit subcategory
Route::get('/thissubcategory/{id}','TicketController@thissubcategory');
//edited thissubcategory
Route::post('/updatethissubcategory','TicketController@updatethissubcategory');

//Categories

//Save team
Route::post('/saveteam','TicketController@saveteam');
//All teams
Route::get('/teams','TicketController@teams');
//get to edit team
Route::get('/thisteam/{id}','TicketController@thisteam');
//edited thisteam
Route::post('/updatethisteam','TicketController@updatethisteam');
//Add team on ticket
Route::post('/addteamticket','TicketController@addteamticket');
//Send to Orgin
Route::post('/sendtoorgin','TicketController@sendtoorgin');

//ver detalhes na tabela
Route::get('/detalhes','TicketController@detalhes');
Route::get('/searchcabecalho','TicketController@searchcabecalho');

//cansel criation ticket
Route::get('conselartickitet','TicketController@conselartickitet');

//delect team level
Route::get('/deleteteamlistlevel/{id}/{idsolicitacao}','TicketController@deleteteamlistlevel');

//complet team task to ticket
Route::post('/completeteamtask','TicketController@completeteamtask');

//anexos
Route::get('/anexosticket/{anexo}','TicketController@anexosticket');


//files add
Route::post('/create-step-file/{anexo}','TicketController@addfiles');

//index docment
Route::get('/document.index','TicketController@documentindex')->name('document.index');

//create document
Route::get('/documentcreateticket','TicketController@documentcreateticket')->name('documentcreateticket');
//store document
Route::post('/document.store','TicketController@documentstore')->name('document.store');
//show document
Route::get('/document.show/{id}','TicketController@documentshow')->name('document.show');
//edit documet
Route::get('/document.edit/{id}','TicketController@documentedit');
//delete document
Route::patch('/document.update/{id}','TicketController@documentupdate');

//obter subcategory
Route::get('searchsubcategory','TicketController@searchsubcategory');

//editar files anexo
Route::post('editeaddfiles','TicketController@editeaddfiles');

//search lonid
Route::get('searchloanid', 'TicketController@searchLoanid');


//Painel ticket
Route::get('/ticketpainel','TicketChartController@getLaraChart');

//Report ticket
//--start
Route::get('/ticketreport','TicketReportController@index');
Route::post('/ticketreportfilter','TicketReportController@filter');
//end--


//arquivo imagesetinterpolation
Route::get('/arquivomaster','ArquivoController@arquivomaster');
Route::get('/arquivoreferencias','ArquivoController@arquivoreferencias');
Route::get('/arquivoreferencias','ArquivoController@arquivoreferencias');


Route::get('/arquivoreportindexreport','ArquivoController@arquivoreportindexreport');

Route::get('/arquivosearchinformation','ArquivoController@arquivosearchinformation');
Route::post('/arquivogravar','ArquivoController@arquivogravar');
Route::get('/arquivogravar','ArquivoController@arquivogravar')->name('arquivogravar');
Route::get('/arquivosearchformulario','ArquivoController@arquivosearchformulario');
Route::post('/arquivoreferencia','ArquivoController@arquivoreferencia');
Route::post('/arquivofiltroreport','ArquivoController@arquivofiltroreport');
Route::get('/arquivosearchnfom','ArquivoController@arquivosearchnfom');


//painel
Route::get('/arquipainel','ArquivoPainelController@arquipainel');

//admin area
Route::get('/adminarea',function(){
return view('admin.dashboard');
});
Route::get('/adminareamap',function(){
return view('admin.map');
});
Route::get('/adminareanotifications',function(){
return view('admin.notifications');
});
Route::get('/adminareatables',function(){
	            $users = DB::table('users')
            ->where('status',1)
            ->join('leveluser','users.level','=','leveluser.id')
            ->select('users.*','leveluser.discricao')
            ->orderby('name')
            ->get();
return view('admin.tables',compact(['users']));

});

Route::get('/adminareatablesdeleted',function(){
	         	$users = DB::table('users')
            ->where('status',0)
            ->join('leveluser','users.level','=','leveluser.id')
            ->select('users.*','leveluser.discricao')
            ->orderby('name')
            ->get();
return view('admin.tablesdeleted',compact(['users']));

});


Route::get('/adminarealeveluser',function(){
	         	$leveluser = DB::table('leveluser')
	            ->get();
return view('admin.leveluser',compact(['leveluser']));

});
Route::post('saveleveluser','ListUserController@saveleveluser');
Route::get('/searchbranch','ListUserController@searchbranch');

Route::get('/createuser','RegisterController@createuser');

//log Activity
Route::get('add-to-log', 'LogActivityControllers@myTestAddToLog');
Route::get('logActivity', 'LogActivityControllers@logActivity');


//start black list
Route::get('index-blacklist', 'BlackListsController@index');

Route::resource('blacklists','BlackListsController');

Route::resource('peps','PepsController');

Route::post('peps/import','PepsController@import');

Route::resource('checks','ChecksController');

Route::post('checks/upload','ChecksController@upload');

Route::get('/download/{identificador_de_bulk}','ChecksController@download');

Route::resource('branchs','BranchsController');

Route::get('search','BranchsController@search');
//and black list

//Eft 
Route::resource('eft','EftChecksController');

Route::post('eft/upload','EftChecksController@upload');

Route::get('/eft/download/{identificador_de_bulk}','EftChecksController@download');


//email sender
Route::get('sendemail', function () {
     $data = array(
        'name' => "Learning Laravel",
    );

    Mail::send('erropirmition', $data, function ($message) {

        $message->to('nhacudimaemidio@gmail.com')->subject('Learning Laravel test email');

    });
    return "Your email has been sent successfully";

});



//Notification 
Route::get('/notify', function(){
  Auth::user()->notify(new \App\Notifications\StatusLiked('Someone'));
  // Notification::send(Auth::user(), new \App\Notifications\StatusLiked('Someone'));
  return "Notification has been sent!";
});