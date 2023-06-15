<?php

namespace App\Http\Controllers\OnlineSchool;

use App\Http\Controllers\Controller;
use App\Models\Gforce\OnlineSchoolModel;

use Illuminate\Http\Request;

class OnlineSchool extends Controller
{
     public function index()
     {
        $getallOnlineSchool=OnlineSchoolModel::all();
        return view('content.OnlineSchool.OnlineSchool')->with('tableData',$getallOnlineSchool);

     }

  

     public function updateOnlineSchool(Request $req){

        $file = $req->file('image');
        if($file != ''){
        $filename = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('OnlineSchoolImage', $filename); 
        $image_path = public_path("\OnlineSchoolImage\\") .$req->oldimage;
        if (file_exists($image_path)) {
        @unlink($image_path);
        }
        }

        else{
        $filename =$req->oldimage;
        }

        $file1 = $req->file('banner_image');
        if($file1 != ''){
        $filename1 = date('YmdHi').rand().$file1->getClientOriginalName();
        $file1->move('OnlineSchoolImage', $filename1); 
        $image_path = public_path("\OnlineSchoolImage\\") .$req->oldbannerimage;
        if (file_exists($image_path)) {
        @unlink($image_path);
        }
        }

        else{
        $filename1 =$req->oldbannerimage;
        }

        $page_schema =trim($req->page_schema);
        $result = OnlineSchoolModel::where("id",$req->web_id)->update([
        "page_title" => $req->page_title,
        "title"=>$req->title,
        "description" => $req->description,
        "image" => $filename,
        "banner_image" =>$filename1,
        "page_description"=> $req->page_description,
        "page_schema" =>$page_schema,
        ]);
    
   return $result;

}
}
