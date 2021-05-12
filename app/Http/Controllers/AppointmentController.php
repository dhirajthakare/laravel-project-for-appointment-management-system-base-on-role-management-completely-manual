<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;

use App\Models\Appointment;
use App\Models\Users_roles;
use Illuminate\Http\Request;
use GrahamCampbell\ResultType\Result;

class AppointmentController extends Controller
{
    public function getapp(Request $request){
        $todayDate = date('m/d/Y');
        $request->validate([
            'noPerson'=>'required|numeric|gt:0|lt:11',
            'advisorId'=>'required|numeric',
            'mobile' => 'required|regex:/^[7-9][0-9]{9}$/',
            'bookingDate'=>'required|after_or_equal:'.$todayDate,
        ],[
            'advisorId.numeric'=>"Please Select Advisor ",
            'bookingDate.required'=>'Please select Appointment Date ',
            'bookingDate.after_or_equal'=>'You Can not select past date for appointment ',

        ]);
        // dd($request->input());

        $create = Appointment::create($request->input());
        if($create){
            return redirect('appointment')->with('success','Your appointment successfully schedule now you can check Appointment status ');
        }else{
            return redirect('appointment')->with('fail',' Something wrong please try again ');
        }

    }

    public function appointment(){
      
        $checkrole = Users_roles::where('users_id','=',session(('LoggedUser')))->first();
        $data = ['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))->first()];

                    if($checkrole->roles_id==1){

                    //     $data = ['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))->first()];
                    //  return view('Advisor.appointment',$data);
                    return redirect()->back();

                 }elseif($checkrole->roles_id==2){
                    $role = Roles::where('name','=','Advisor')->with('advisors')->get();
                    // dd($role);
                    return view('Client.appointment',compact('role'),$data);

                 }
    }
    public function appointmentInfo(){
      
        $checkrole = Users_roles::where('users_id','=',session(('LoggedUser')))->first();
        $data = ['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))->first()];
                    if($checkrole->roles_id==1){
                    //    return redirect()->back();
                    // dd($data);
                    $appointments = Appointment::where('advisorId','=',$data['LoggedUserInfo']->id)->with('Advisor','Client')->get();
                    
                    return view('Advisor.appointment',compact('appointments'),$data);

                 }elseif($checkrole->roles_id==2){
                    $appointments = Appointment::where('clientId','=',$data['LoggedUserInfo']->id)->with('Advisor','Client')->get();
                    // dd($appointments);
                    return view('Client.appointmentInfo',compact('appointments'),$data);

                 }
    }
    public function delete($id){

        $checkrole = Users_roles::where('users_id','=',session(('LoggedUser')))->first();
        if($checkrole->roles_id==2){

            $delete =Appointment::where('id','=',$id)->delete();
            if($delete){
                return redirect('appointmentInfo')->with('success',' Your Appointment Deleted ');
            }else {
                return redirect('appointmentInfo')->with('fail',' Somthing wrong ');
            }
        }else {
            return back();
        }
       

    }

    // composer require barryvdh/laravel-debugbar --dev
    public function update(Request $request){
        
        // dd($request->input());

        $checkrole = Users_roles::where('users_id','=',session(('LoggedUser')))->first();
        if($checkrole->roles_id==1){
        $user = Appointment::where('id','=',$request->token)->update(['status'=>$request->status]);
        if($user){
            // return redirect('appointmentInfo')->with('success','Client status change');
            return 'Client status change';

        }else{
            // return redirect('appointmentInfo')->with('fail','Something wrong try again');
            return 'Something wrong try again';

        }
    }elseif($checkrole->roles_id==2){

        return back();
        
    }
}

}
