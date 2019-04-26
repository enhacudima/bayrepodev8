<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\UserTypes;

use Auth;
use Hashids;
use Redirect;
use Request;
use Hash;

class UserController extends Controller

{
    public function index(){
        $users = User::get();
        return view('users.index', compact('users'));
    }

    public function getAdd(){
        $user_type = UserTypes::pluck('user_type', 'id');
        return view('users.add', compact('user_type'));
    }

    public function postAdd(){
        $input = Request::all();
        $password = str_random(8);
        $user = User::create(
            'email' => $input['email'],
            'password' => Hash::make($password),
            'first_name' => $input['first_name'],
            'surname' => $input['surname'],
            'phone_number' => $input['phone_number'],
            'user_type' => $input['user_type'],
        );

        return Redirect::action('UserController@index');
    }

    public function getEdit($id){

    }

    public function postEdit($id){

    }

    public function delete($id){
        User::find(current(Hashids::decode($id)))->delete();
        return Redirect::action('UserController@index');
    }
}