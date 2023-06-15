<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\UserModel;

class Profile extends Controller
{
 
    public function index(Request $req)
    {
        $id = $req->session()->get('id');
        $result = UserModel::where('id',$id)->get();
        return view('content.profile.profile')->with('tableData',$result);
    }

    // public function updateprofile(Request $req)
    // {
    //     $id = $req->session()->get('id');
    //     if(!empty($req->file('photo')))
    //     {
    //         $file =$req->file('photo');  
    //         $filename = date('YmdHi').rand().$file->getClientOriginalName();
    //         $file->move('users/images', $filename);
    //         $result = UserModel::where("id",$id)->update([
    //             "first_name" => $req->first_name,
    //             "last_name" => $req->last_name,
    //             "email" => $req->email,
    //             "phone" => $req->phone,
    //             "photo" => $filename
    //             ]);
    //     }
    //     else{
    //         $result = UserModel::where("id",$id)->update([
    //             "first_name" => $req->first_name,
    //             "last_name" => $req->last_name,
    //             "email" => $req->email,
    //             "phone" => $req->phone
    //             ]); 
    //     }
        
    //     return redirect('/profile');

    // }
    public function updateprofile(Request $req)
    {
        $id = $req->session()->get('id');
        if(!empty($req->file('photo')))
        {
            $file =$req->file('photo');  
            $filename = date('YmdHi').rand().$file->getClientOriginalName();
            $file->move('users/images', $filename);
            $result = UserModel::where("id",$id)->update([
                "first_name" => $req->first_name,
                "last_name" => $req->last_name,
                "email" => $req->email,
                "phone" => $req->phone,
                "photo" => $filename
                ]);

                session()->put('fname',$req->first_name);
                session()->put('lname',$req->last_name);
                session()->put('email',$req->email);
                session()->put('phone',$req->phone);  
                session()->put('photo',$filename);  

                

        }
        else{
            $result = UserModel::where("id",$id)->update([
                "first_name" => $req->first_name,
                "last_name" => $req->last_name,
                "email" => $req->email,
                "phone" => $req->phone
                ]); 
                session()->put('fname',$req->first_name);
                session()->put('lname',$req->last_name);
                session()->put('email',$req->email);
                session()->put('phone',$req->phone);     
        }
        
        return redirect('/profile');

    }
    public function updatepassword(Request $req)
    {
      $id = $req->session()->get('id');
      $oldpass=$req->oldpass;
      $encoldpass=md5($oldpass);
      $getdata = UserModel::where('id',$id)->get();
      $password=$getdata[0]->password;
      $newpass=$req->newpass;
      $encnewpass=md5($newpass);
      if($encoldpass ==  $password)
      {
        $result = UserModel::where("id",$id)->update([
            "password" => $encnewpass
            ]); 
      }
      else
      {
        $result=0;
      }
     
      return $result;
       
    }

}
