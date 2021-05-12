<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use App\Models\Appointment;
use App\Models\Users_roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class getDataFromUrlController extends Controller
{

    // get data from url in form of xml 
    public function test(){
        $data = file_get_contents('https://healthcareandprotection.com/news/feed/.');
        $xml = simplexml_load_string($data, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        $feeds=$array['channel']['item'];

        function get_string_between($string, $start, $end){
            $string = $string;
            $ini = strpos($string, $start);
            // if ($ini == 0) return '';
            $ini += strlen($start);
            $len = strpos($string, $end, $ini) - $ini;
            return substr($string, $ini, $len);
        }

        foreach($feeds as $feed){
            // dd($feed['description']);
            $btw = get_string_between($feed['description'],'src="','"');
            dd($btw);
        }
       
    }


    // Api for fetch data 
    public function formdata(){

       $Data = User::all();
       return response()->json($Data);  
    
    }

    // Api for delete data
    public function delete($id){
        
        $delete = user::where('id',$id)->delete();
        if($delete){

            return response()->json("Succefully deleted");

        }else{
            
            return response()->json(" Somthing wrong ")->setStatusCode(400);
            // return response()->json("wrong");
        }

    }

    // insert Api 
    public function insert(request $request){

        $request->validate([
            'name'=>'required |min:3',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'mobile'=>'required|regex:/[7-9][0-9]{9}/',
            'role'=>'required | min:5',
            'image' => 'required|file|mimes:jpeg,png,gif|max:2048'

            

        ],[
            'role.min'=>"Role should be selected either Advisor Or Client."
        ]);

        if($file = $request->file('image')){
            $name = $file->getClientOriginalName();
            $newname = rand(10000,99999).$name;

            if($file->move('upload',$newname)){

                
        User::insert([
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
                return response()->json("Successfully Inserted Data ");
            }else{
                return  response()->json("some thing while inseting data ")->setStatusCode(422);
            }
 

            }else{
                return response()->json("Some thing Wrong While Uploading File ")->setStatusCode(422);
            }
        }else{
            return response()->json(" File Should be Added ")->setStatusCode(400);
        }
        
          

        }


                // udate api
        public function update(request $request){

            $request->validate([
            'name'=>'required |min:3',
            // 'email'=>'required|email',
            'mobile'=>'required|regex:/[7-9][0-9]{9}/',
            'image' => 'file|mimes:jpeg,png,gif|max:2048'
            ]);
               

            
            if($file = $request->file('image')){
                $name = $file->getClientOriginalName();
                $newname = rand(10000,99999).$name;
                if($file->move("upload",$newname)){
    
                    $update = User::where('id','=',$request->id)->update([
                        'name'=>$request->name,
                        // 'email'=>$request->email,
                        'mobile'=>$request->mobile,
                        'image'=>$newname,
        
                    ]);
                    if($update){
        
                        return response()->json('update user Successfully 1');
                    }else{
                        return response()->JSON('something wrong try again 1')->setStatusCode(400);
                    }
    
                }else{
                    return response()->json('something wrong try again 2')->setStatusCode(400);
                }
            }else{
                $update = User::where('id','=',$request->id)->update([
                    'name'=>$request->name,
                    // 'email'=>$request->email,
                    'mobile'=>$request->mobile,
    
                ]);
                if($update){
    
                    return response()->json('update user Successfully ');
                }else{
                    return response()->JSON('something wrong try again 3')->setStatusCode(400);
                }
            }
           
     }

}