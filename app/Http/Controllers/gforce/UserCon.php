<?php

namespace App\Http\Controllers\gforce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gforce\UserMod;
use App\Models\Gforce\ForgotPassModel;

class UserCon extends Controller
{
    public function signup(Request $req){
        
        $file = $req->file('profile_img');
        $filename = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('uploadImages/users/', $filename); 
        
        $data = new UserMod();
        $data->firstname = $req->fName;
        $data->middlename = $req->mName;
        $data->lastname = $req->lName;
        $data->email = $req->email;
        $data->dob = $req->dob;
        $data->phone = $req->pNumber;
        $data->address = $req->address;
        $data->password = $req->password;
        $data->gender = $req->gender;
        $data->image = $filename;
        $data->type = $req->type;
        $res = $data->save();
        return $res;
    }

    public function signin(Request $req){
        $res = UserMod::where('email',$req->email)->where('password',$req->password)->get();

        UserMod::where('email',$req->email)->where('password',$req->password)->update([
            "token" => $req->token,
        ]); 

        $res = UserMod::where('email',$req->email)->where('password',$req->password)->get();
        return $res;
    }
    
    public function getProfile(Request $req){
        $res = UserMod::where('token',$req->token)->get();
        return $res;
    }
    
    public function updateUser(Request $req){
        
        if($req->file != ''){
            $file = $req->file('file');
            $filename = date('YmdHi').rand().$file->getClientOriginalName();
            $file->move('uploadImages/users/', $filename); 
            
            $result  = UserMod::where('token',$req->token)->update([
                "firstname" => $req->fName,
                'middlename' => $req->mName,
                'lastname' => $req->lName,
                'email' => $req->email,
                'dob' => $req->dob,
                'phone' => $req->pNumber,
                'gender' => $req->gender,
                'address' => $req->address,
                'image' => $filename
            ]);
        }else{
            $result  = UserMod::where('token',$req->token)->update([
                "firstname" => $req->fName,
                'middlename' => $req->mName,
                'lastname' => $req->lName,
                'email' => $req->email,
                'gender' => $req->gender,
                'dob' => $req->dob,
                'phone' => $req->pNumber,
                'address' => $req->address,
            ]);
        }
        
        return $result;
    }
    
    public function handleEmailSubmit(Request $req){
        $res = UserMod::where('email',$req->email)->get()->count();
        
        
        $result = '';
        if($res != 0){
            
            $otp = rand();
            
            $email = $req->email;
            
            $data = new ForgotPassModel();
            
            $data->email = $email;
            $data->otp = $otp;
            
            $data->save();
            
            $message="
            Dear User,
            
                    Your OTP  to reset the pass is ".$otp." Never share this OTP with anyone.
                
                The Gforce  Team
            ";
            
            $result = mail($email,"Your one time OTP to reset the password !",$message); 
        }
        return $result; 
    }
    
    public function handleOtpSubmit(Request $req){
        $data = ForgotPassModel::where('email',$req->email)->where('otp',$req->otp)->get()->count();
        return $data;
    }
    
    public function handleNewPSubmit(Request $req){
        
        $result = UserMod::where('email',$req->email)->update([
            "password" => $req->password,
        ]);
        
        return $result;
        
    }
    
    public function submitnewsletter(Request $req){
        return 1;
    }
}
