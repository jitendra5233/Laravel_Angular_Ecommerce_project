<?php

namespace App\Http\Controllers\status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\PropertyStatusModel;

class PropertyStatus extends Controller
{
    public function PropertyStatus(){
        $result = PropertyStatusModel::all();

        $test = session('roleId');

        $test = json_decode($test);

        if($test->p1 != 1){
            return redirect('dashbord');
        }else{
            return view('content.Status.PropertyStatus')->with('tableData',$result);
        }

    }

    public function SavePropertyStatus(Request $req){
        $data = new PropertyStatusModel;
        $data->name = $req->name;
        $result = $data->save();
        return $result;
    }

    public function DeletePropertyStatus(Request $req){
        $result = PropertyStatusModel::where('id',$req->id)->delete();
        return $result;
    }
    public function UpdatePropertyStatus(Request $req){

        $result = PropertyStatusModel::where("id",$req->id)->update([
            "name" => $req->name
            ]); 
        return $result;
    }
}
