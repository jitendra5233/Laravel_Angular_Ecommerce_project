<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Gforce\PaymentsModel;
use App\Models\Gforce\StudentsModel;
use App\Models\Gforce\WorkshopModel;
use App\Models\Gforce\ProjectClassModel;
use App\Models\Gforce\OpenClassModel;
use App\Models\Gforce\Package;
use Illuminate\Http\Request;

class Payment extends Controller
{
   public function index()
   {
    $getallPayment= PaymentsModel::orderBy('id', 'DESC')->get();
    
    foreach($getallPayment as $row)
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
          
          $row['workshopName'] = WorkshopModel::where('id',$row->booking_id)->get()[0]->title;
        }
        else{
          
          $row['workshopName'] = '';
        }
        if($gettype == 'p_class')
        {
          
          $row['pclassName'] = ProjectClassModel::where('id',$row->booking_id)->get()[0]->name;
        }
        else{
          
          $row['pclassName'] = '';
        }

        if($gettype == 'open_class')
        {
          
          $row['openclassName'] = OpenClassModel::where('id',$row->booking_id)->get()[0]->classname;
        }
        else{
          
          $row['openclassName'] = '';
        }

        if($gettype == 'package')
        {
          
          $row['packageName'] = Package::where('id',$row->booking_id)->get()[0]->name;
        }
        else{
          
          $row['packageName'] = '';
        }

    }
    return view('content.Payment.allPaymentView')->with('tableData',$getallPayment);


   }

   public function PaymentView($id)
  {
    $getallPayment= PaymentsModel::where('id', $id)->get();
    foreach($getallPayment as $row)
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
          
          $row['workshopName'] = WorkshopModel::where('id',$row->booking_id)->get()[0]->title;
        }
        else{
          
          $row['workshopName'] = '';
        }
        if($gettype == 'p_class')
        {
          
          $row['pclassName'] = ProjectClassModel::where('id',$row->booking_id)->get()[0]->name;
        }
        else{
          
          $row['pclassName'] = '';
        }

        if($gettype == 'open_class')
        {
          
          $row['openclassName'] = OpenClassModel::where('id',$row->booking_id)->get()[0]->classname;
        }
        else{
          
          $row['openclassName'] = '';
        }

        if($gettype == 'package')
        {
          
          $row['packageName'] = Package::where('id',$row->booking_id)->get()[0]->name;
        }
        else{
          
          $row['packageName'] = '';
        }

    }
    return view('content.Payment.singlePaymentView')->with('tableData',$getallPayment);

  }

}
