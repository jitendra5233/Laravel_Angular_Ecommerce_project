<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\UserModel;
use Illuminate\Http\Request;

class User extends Controller
{
    public function SubmitUser(Request $req)
    {
    $data=new UserModel();
    $data->name =$req->name;
    $data->email =$req->email;
    $data->password=$req->password;
    $data->Cpassword =$req->Cpassword;
    $res=$data->save();
    return $res;
    }

    public function Login(Request $req)
    {

        $result=UserModel::where('email',$req->email)->where('password',$req->password)->get(); 
        if(count($result) !=0)
        {
            $res=UserModel::where('email',$req->email)->where('password',$req->password)->update([
                "token"=>$req->token,
               ]);
        }

     return $result;

    }

    public function GetProfile(Request $req)
    {
       
        $result=UserModel::where('token',$req->token)->get();
        return $result;

    }

    public function UpdateProfile(Request $req)
    {
        // return $req;
        $res=UserModel::where('id',$req->id)->update([
            "name"=>$req->name,
            "email"=>$req->email,
           ]);
           
           if($res ==1)
           {
            $result=UserModel::where('id',$req->id)->get();
           }
           return $result;

    }
  

    public function ForgetPassword(Request $req){
        $res = UserModel::where('email',$req->email)->get()->count();
        $result = '';
        if($res != 0){
            $otp = rand();
            $email = $req->email;
        
             $updatedata=UserModel::where('email',$req->email)->update([
             "otp"=>$otp,
             ]);
            
            // $message="
            // Dear User,
            
            //         Your OTP  to reset the pass is ".$otp." Never share this OTP with anyone.
                
            //     The Gforce  Team
            // ";
            
            // $result = mail($email,"Your one time OTP to reset the password !",$message); 
        }
        return $res; 
    }

    public function ValidateOtp(Request $req){
        $data = UserModel::where('email',$req->email)->where('otp',$req->otp)->get()->count();
        return $data;
    }


   public function UpdatePassword(Request $req)
   {
    $res = UserModel::where('email',$req->email)->get()->count();
    if($res !=0)
    {
        $updatedata=UserModel::where('email',$req->email)->update([
            "password"=>$req->password,
            ]);  
    }
    return $res;

   }


  
}
