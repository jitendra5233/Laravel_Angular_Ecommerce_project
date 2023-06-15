<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\Gforce\WorkshopModel;
use App\Models\Gforce\ProjectClassModel;
use App\Models\Gforce\OpenClassModel;
use App\Models\Gforce\Branch;
use App\Models\Gforce\TrainerModel;
use App\Models\Gforce\AttendenceModel;
use App\Models\Gforce\StudentsModel;
use Illuminate\Http\Request;




class Workshop extends Controller
{

    // This function get All Workshop Data from Database and after that send it All Workshop listing page.
 
    public function index()
    {

        $getAllWorkshop= WorkshopModel::orderBy('id', 'DESC')->get();
        foreach($getAllWorkshop as $row)
        {

            $branch = Branch::where('id',$row->branch_id)->get();
            if(count($branch) != 0){
            $row['branchName'] = $branch[0]->name;
            }else{
            $row['branchName'] = 'Deleted';
            }
            $trainer = TrainerModel::where('id',$row->trainer_id)->get();
            if(count($trainer) != 0){
                $row['trainername'] = $trainer[0]->name;
            }else{
                $row['trainername'] = 'Deleted';
            }
        $workshopdates = json_decode($row->workshopdates,TRUE);
        
        $projectClassName =ProjectClassModel::where('id',$row->class_id)->get();

        if(count($projectClassName) != 0){
            $row['projectClassName'] = $projectClassName[0]->name;
        }else{
            $row['projectClassName'] = 'Na';
        }

         $row['workshopdates'] =$workshopdates;

        }
        
        return view('content.Workshop.allWorkShopView')->with('tableData',$getAllWorkshop);
    }

  
    public function create()
    {

    // This function is Send data in AddWorkshop Blade file with ProjectClass and Batch 

        $projectClass=ProjectClassModel::all();
        $tableData = Branch::all();
        $trainer = TrainerModel::all();
        return view('content.Workshop.addWorkshop')->with('projectClass',$projectClass)->with('tableData',$tableData)->with('trainer',$trainer);
    }

   
    public function store(Request $req)
    {
        

         //This Function get data from Add View Blade and save data in database

        $date = $req->workshopdates;
        $workdate= preg_split("/[,]/",$date); 
        $workshopdates = json_encode($workdate);
        $file = $req->file('image');
        $image = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('WorkshopImage', $image);
        $data= new WorkshopModel;
        $page_schema =trim($req->page_schema);
        $data->class_id = $req->classname;
        $data->branch_id = $req->branchname;
        $data->trainer_id =$req->trainer_id;
        $data->title = $req->title;
        $data->paymenttitle=$req->paymenttitle;
        $data->page_title = $req->page_title;
        $data->page_description = $req->page_description;
        $data->page_schema = $page_schema;
        $data->workshopdates= $workshopdates;
        $data->starttime = $req->starttime;
        $data->endtime = $req->endtime;
        $data->price = $req->price;;
        $data->short_description = $req->short_description;
        $data->description = $req->description;
        $data->image =$image;
        $data->status = $req->status;
        $res = $data->save();
        return $res;
    }

    
    public function edit($id)
    {
        //This function is get data from Database on Behalf of Id and send it Edit View Blade for update Values

        $projectClass=ProjectClassModel::all();
        $getWorkshop= WorkshopModel::where('id',$id)->get()[0];
        $workshopdates= $getWorkshop->workshopdates;
        $workshopdates = json_decode($workshopdates,true);
        $finalwordate= implode(",",$workshopdates);
        $branch = Branch::all();
        $trainer = TrainerModel::all();
        return view('content.Workshop.editWorkshop')->with('olddates',$workshopdates)->with('getWorkshop',$getWorkshop)->with('projectClass',$projectClass)->with('finalwordate',$finalwordate)->with('branch',$branch)->with('trainer',$trainer); 
    }

    
    public function update(Request $req)
    {
        // This Function is Update Value that are get from Edit View Blade file 

        $date = $req->workshopdates;
        $workdate= preg_split("/[,]/",$date); 
        $workshopdates = json_encode($workdate);
        
        $file = $req->file('image');
        if($file != ''){
            $filename = date('YmdHi').rand().$file->getClientOriginalName();
            $file->move('WorkshopImage', $filename); 
            $image_path = public_path("\WorkshopImage\\") .$req->oldimage;
            if (file_exists($image_path)) {
                @unlink($image_path);
             }
        }

        else{
            $filename =$req->oldimage;
        }
        
        $page_schema =trim($req->page_schema);
        $result = WorkshopModel::where("id",$req->proid)->update([
            "class_id"=>$req->class_id,
            "branch_id"=> $req->branch_id,
            "trainer_id"=>$req->trainer_id,
            "title"=>$req->title,
            "paymenttitle"=>$req->paymenttitle,
            "page_title" =>$req->page_title,
            "page_description" =>$req->page_description,
            "page_schema" =>$page_schema,
            "workshopdates" => $workshopdates,
            "starttime" => $req->starttime,
            "endtime"=> $req->endtime,
            "price"=> $req->price,
            "short_description"=> $req->short_description,
            "image" =>$filename,
            "description"=> $req->description,
            "status"=>$req->status,
          ]); 
    
       return $result;
    }

   
    public function destroy(Request $req)
    {
        //This Function is Get Id from View Blade and Delete data from Database On Behalf of Id 

        $workshop=WorkshopModel::where('id',$req->id)->get()[0];
        $image_path = public_path("\WorkshopImage\\") . $workshop->image;
        if (file_exists($image_path)) {
        @unlink($image_path);
        }

        $project=workshopModel::where('id',$req->id)->delete();

         return $project;

    }
    public function workshopView($id)
    { 
        //This function is View all Details on behalf of workshop id  and redirect view details page 
         
        $branch = Branch::all();
        $projectClass=ProjectClassModel::all();
        $getWorkshop= WorkshopModel::where('id',$id)->get()[0];
        $workshopdates= $getWorkshop->workshopdates;
        $workshopdates = json_decode($workshopdates,true);
        $finalworkdate= implode(",",$workshopdates);
        $trainer = TrainerModel::all();
        return view('content.Workshop.viewWorkshop')->with('getWorkshop',$getWorkshop)->with('projectClass',$projectClass)->with('finalworkdate',$finalworkdate)->with('branch',$branch)->with('trainer',$trainer); 
    }
    
