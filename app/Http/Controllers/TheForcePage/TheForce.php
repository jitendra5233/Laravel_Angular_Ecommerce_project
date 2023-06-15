<?php

namespace App\Http\Controllers\TheForcePage;

use App\Http\Controllers\Controller;
use App\Models\Gforce\TheForceModel;

use Illuminate\Http\Request;

class TheForce extends Controller
{
    public function index()
    {
        $getFounder=TheForceModel::where('type','founder')->get();
        return view('content.TheForcePage.FounderView')->with('tableData',$getFounder);
    }

    public function getPerformingArtist()
    {
        $getArtist=TheForceModel::where('type','artist')->get();
        return view('content.TheForcePage.ArtistView')->with('tableData',$getArtist);  
    }

    public function getShowRunner()
    {
        $getRunner=TheForceModel::where('type','runner')->get();
        return view('content.TheForcePage.ShowRunnerView')->with('tableData',$getRunner);  
    }
    public function getChoreographers()
    {
        $getRunner=TheForceModel::where('type','choreographers')->get();
        return view('content.TheForcePage.ShowChoreographersView')->with('tableData',$getRunner);    
    }

     public function updateFounder(Request $req){
 
        $filenamesarray[]='';
        if($req->hasfile("filenames")){
            foreach($req->file("filenames") as $img) {
                $filenames = $img->getClientOriginalName();
                $img->move('TheForceMultipleImage',$filenames);
                $filenamesarray[]=$filenames;
            }

        }
        else{
            $filenamesarray=$req->oldfilenames;
        }
       
        $file = $req->file('image');
        if($file != ''){
        $filename = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('TheForceImage', $filename); 
        $image_path = public_path("\TheForceImage\\") .$req->oldimage;
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
        $file1->move('TheForceImage', $filename1); 
        $image_path = public_path("\TheForceImage\\") .$req->oldbannerimage;
        if (file_exists($image_path)) {
        @unlink($image_path);
        }
        }

        else{
        $filename1 =$req->oldbannerimage;
        }


        
        $type="founder";
        $page_schema =trim($req->page_schema);
     
            $result = TheForceModel::where("id",$req->web_id)->where('type',$type)->update([
                "name"=>$req->name,
                "type"=>$type,
                "speciality"=>$req->speciality,
                "description" =>$req->description,
                "image" => $filename,
                "banner_image" =>$filename1,
                "page_title" => $req->page_title,
                "page_description"=> $req->page_description,
                "page_schema" =>$page_schema,
                "multipleImage"=>$filenamesarray,
                "socialLinks" => $req->socialLinks,
                ]);

        
       
    
       return $result; 
}

public function getFounderData(){
   $data = TheForceModel::where('type','founder')->get();
   return $data;
}


public function updateArtist(Request $req){


    $filenamesarray[]='';
    if($req->hasfile("filenames")){
        foreach($req->file("filenames") as $img) {
            $filenames = $img->getClientOriginalName();
            $img->move('TheForceMultipleImage',$filenames);
            $filenamesarray[]=$filenames;
        }

    }
    else{
        $filenamesarray=$req->oldfilenames;
    }

    $file1 = $req->file('banner_image');
    if($file1 != ''){
    $filename1 = date('YmdHi').rand().$file1->getClientOriginalName();
    $file1->move('TheForceImage', $filename1); 
    $image_path = public_path("\TheForceImage\\") .$req->oldbannerimage;
    if (file_exists($image_path)) {
    @unlink($image_path);
    }
    }

    else{
    $filename1 =$req->oldbannerimage;
    }
    $type="artist";
    $page_schema =trim($req->page_schema);
    $result = TheForceModel::where("id",$req->web_id)->where('type',$type)->update([
    "name"=>$req->name,
    "type"=>$type,
    "description" =>$req->description,
    "banner_image" =>$filename1,
    "page_title" => $req->page_title,
    "page_description"=> $req->page_description,
    "page_schema" =>$page_schema,
    "multipleImage"=>$filenamesarray,
    ]);

   return $result; 
}


public function getArtistData(){
   $data = TheForceModel::where('type','artist')->get();
   return $data;
}


 public function updateRunner(Request $req){

        $file = $req->file('image');
        if($file != ''){
        $filename = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('TheForceImage', $filename); 
        $image_path = public_path("\TheForceImage\\") .$req->oldimage;
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
        $file1->move('TheForceImage', $filename1); 
        $image_path = public_path("\TheForceImage\\") .$req->oldbannerimage;
        if (file_exists($image_path)) {
        @unlink($image_path);
        }
        }

        else{
        $filename1 =$req->oldbannerimage;
        }

        $file2 = $req->file('image1');
        if($file2 != ''){
        $filename2 = date('YmdHi').rand().$file2->getClientOriginalName();
        $file2->move('TheForceImage', $filename2); 
        $image_path = public_path("\TheForceImage\\") .$req->oldimage1;
        if (file_exists($image_path)) {
        @unlink($image_path);
        }
        }

        else{
        $filename2 =$req->oldimage1;
        }
        
        $type="runner";
        $page_schema =trim($req->page_schema);
        $result = TheForceModel::where("id",$req->web_id)->where('type',$type)->update([
        "type"=>$type,
        "image" => $filename,
        'image1'=>$filename2,
        "banner_image" =>$filename1,
        "page_title" => $req->page_title,
        "page_description"=> $req->page_description,
        "page_schema" =>$page_schema,
        ]);
    
       return $result; 
}

public function getRunnerData(){
   $data = TheForceModel::where('type','runner')->get();
   return $data;
}

public function updateChoreographer(Request $req){


    $filenamesarray[]='';
    if($req->hasfile("filenames")){
        foreach($req->file("filenames") as $img) {
            $filenames = $img->getClientOriginalName();
            $img->move('TheForceMultipleImage',$filenames);
            $filenamesarray[]=$filenames;
        }

    }
    else{
        $filenamesarray=$req->oldfilenames;
    }

    $file1 = $req->file('banner_image');
    if($file1 != ''){
    $filename1 = date('YmdHi').rand().$file1->getClientOriginalName();
    $file1->move('TheForceImage', $filename1); 
    $image_path = public_path("\TheForceImage\\") .$req->oldbannerimage;
    if (file_exists($image_path)) {
    @unlink($image_path);
    }
    }

    else{
    $filename1 =$req->oldbannerimage;
    }
    $type="choreographers";
    $page_schema =trim($req->page_schema);
    $result = TheForceModel::where("id",$req->web_id)->where('type',$type)->update([
    "name"=>$req->name,
    "type"=>$type,
    "description" =>$req->description,
    "banner_image" =>$filename1,
    "page_title" => $req->page_title,
    "page_description"=> $req->page_description,
    "page_schema" =>$page_schema,
    "multipleImage"=>$filenamesarray,
    ]);

   return $result; 
}

public function getChoreographersData(){
   $data = TheForceModel::where('type','choreographers')->get();
   return $data;
}



}
