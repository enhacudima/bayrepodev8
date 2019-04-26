<?php


namespace App\Helpers;
use Request;
use App\LogActivity as LogActivityModel;
use App\User;


class LogActivity
{


    public static function addToLog($subject)
    {
    	$log = [];
    	$log['subject'] = $subject;
    	$log['url'] = Request::fullUrl();
    	$log['method'] = Request::method();
    	$log['ip'] = Request::ip();
    	$log['agent'] = Request::header('user-agent');
    	$log['user_id'] = auth()->check() ? auth()->user()->id : 0;
    	LogActivityModel::create($log);
    }


    public static function logActivityLists()
    {
    	return LogActivityModel::orderby('log_activities.updated_at','DESC')
                ->leftjoin('users','log_activities.user_id','=','users.id')
                ->select('log_activities.*','users.name','users.lname','users.level')
                ->paginate(17);
    }


}