<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\UserModel;
use App\Models\Ace\RoleModel;
use App\Models\Ace\AgentTimeSlotModel;
class User extends Controller
{
    public function index(){
        $role = RoleModel::all();
        return view('content.Users.AddUser')->with('role',$role);
    }

    public function AllUserView(){
        // $users = UserModel::orderBy('id', 'ASC')->paginate(5);
        $users = UserModel::all();
        foreach($users as $row){
            $row['roleName'] = RoleModel::where('id',$row['role'])->get()[0]->name;
        }
        

        return view('content.Users.AllUsers')->with('users',$users);
    }


    public function Submituser(Request $req){

       

        $user=UserModel::where('email',$req->email)->count();
        if($user == 0)
        {
            $file = $req->file('photo');
            $filename = date('YmdHi').rand().$file->getClientOriginalName();
            $file->move('users/images', $filename);
            $data = new UserModel;
            $data->first_name = $req->firstName;
            $data->last_name = $req->lastName;
            $data->password	 = md5($req->password);
            $data->token = '';
            $data->email = $req->email;
            $data->phone = $req->phone;
            $data->photo = $filename;
            $data->role = $req->role;
            $data->designation=$req->designation;
            $data->location=$req->location;
            $data->specialty=$req->specialty;
            $data->department=$req->department;
            $data->status=$req->status;
            $res = $data->save();
            return $res;
        }
            else{
                return 0;
            }

    }

    public function ShowAgentTimeSlot(){
        $allAgents = UserModel::all();
        return view('content.Users.AgentTimeSlots')->with('allAgents',$allAgents);
    }

    public function GetAgentTimeSlot(Request $req){
        $data = AgentTimeSlotModel::where('userId',$req->id)->orderBy('id', 'DESC')->get();
        if(count($data) == 0){
            return count($data);
        }else{
            return $data;
        }
    }

    public function SubmitAgentTimeSlot(Request $req){
        $data = new AgentTimeSlotModel;
        $data->userId = $req->id;
        $data->dataJson = $req->TimeObj;
        $result = $data->save();
        return $result;
    }

   
    public function Edituser($id)
    {

        $user = UserModel::where('id',$id)->get();
        $rolename=RoleModel::where('id',$user[0]->role)->get();
        $role= RoleModel::all();
        return view('content.Users.EditUser')->with('role',$role)->with('rolename',$rolename[0])->with('user',$user[0]); 
    }

    public function updateuser(Request $req)
    {

        $file = $req->file('formFile');
        if(!empty($file)){
            $filename = date('YmdHi').rand().$file->getClientOriginalName();
            $file->move('users/images', $filename);
            $result = UserModel::where("id",$req->userid)->update([
                "first_name" => $req->firstName,
                "last_name" => $req->lastName,
                "token" => '',
                "email" => $req->email,
                "phone" => $req->phone,
                "role" => $req->role,
                "photo" => $filename,
                "designation" =>$req->designation,
                "specialty" => $req->specialty,
                "department" => $req->department,
                "location" => $req->location,
                "status" => $req->status
                ]); 
        }
        else{
            $result = UserModel::where("id",$req->userid)->update([
                "first_name" => $req->firstName,
                "last_name" => $req->lastName,
                "token" => '',
                "email" => $req->email,
                "phone" => $req->phone,
                "role" => $req->role,
                "photo" =>$req->oldimage,
                "designation" =>$req->designation,
                "specialty" => $req->specialty,
                "department" => $req->department,
                "location" => $req->location,
                "status" => $req->status
                ]); 
        }
        return redirect('/user-all');
        
    }

    public function Deleteuser(Request $req)
    {
        $result = UserModel::where('id',$req->id)->delete();
        return $result;
    }

    public function GetUser_single_data($id)
    {
    
        $users = UserModel::where('id',$id)->get();
        foreach($users as $row){
            $row['roleName'] = RoleModel::where('id',$row['role'])->get()[0]->name;
        }
        return view('content.Users.SingleUserView')->with('users',$users);
        
    }
}

