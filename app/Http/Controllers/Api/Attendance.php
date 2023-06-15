<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\BlogModel;
use App\Models\Ace\BlogCategoryModel;
use App\Models\Gforce\AttendanceModel;
use App\Models\Gforce\WorkshopModel;
use App\Models\Gforce\StudentsModel;
use App\Models\Gforce\OpenClassModel;
use App\Models\Gforce\ProjectClassModel;

class Attendance extends Controller
{
    public function getAttendance(){
        $result = AttendanceModel::all();
        return $result;
    }

    public function markAttendance(Request $req){
        $data = new AttendanceModel;
        $data->student_id = $req->student_id;
        $data->type = $req->type;
        $data->date = $req->date;
        $data->time = $req->time;
        $data->class_id = $req->class_id;
        $res = $data->save();
        if($res == 1)
        {
              $getstudent=StudentsModel::where('id',$req->student_id)->get();
              if(count($getstudent) != 0){
              $studentname = $getstudent[0]->firstname . " " .$getstudent[0]->middlename . " " .$getstudent[0]->lastname;
              $email = $getstudent[0]->email;
              $email1='';
              $classname='';
              if($req->type =='workshop')
              {
              $classname = WorkshopModel::where('id',$req->class_id)->get()[0]->title; 
              }
            
             if($req->type =='openClass')
             {
             $classname = OpenClassModel::where('id',$req->class_id)->get()[0]->classname; 
             }
             
             if($req->type =='projectClass')
             {
                 $classname = ProjectClassModel::where('id',$req->class_id)->get()[0]->name;
             }
          
        //   $message1="
                              
        //                 Dear  Parents, 
                    
        //                 $studentname,  Attendance has been marked Successfully. And Attendence Date- ". $req->date."  And Time  - ". $req->time." 
        //                 And Class name is - ".$classname.".
    
    
        //                 The Gforce  Team
        //                          ";
            
             $message="
                              
                        Hello  $studentname, 
                    
                        Your Attendance has been marked Successfully. Date- ". $req->date."  And Time  - ". $req->time." 
                        And Class name is - ".$classname.".
    
    
                        The Gforce  Team
                                 ";
                         $result=mail($email,"Attendance Marked !",$message); 
                        //  $result1=mail($email1,"Attendance Marked !",$message1); 
    
     
                        }
        
        }
        return $res;
    }

    public function getAttendanceSingle($id){
        $result = AttendanceModel::where('student_id',$id)->get();
        foreach($result as $row){
            if($row->type == 'workshop'){
                $row['booking_name'] = WorkshopModel::where('id',$row->class_id)->get()[0]->title;
            }
        }
        return $result;
    }
}