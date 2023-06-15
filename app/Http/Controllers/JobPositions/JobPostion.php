<?php

namespace App\Http\Controllers\JobPositions;

use App\Http\Controllers\Controller;
use App\Models\Gforce\JobPositionCategoryModel;
use App\Models\Gforce\JobPositionModel;
use Illuminate\Http\Request;

class JobPostion extends Controller
{
    
    public function index(){
        $blog = JobPositionCategoryModel::orderBy('id', 'DESC')->get();
        return view('content.JobPositions.addposition')->with('blogcat',$blog);
    }

    public function addnewjobposition(Request $req)
    {
        $page_schema =trim($req->page_schema);
        $data = new JobPositionModel;
        $data->name = $req->title;
        $data->page_title = $req->page_title;
        $data->page_description = $req->page_description;
        $data->page_schema = $page_schema;
        $data->cat_id = $req->category;
        $data->description = $req->description;
        $data->status=$req->status;
        $result = $data->save();
        return $result;
       
    }

    public function allpoistionview()
    {
        $position= JobPositionModel::orderBy('id', 'DESC')->get();
        foreach($position as $row)
        {     
            if(JobPositionCategoryModel::where('id',$row->cat_id)->count() != 0){
                $row['positioncategory'] = JobPositionCategoryModel::where('id',$row->cat_id)->get()[0]->name;
            }else{
                $row['positioncategory'] = 'No Category';
            }
        }
        
        return view('content.JobPositions.allpositionview')->with('position',$position); 
    
    }

    public function DeleteJob(Request $req)
    {
        $result = JobPositionModel::where('id',$req->id)->delete();
        return $result;
    }

    public function EditJob($id)
    {

        $position = JobPositionModel::where('id',$id)->get();
        $jobgcat = JobPositionCategoryModel::all();
        return view('content.JobPositions.editposition')->with('jobgcat',$jobgcat)->with('position',$position[0]); 
    }

    public function updatejob(Request $req)
    {
    
        $page_schema = trim($req->page_schema);
        $result = JobPositionModel::where("id",$req->positionid)->update([
            "name" => $req->title,
            "page_title" =>$req->page_title,
            "page_description" =>$req->page_description,
            "page_schema" =>$page_schema,
            "description" => $req->description,
            "cat_id" => $req->category,
            "status"=>$req->status
            ]); 
       return $result;

    }
    public function jobpositioncategory(){
        $jobgcat = JobPositionCategoryModel::all();
        return view('content.JobPositions.positioncat')->with('jobgcat',$jobgcat); 

    }

    public function JobView($id)
    {  
        
        $position = JobPositionModel::where('id',$id)->get();
        $jobgcat = JobPositionCategoryModel::all();
        return view('content.JobPositions.viewPosition')->with('jobgcat',$jobgcat)->with('position',$position[0]); 
 
    }

    
   

}
