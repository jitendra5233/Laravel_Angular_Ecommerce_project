<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Gforce\SchoolModel;
use App\Models\Gforce\SchoolCategoryModel;
use Illuminate\Http\Request;

class School extends Controller
{
    public function index()
    {
        $getData=SchoolModel::orderBy('id','DESC')->get();
        foreach($getData as $row)
        {
            if(SchoolCategoryModel::where('id',$row->school_category)->count() != 0){
                $row['School_catName'] = SchoolCategoryModel::where('id',$row->school_category)->get()[0]->name;
            }else{
                $row['School_catName'] = 'No Category';
            }
        }
       return view('content.School.schoolView')->with('tableData',$getData);
    }

    public function schoolcategory(){
        $schoolcat = SchoolCategoryModel::orderBy('id','DESC')->get();
        return view('content.School.schoolcat')->with('schoolcat',$schoolcat); 

    }
    public function addSchool()
    {
        $schoolcat = SchoolCategoryModel::orderBy('id','DESC')->get();
        
        return view('content.School.addschool')->with('schoolcat',$schoolcat); 

    }

     public function addnewSchool(Request $req)
    {
        $file = $req->file('image');
        $image = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('VideoImage', $image);
 

        $file = $req->file('video_uloaded');
        if($file != ''){
            $filename = date('YmdHi').rand().$file->getClientOriginalName();
            $file->move('VideoImage', $filename); 
        }
        
        if($file == '')
        {
            $filename=$req->video_urls;  
        }

        $page_schema =trim($req->page_schema);
        $data = new SchoolModel;
        $data->title = $req->title;
        $data->page_title = $req->page_title;
        $data->page_description = $req->page_description;
        $data->page_schema = $page_schema;
        $data->school_category = $req->category;
        $data->description = $req->description;
        $data->trailer_video = $filename;
        $data->price = $req->price;
        $data->image =$image;
        $data->type =$req->type;
        $data->status=$req->status;
        $result = $data->save();
        return $result;
    
}

 
    public function DeleteSchool(Request $req)
    {
        $result = SchoolModel::where('id',$req->id)->delete();
        return $result;
    }

    public function EditSchool($id)
    {
        $School = SchoolModel::where('id',$id)->get();
        $schoolcat = SchoolCategoryModel::all();
        return view('content.School.editSchool')->with('schoolcat',$schoolcat)->with('School',$School[0]); 
    }
    public function updateschoolVideo(Request $req)
    {
        $file = $req->file('image');
        if($file != ''){
            $filename = date('YmdHi').rand().$file->getClientOriginalName();
            $file->move('VideoImage', $filename); 
            $image_path = public_path("\VideoImage\\") .$req->oldimage;
            if (file_exists($image_path)) {
                @unlink($image_path);
             }
        }

        else{
            $filename =$req->oldimage;
          }

          $file1 = $req->file('video_uloaded');
          if($file1 != '' ){
              $filename1 = date('YmdHi').rand().$file->getClientOriginalName();
              $file1->move('VideoImage', $filename1); 
          }
          
          else if($file1 == '' && $req->video_urls == '')
          {
              $filename1=$req->old_trailer_video;  
          }
          else if($file1 == '' && $req->video_urls != '')
          {
              $filename1=$req->video_urls;  
          }

        
        $page_schema = trim($req->page_schema);
        $result = SchoolModel::where("id",$req->Schoolid)->update([
            "title" => $req->title,
            "page_title" =>$req->page_title,
            "page_description" =>$req->page_description,
            "page_schema" =>$page_schema,
            "description" => $req->description,
            "school_category" => $req->category,
            "price" => $req->price,
            "trailer_video" => $filename1,
            "status"=>$req->status,
            "image"=>$filename,
            "type"=>$req->type,
            ]); 
       return $result;
    }
    public function SchoolView($id)
    {
        $School = SchoolModel::where('id',$id)->get();
        $schoolcat = SchoolCategoryModel::orderBy('id','DESC')->get();
        return view('content.School.singleViewSchool')->with('schoolcat',$schoolcat)->with('School',$School[0]); 
    }

}
