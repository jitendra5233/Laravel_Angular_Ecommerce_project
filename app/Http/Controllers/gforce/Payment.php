<?php

namespace App\Http\Controllers\gforce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gforce\PaymentsModel;
use App\Models\Gforce\BookingModel;
use App\Models\Gforce\WorkshopModel;
use App\Models\Gforce\StudentsModel;

class Payment extends Controller
{
    public function savePayment(Request $req){

        $data = new PaymentsModel;
        $data->student_id = $req->student_id;
        $data->booking_id = $req->booking_id;
        $data->payment_id = $req->payment_id;
        $data->payment_intent_id = $req->payment_intent_id;
        $data->type = $req->type;
        $data->price = $req->price;
        $res = $data->save();
        
        if($res == 1)
        {
            
          $getstudent=StudentsModel::where('id',$req->student_id)->get();
             if(count($getstudent) != 0){
              $studentname = $getstudent[0]->firstname . " " .$getstudent[0]->middlename . " " .$getstudent[0]->lastname;
              $data1=new BookingModel(); 
              $data1->name=$studentname;
              $data1->email=$getstudent[0]->email;
              $data1->phone=$getstudent[0]->phone;
              $data1->type=$req->type;
              $data1->price =$req->price;
              $data1->payid =$req->payment_id;
              $data1->booking_id =$req->booking_id;
              $data1->paymode ="Online";
              $data1->status='1';
              $res=$data1->save();
            }
            
        }
        return $res;
    }
    
    public function getAllBookings($id){
        $res = PaymentsModel::where('student_id',$id)->get();
        foreach($res as $row){
            if($row->type == 'workshop'){
                $row['booking_name'] = WorkshopModel::where('id',$row->booking_id)->get()[0]->title;
            }
        }
        return $res;
    }
}
