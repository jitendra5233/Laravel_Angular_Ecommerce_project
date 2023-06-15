<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\User;
use App\Models\Ace\RoleModel;

class LoginBasic extends Controller
{
  public function index()
  {
    if(session('isLogin') == 'ok'){
      return redirect('/dashbord');
    }else{
      return view('content.authentications.auth-login-basic')->with('loginError','');
    }
  }

  public function postLogin(Request $req){
    $result = User::where('email',$req->email)->where('password',md5($req->password))->get();
    if(count($result) == 1){
      $id = $result[0]->id;
      $token = md5($req->email).rand();
      session(['token' => $token]);
      session(['loginStatus' => 'true']);
      session(['isLogin' => 'ok']);
      User::where('id',$id)->update(['token'=>$token]);
      $userData = User::where('token',$token)->get();
      session(['fname' => $userData[0]->first_name]);
      session(['lname' => $userData[0]->last_name]);
      session(['photo' => $userData[0]->photo]);
      session(['email'=> $userData[0]->email]);
      session(['phone'=> $userData[0]->phone]);
      session(['id'=> $userData[0]->id]);
      session(['role' => $this->getRoleName($userData[0]->role)]);
      session(['roleId' => $this->getRoleIds($userData[0]->role)]);
      // return $userData[0];
      return redirect('/dashbord');
    }else{
      return view('content.authentications.auth-login-basic')->with('loginError','1');
    }
  }


  public function logout(Request $req){
    $token = session('token');
    $result = User::where('token',$token)->update(['token'=>'']);
    session(['token' => '']);
    session(['loginStatus' => 'false']);
    session(['isLogin' => 'no']);
    return redirect('/');
  }

  public function getRoleName($id){
    $data = RoleModel::where('id',$id)->get();
    return $data[0]->name;
  }

  public function getRoleIds($id){
    $data = RoleModel::where('id',$id)->get();
    return $data[0]->access;
  }
}
  