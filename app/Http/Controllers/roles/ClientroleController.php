<?php

namespace App\Http\Controllers\roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ClientroleController extends Controller
{
    public function dashboard(){
        $data = ['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))->first()];
        return view('Client.dashboard',$data);
    }

public function home(){
    return view('Client.home');
}
}
// hello everyone hello maxine hello declane today i am working on 
// procuretech project base on feedback points and shakti assinsiting in that
// and thank you 