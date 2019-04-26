<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use App\Helpers\LogActivity;
use Spatie\Permission\Models\Permission;
use Auth;
use App\User;

class UsersListController extends Controller
{
	    public function construct()
    {
        $this->middleware('permission:user-profile', ['only' => ['showprofile']]);
    }


    public function showprofile()
    {

        $id = (!Auth::guest()) ? Auth::user()->id : null ;//user_id

        $user = User::leftjoin('province','users.city','province.province_id')
                ->leftjoin('agencia','users.branch','agencia.id_agencia')
                ->select('users.*','province.name as city','agencia.outletSyncNameCorrected as branch')
                ->find($id);

        return view('users.userprofile',compact('user'));
    }
}