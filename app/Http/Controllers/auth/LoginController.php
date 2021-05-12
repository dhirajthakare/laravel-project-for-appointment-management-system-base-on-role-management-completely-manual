<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\Users_roles;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




class LoginController extends Controller
{

    public function login(){

        return view('Auth.login');
    }

    public function check(request $request){

        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6',
         
        ]);

        // $userinfo = User::where('email','=',$request->input('email'))->first();

        // if(!$userinfo){
        //     return redirect()->back()->with('fail','User is Not Exist In Database');
        // }else{
        //      //check password
        //      if(Hash::check($request->input('password'), $userinfo->password)){

        //             $checkrole = Users_roles::where('users_id','=',$userinfo->id)->first();
        //             // dd($checkrole);
        //             // if($checkrole->roles_id==1){

        //                 session()->put('LoggedUser',$userinfo->id);
        //                     return redirect('advisor/dashboard');

        //             // }elseif($checkrole->roles_id==2){
                        
        //             //     session()->put('ClientLoggedUser',$userinfo->id);
        //             //         return redirect('client/dashboard');

        //             // }else {
                        
        //             //      return redirect()->back()->with('fail' , 'Somthing problem Please try Again');
        //             // }
              
        //      }else{
        //         return redirect()->back()->with('fail',' Password Incorrect');
        //     }
        // }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $userinfo = User::where('email','=',$request->input('email'))->first();
            session()->put('LoggedUser',$userinfo->id);
            return redirect('dashboard');

            // if(Auth::user()->hasRole('Advisor')==true){
            //     return "it is Advisor ";
            // }else{
            //     ''
            // }
            // if(Auth::user()->hasRole('Client')==true){
            //         return "it is client ";
                
            // }

        
        }else{
               return redirect()->back()->with('fail',' Password or Username Incorrect');

        }
    }

    public function logout(){
        
        if(session()->has('LoggedUser')){

            session()->pull('LoggedUser');
            return redirect('/');
            
        }else{
            return redirect('auth/login');

        }
    }
    
   
}
