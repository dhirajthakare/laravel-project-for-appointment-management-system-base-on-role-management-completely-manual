<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\Users_roles;
use Illuminate\Support\Facades\Hash;



class RegisterController extends Controller
{
    public function register(){
        return view('Auth.register');
    }
    public function create(request $request){

        $request->validate([
            'name'=>'required |min:3',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'mobile'=>'required|regex:/[7-9][0-9]{9}/',
            'role'=>'required | min:5',
            'image' => 'file|required|mimes:jpeg,png,gif|max:2048'

        ],[
            'role.min'=>"Role should be selected either Advisor Or Client."
        ]);

        ;
        if($file = $request->file('image')){
            $name = $file->getClientOriginalName();
            $newname = rand(10000,99999).$name;
            if($file->move("upload",$newname)){

        User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'password'=>Hash::make($request->input('password')),
            'image'=>$newname,


        ]);

        $rolesid = Roles::where('name','=',$request->input('role'))->first();
        $userid = User::where('email','=',$request->input('email'))->first();
        
        $save = Users_roles::create([
            'users_id'=>$userid->id,
            'roles_id'=>$rolesid->id,
        ]);
            if($save){
                return redirect()->back()->with('success','new data successfully added in database');
            }else{
                return redirect()->back()->with('fail','something went wrong please try again later');
            }
        }else{
            return redirect()->back()->with('fail','something wrong try again ');
        }
}else{
    return redirect()->back()->with('fail','something wrong try again ');
}
    }
    
}
