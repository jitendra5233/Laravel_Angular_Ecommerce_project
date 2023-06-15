<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\ForgetPassModel;
use App\Models\Ace\UserModel;

class ForgotPasswordBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-forgot-password-basic');
  }


  public function Sendmail(Request $req)
  {

      $uniqueid =$req->uniqcode;
      $emailid =$req->email;
      $message="
      Hello, 

      Here is your OTP if you forgot your password. To complete your password reset please enter the OTP - ".$uniqueid.".

      
      The Ace Capital  Team
      ";
     $result=mail($emailid,"Forget Password Unique Code Don't Share With Anyone",$message);

     if($result == 1)
     {
          $Pass = new ForgetPassModel;
          $Pass->email = $emailid;
          $Pass->uniqcode = $uniqueid;
          $Pass->save(); 
     }

     return $result;

  }



    public function ChnagePassword()
  {
  return view('content.ChnagePassword.ChnagePassword');
}

public function UpdatePassword(Request $req)
{

$data = ForgetPassModel::where('email',$req->email)->where('uniqcode',$req->uniqcode)->get();
  if(count($data) != 0){
     $result =1;
  }

  else{
  $result =0;
  }
  return $result;

}

public function ChnageupdatePassword(Request $req)
{

  $password=md5($req->Newpass);
  $data = UserModel::where('email',$req->email)->get();
  if(count($data) != 0){
    $result = UserModel::where('email',$req->email)->update(['password' => $password]); 
    $pass = ForgetPassModel::where('email',$req->email)->delete(); 

 }

 return $result;
  
}
}
