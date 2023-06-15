<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\RoleModel;

class Role extends Controller
{
    public function index(){
        // test
        return view('content.Role.AddRole');
    }

    public function AllRoleView(){
        $data = RoleModel::orderBy('id', 'DESC')->get();
        $newArr = [];
        foreach($data as $r){
            if($r->name != 'Admin'){
                $newArr[] = $r;
            }
        }
        return view('content.Role.AllRole')->with('tableData',$newArr);
    }

    public function Submitrole(Request $req){
        $data2 = json_decode($req->access);
        $data2 = json_encode($data2);
        
        $data = new RoleModel;
        $data->name = $req->roleName;
        $data->access = $data2;
        $res = $data->save();
        return $res;
    }

    public function viewRole($id){
        $row = RoleModel::where('id',$id)->get();
        return view('content.Role.ViewRole')->with('row',$row[0]);
    }

    public function updateRole(Request $req){
        $data = json_decode($req->access);
        $data = json_encode($data);
        $result = RoleModel::where('id',$req->id)->update(['name' => $req->name,'access' => $data]);
        return $result;
    }
}
