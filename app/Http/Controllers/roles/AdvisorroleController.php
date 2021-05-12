<?php

namespace App\Http\Controllers\roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdvisorroleController extends Controller
{
    public function dashboard(){
        $data = ['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))->first()];
        return view('Advisor.dashboard',$data);
    }
    public function home(){
        return view('Advisor.home');
    }


}