    public function workshopScheduleView($id)
    { 
        //This function is View all Details on behalf of workshop id  and redirect view details page 
         
        $branch = Branch::all();
        $projectClass=ProjectClassModel::all();
        $getWorkshop= WorkshopModel::where('id',$id)->get()[0];
        $workshopdatesS= $getWorkshop->workshopdates;
        $workshopdates = json_decode($workshopdatesS,true);
        $finalworkdate= implode(",",$workshopdates);
        // return $workshopdatesS;
        $trainer = TrainerModel::all();
    
      $attendence=AttendenceModel::where('class_id',$id)->where('type','workshop')->get();

        foreach($attendence as $row){
            if(StudentsModel::where('id',$row->student_id)->count() !=0)
            {
            $student = StudentsModel::where('id',$row->student_id)->get();
            $row['studentName'] = $student[0]->firstname . " " .$student[0]->middlename . " " .$student[0]->lastname;
            }
            else{
               $row['studentName']='Deleted'; 
            }
        }

        return view('content.classSchedule.singleWorkshopSchedule')->with('getWorkshop',$getWorkshop)->with('projectClass',$projectClass)->with('finalworkdate',$finalworkdate)->with('branch',$branch)->with('trainer',$trainer)->with('attendence',$attendence)->with('seleteddates',$workshopdates); 
    }

    public function getdatewiseData(Request $req)
    {
        $attendence = AttendenceModel::where('date',$req->date)->where('type','workshop')->get();
        foreach($attendence as $row){
            if(StudentsModel::where('id',$row->student_id)->count() !=0)
            {
            $student = StudentsModel::where('id',$row->student_id)->get();
            $row['studentName'] = $student[0]->firstname . " " .$student[0]->middlename . " " .$student[0]->lastname;
            }
            else{
                $row['studentName']='Deleted';
            }
        }
        return $attendence;
    }
     public function gettrainerbybranchid(Request $req)
     {
         $result = TrainerModel::where('branch_id',$req->branch_id)->where('status','1')->get();
         return $result;
 
     }
}
