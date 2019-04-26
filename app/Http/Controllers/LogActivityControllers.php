<?php


namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Helpers\LogActivity;
use Carbon\Carbon;

class LogActivityControllers extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:admin-logatracker');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function myTestAddToLog()
    {
        LogActivity::addToLog('My Testing Add To Log.');
        dd('log insert successfully.');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function logActivity()
    {
        //LogActivity::addToLog('Admin-Lista de actividades');
        
        $logs = LogActivity::logActivityLists();

        return view('admin.logActivity',compact('logs'));
    }
}