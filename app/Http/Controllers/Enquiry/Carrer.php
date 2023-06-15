<?php

namespace App\Http\Controllers\Enquiry;

use App\Http\Controllers\Controller;
use App\Models\Gforce\CarrerModel;
use Illuminate\Http\Request;

class Carrer extends Controller
{
    public function index()
    {
        $tableData=CarrerModel::orderBy('id','DESC')->get();

         return view('content.Enquiry.allCarrerView')->with('tableData',$tableData);
        
    }
    public function getSingleCarrer($id)
    {
       $tableData=CarrerModel::where('id',$id)->get();
       return view('content.Enquiry.singleCarrerView')->with('carrer',$tableData);
    }
    public function DeleteCareer(Request $req)
    {
        $result=CarrerModel::where('id',$req->id)->delete();
        return $result;
        
    }
}
