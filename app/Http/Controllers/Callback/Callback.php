<?php

namespace App\Http\Controllers\Callback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\CallbackModel;

class Callback extends Controller
{
    public function Index(){
        $tableData = CallbackModel::orderBy('id', 'DESC')->get();
        return view('content.Callback.CallbackView')->with('tableData',$tableData);
    }

    public function addCallback(Request $req){
        $data = new CallbackModel;
        $data->name = $req->name; 
        $data->last_name = $req->lname;
        $data->email = $req->email; 
        $data->phone = $req->phone;
        $data->purpose = $req->purpose;
        $result = $data->save();
        return $result;
    }
    public function Getcallbackdata($id)
    {
        $callback=CallbackModel::where('id',$id)->get()[0];
        return view('content.Callback.ViewCallback')->with('callback',$callback);
    }
    
    public function saveBookVisit(Request $req){
        $data = new CallbackModel;
        $data->name = $req->fname; 
        $data->last_name = $req->lname;
        $data->email = $req->email; 
        $data->phone = $req->phone;
        $data->purpose = $req->purpose;
        $result = $data->save();
        return $req;
    }
}
