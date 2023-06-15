<?php

namespace App\Http\Controllers\Attendence;

use App\Http\Controllers\Controller;
use App\Models\Gforce\StudentsModel;
use App\Models\Gforce\WorkshopModel;
use App\Models\Gforce\ProjectClassModel;
use App\Models\Gforce\OpenClassModel;
use App\Models\Gforce\Package;
use App\Models\Gforce\AttendenceModel;
use Illuminate\Http\Request;

class Attendence extends Controller
{
    public function index()
    {
        $getallAttendence= AttendenceModel::orderBy('id', 'DESC')->get();
    
        foreach($getallAttendence as $row)
        {
    
            $student = StudentsModel::where('id',$row->student_id)->get();
            if(count($student) != 0){
              $row['studentName'] =$student[0]->firstname . " " . $student[0]->middlename . " " . $student[0]->lastname;
            }else{
            $row['studentName'] = 'Na';
            }
    
            $gettype=$row->type;
            
            if($gettype == 'workshop')
            {
              if(WorkshopModel::where('id',$row->class_id)->count() !=0)
              {
              $row['workshopName'] = WorkshopModel::where('id',$row->class_id)->get()[0]->title;
              }
              else{
                $row['workshopName']='';  
              }
            }
             else{
                $row['workshopName']='';  
              }
           
            if($gettype == 'p_class')
            {
              if(ProjectClassModel::where('id',$row->class_id)->count() !=0)
              {
              $row['pclassName'] = ProjectClassModel::where('id',$row->class_id)->get()[0]->name;
              }
              else{
                $row['pclassName'] = '';  
              }
            }
             else{
                $row['pclassName'] = '';  
              }
           
    
            if($gettype == 'open_class')
            {
              if(OpenClassModel::where('id',$row->class_id)->count() !=0)
              {
              $row['openclassName'] = OpenClassModel::where('id',$row->class_id)->get()[0]->classname;
              }
            else{
              
              $row['openclassName'] = '';
            }
            
            }
             else{
              
              $row['openclassName'] = '';
            }
             if($gettype == 'package')
            {
          
          if(Package::where('id',$row->class_id)->count() !=0)
          {
          $row['packageName'] = Package::where('id',$row->class_id)->get()[0]->name;
          }
            else{
              
              $row['packageName'] = '';
            }
          }
          else{
              
              $row['packageName'] = '';
            }
        }
        return view('content.Attendence.allAttendenceView')->with('tableData',$getallAttendence);
    
    
       }

       public function AttendenceView($id)
       {
         
        $getallAttendence= AttendenceModel::where('id',$id)->get();

        foreach($getallAttendence as $row)
        {
            $student = StudentsModel::where('id',$row->student_id)->get();
            if(count($student) != 0){
              $row['studentName'] =$student[0]->firstname . " " . $student[0]->middlename . " " . $student[0]->lastname;
            }else{
            $row['studentName'] = 'Na';
            }
    
           $gettype=$row->type;
            
            if($gettype == 'workshop')
            {
              if(WorkshopModel::where('id',$row->class_id)->count() !=0)
              {
              $row['workshopName'] = WorkshopModel::where('id',$row->class_id)->get()[0]->title;
              }
            else
            {
               $row['workshopName']='';   
            }
            }
            else
            {
               $row['workshopName']='';   
            }
            
           
            if($gettype == 'p_class')
            {
              if(ProjectClassModel::where('id',$row->class_id)->count() !=0)
              {
              $row['pclassName'] = ProjectClassModel::where('id',$row->class_id)->get()[0]->name;
              }
               else{
                $row['pclassName'] = '';  
              }
           
              
            }
             else{
                $row['pclassName'] = '';  
              }
           
    
            if($gettype == 'open_class')
            {
              if(OpenClassModel::where('id',$row->class_id)->count() !=0)
              {
              $row['openclassName'] = OpenClassModel::where('id',$row->class_id)->get()[0]->classname;
              }
               else{
              $row['openclassName'] = '';
            }
            }
             else{
              $row['openclassName'] = '';
            }
             if($gettype == 'package')
            {
          
          if(Package::where('id',$row->class_id)->count() !=0)
          {
          $row['packageName'] = Package::where('id',$row->class_id)->get()[0]->name;
          }
          else{
              
              $row['packageName'] = '';
            }
    
          }
           else{
              
              $row['packageName'] = '';
            }
    
        }
        return view('content.Attendence.singleAttendenceView')->with('tableData',$getallAttendence);

       }
}
