<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Models\Gforce\PaymentsModel;
use App\Models\Gforce\StudentsModel;
use App\Models\Gforce\WorkshopModel;
use App\Models\Gforce\ProjectClassModel;
use App\Models\Gforce\OpenClassModel;
use App\Models\Gforce\Package;
use App\Models\Gforce\EnrollClassModel;
use Illuminate\Http\Request;

class Student extends Controller
{
    

    public function index()
    {
         // This function get all data from database and send it list blade file

        $tableData = StudentsModel::orderBy('id', 'DESC')->get();

        return view('content.Student.allStudentView')->with('tableData',$tableData);
    }
    public function getSingleStudent($id)
    {
      // This function is get data from database on behalf of Requested Id and Redirect it Details Blade file

        $tableData = StudentsModel::where('id',$id)->get();
        $projectclass=ProjectClassModel::orderBy('id','DESC')->get();
        $getStudentData=PaymentsModel::where('student_id',$id)->get();
        $getenrolldata=EnrollClassModel::orderBy('id','DESC')->where('student_id',$id)->get();
         foreach($getenrolldata as $row1){ 
          $row1['scheduledate']=$row1->scheduledate;
          $row1['scheduletime']=$row1->scheduletime;
          $row1['actualprice']=$row1->a_price;
          $row1['dicount'] =$row1->discout;
          $price=$row1['actualprice'];
          $percent=$row1['dicount'];
          if (is_numeric($price) && is_numeric($percent)) {
          $row1['discountprice']= (($price *100 - $price * $percent)/100);
          $row1['afterdiscount']= $price-$row1['discountprice'];
          }
          
        else{
          $row1['afterdiscount']='Na';
        }
      
          if(StudentsModel::where('id',$row1->student_id)->count() != 0){
          $student = StudentsModel::where('id',$row1->student_id)->get();
          $row1['studentName'] = $student[0]->firstname . " " .$student[0]->middlename . " " .$student[0]->lastname;
          }
          else
          {
             $row1['studentName']='Na';  
          }
          
         if(ProjectClassModel::where('id',$row1->class_id)->count() != 0){
          $calssname = ProjectClassModel::where('id',$row1->class_id)->get();
         $row1['calssname'] = $calssname[0]->name;
          }
          else
          {
              $row1['calssname']='';
          }
         }
        
       foreach($getStudentData as $row)
       {
          $row['datatime']=$row['created_at'];
        $gettype=$row->type;

        if($gettype = "workshop")
        {
        if(WorkshopModel::where('id',$row->booking_id)->count() !=0){
         $getWorkshop=WorkshopModel::where('id',$row->booking_id)->get();
         $row['workshopName']=$getWorkshop[0]->title;
         $workshopdates = json_decode($getWorkshop[0]->workshopdates,TRUE);
         $row['workshopdates'] =$workshopdates;
         $row['type']='Workshop';
        }
        else
        {
           $row['workshopName']='Deleted';  
            $row['workshopdates']='Deleted';
        }
        
        }
        else{
          
          $row['workshopName'] = '';
        }
      
        if($gettype == 'p_class')
        {
          
          if(ProjectClassModel::where('id',$row->booking_id)->count() !=0)
          {
           $row['pclassName'] = ProjectClassModel::where('id',$row->booking_id)->get()[0]->name;
          }
          else{
            $row['pclassName']='Deleted';
          }
          
        }
        else{
          
          $row['pclassName'] = '';
        }

        if($gettype == 'open_class')
        {
          if(OpenClassModel::where('id',$row->booking_id)->count() !=0)
          {
          $row['openclassName'] = OpenClassModel::where('id',$row->booking_id)->get()[0]->classname;
          $row['scheduledate'] =OpenClassModel::where('id',$row->booking_id)->get()[0]->scheduledate;
           $row['type']='Open Class';
          }
          else{
          $row['openclassName'] ='Deleted';
          $row['openscheduledate'] = 'Deleted';  
          }
        }
        else{
          $row['openclassName'] ='';
          $row['openscheduledate'] = '';
        }

        if($gettype == 'package')
        {
          if(Package::where('id',$row->booking_id)->count() !=0)
          {
          $row['packageName'] = Package::where('id',$row->booking_id)->get()[0]->name;
          $row['type']='Pckage';
          }
          else{
            $row['packageName'] = 'Deleted';  
          }
        }
        else{
          
          $row['packageName'] = '';
        }




       }
    
        return view('content.Student.singleStudetView')->with('student',$tableData)->with('getStudentData',$getStudentData)->with('getenrolldata',$getenrolldata)->with('projectclass',$projectclass);

    }
    public function submitenrollclass(Request $req)
    {

      $ldate = date('Y-m-d');
      $ltime =date('H:i:s');
      $data= new EnrollClassModel;
      $data->class_id = $req->classid;
      $data->student_id = $req->studentid;
      $data->a_price =$req->a_price;
      $data->discout =$req->discout;
      $data->scheduledate=$ldate;
      $data->scheduletime=$ltime;
      $res = $data->save();
      return $res;

    }

    public function getPrice(Request $req)
    {
     if(ProjectClassModel::where('id',$req->classid)->count() !=0)
          {
            $getregulrarate = ProjectClassModel::where('id',$req->classid)->get()[0]->regularrate;
          }
          else{
            $getregulrarate = 'Na';  
          }
          return $getregulrarate;
    }


}
