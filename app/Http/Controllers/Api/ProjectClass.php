<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gforce\ProjectClassModel;
use App\Models\Gforce\OpenClassModel;
use App\Models\Gforce\WorkshopModel;
use App\Models\Gforce\TrainerModel;
use App\Models\Gforce\Branch;
use App\Models\Gforce\UserMod;
use App\Models\Gforce\PaymentsModel;
use App\Models\Gforce\OnlineSchoolModel;
use App\Models\Gforce\SchoolModel;
use App\Models\Gforce\SchoolCategoryModel;
use App\Models\Ecommerce\ProductModel;

class ProjectClass extends Controller
{
    public function getClasses(){
        $tableData = ProjectClassModel::orderBy('id','DESC')->where('status',1)->get();
        foreach($tableData as $row){
            $row['branch'] =  Branch::where('id',$row->branchname)->get()[0]->name;
        }
        return $tableData;
    }
    
    public function getOpenClasses(){
        $tableData = OpenClassModel::orderBy('id','DESC')->where('status',1)->get();
        foreach($tableData as $row){
            $row['branch'] =  Branch::where('id',$row->branchname)->get()[0]->name;
        }
        return $tableData;
    }
    
    public function getWorkshops(){
        $tableData = WorkshopModel::orderBy('id','DESC')->where('status',1)->get();
        foreach($tableData as $row){
            $row['branch_name'] =  Branch::where('id',$row->branch_id)->get()[0]->name;
        }
        return $tableData;
    }
    
    public function changeProjectClassStatus(Request $req){


        
        $projectClass = ProjectClassModel::where('id',$req->id)->get();
   
        if($projectClass[0]->status == 1)
        {
           $i='0';
           $result=ProjectClassModel::where("id",$projectClass[0]->id)->update([
               "status" => $i
               ]); 
               return $result=0;
        }

        if($projectClass[0]->status == 0)
        {
           $i='1';
           $result=ProjectClassModel::where("id",$projectClass[0]->id)->update([
               "status" => $i
               ]); 
               return $result=1;
        }

   
   }



   public function changeOpenClassStatus(Request $req){
        
    $openclass = OpenClassModel::where('id',$req->id)->get();

    if($openclass[0]->status == 1)
    {
       $i='0';
       $result=OpenClassModel::where("id",$openclass[0]->id)->update([
           "status" => $i
           ]); 
           return $result=0;
    }

    if($openclass[0]->status == 0)
    {
       $i='1';
       $result=OpenClassModel::where("id",$openclass[0]->id)->update([
           "status" => $i
           ]); 
           return $result=1;
    }
}

    public function changeWorkshopStatus(Request $req)
    {
        $workshop = WorkshopModel::where('id',$req->id)->get();

        if($workshop[0]->status == 1)
        {
        $i='0';
        $result=WorkshopModel::where("id",$workshop[0]->id)->update([
            "status" => $i
            ]); 
            return $result=0;
        }

        if($workshop[0]->status == 0)
        {
        $i='1';
        $result=WorkshopModel::where("id",$workshop[0]->id)->update([
            "status" => $i
            ]); 
            return $result=1;
        } 
        
    }

    public function changeTrainerStatus(Request $req)
    {
        $trainer = TrainerModel::where('id',$req->id)->get();

        if($trainer[0]->status == 1)
        {
        $i='0';
        $result=TrainerModel::where("id",$trainer[0]->id)->update([
            "status" => $i
            ]); 
            return $result=0;
        }

        if($trainer[0]->status == 0)
        {
        $i='1';
        $result=TrainerModel::where("id",$trainer[0]->id)->update([
            "status" => $i
            ]); 
            return $result=1;
        } 
        
    }

    public function getWorkShopByBranch(Request $req){
        $res = WorkshopModel::where('branch_id',$req->id)->where('status',1)->get();
        foreach($res as $row){
            $row['branchName'] =  Branch::where('id',$row->branch_id)->get()[0]->name;
        }
       return $res;
    }
    
    public function getClassByBranch(Request $req){
        $res = OpenClassModel::where('branchname',$req->id)->get();
        foreach($res as $row){
            $row['branchName'] =  Branch::where('id',$row->branchname)->get()[0]->name;
        }
       return $res;
    }
    
    public function getWorkShopSingle(Request $req){
        $res = WorkshopModel::where('id',$req->id)->get();
        foreach($res as $row){
            $row['branchName'] =  Branch::where('id',$row->branch_id)->get()[0]->name;
        }
       return $res;
    }

    public function getOpenClassSingle(Request $req){
        $res = OpenClassModel::where('id',$req->id)->get();
        foreach($res as $row){
            $row['branchName'] =  Branch::where('id',$row->branchname)->get()[0]->name;
        }
       return $res;
    }

    public function getClassesByBranchByDate(Request $req){
        $res = OpenClassModel::where('branchname',$req->id)->where('scheduledate',$req->date)->get();
        foreach($res as $row){
            $row['branchName'] =  Branch::where('id',$row->branchname)->get()[0]->name;
        }
       return $res;
    }
    
    public function getPopData(Request $req){
        $result = [];
        if($req->type == 'openclass'){
            $result = OpenClassModel::where('id',$req->id)->get();
            if(count($result) != 0){
                foreach($result as $r){
                    $data = TrainerModel::where('id',$r->trainer_id)->get();
                    if(count($data) != 0){
                        $r['trainer_name'] = $data[0]->name;
                        $r['trainer_image'] = $data[0]->image;
                        $r['links'] = $data[0]->ameneties;
                        $r['related'] =  OpenClassModel::get();
                    }
                }
            }
        }
        if($req->type == 'projectclass'){
            $result = ProjectClassModel::where('id',$req->id)->get();
            if(count($result) != 0){
                foreach($result as $r){
                    $data = TrainerModel::where('id',$r->trainer_id)->get();
                    if(count($data) != 0){
                        $r['trainer_name'] = $data[0]->name;
                        $r['trainer_image'] = $data[0]->image;
                        $r['links'] = $data[0]->ameneties;
                        $r['related'] =  ProjectClassModel::get();
                    }
                }
            }
        }
        if($req->type == 'workshop'){
            $result = WorkshopModel::where('id',$req->id)->get();
            if(count($result) != 0){
                foreach($result as $r){
                    $data = TrainerModel::where('id',$r->trainer_id)->get();
                    if(count($data) != 0){
                        $r['trainer_name'] = $data[0]->name;
                        $r['trainer_image'] = $data[0]->image;
                        $r['links'] = $data[0]->ameneties;
                        $r['related'] =  WorkshopModel::get();
                    }
                }
            }
        }
        return $result;
    }
    public function getEnrolledClasses(Request $req){
        $student = UserMod::where('token',$req->token)->get();
        if(count($student) != 0){
            $classes = [];
            $payments = PaymentsModel::where('student_id',$student[0]->id)->get();
            foreach($payments as $row){
                $work = OpenClassModel::where('id',$row['booking_id'])->get();
                if(count($work) != 0){
                    $work[0]['branchName'] =  Branch::where('id', $work[0]->branchname)->get()[0]->name;
                    $work[0]['trainerName'] =  TrainerModel::where('id', $work[0]->trainer_id)->get()[0]->name;
                    $classes[] = $work[0];
                }
            }
            return $classes;
        }
    }

    public function getEnrolledWorkshop(Request $req){
        $student = UserMod::where('token',$req->token)->get();
        if(count($student) != 0){
            $workshops = [];
            $payments = PaymentsModel::where('student_id',$student[0]->id)->get();
            foreach($payments as $row){
                $work = WorkshopModel::where('id',$row['booking_id'])->get();
                if(count($work) != 0){
                    $work[0]['branchName'] =  Branch::where('id', $work[0]->branch_id)->get()[0]->name;
                    $work[0]['trainerName'] =  TrainerModel::where('id', $work[0]->trainer_id)->get()[0]->name;
                    $workshops[] = $work[0];
                }
            }
            return $workshops;
        }
    }
    
    public function getOnlineSchoolData(){
        $category = SchoolCategoryModel::all();
        foreach($category as $row){
            $row['data'] = SchoolModel::where('school_category',$row->id)->get();
        }
        return $category;
    }
    
    public function getOnlineSchool(){
        $data = OnlineSchoolModel::all();
        return $data;
    }
    
    public function getSingleVideoData(Request $req){
        $data = SchoolModel::where('id',$req->id)->get();
        return $data;
    }
    public function getpayments(Request $req){
        $student = UserMod::where('token',$req->token)->get();
        if(count($student) != 0){
            $data = PaymentsModel::where('student_id',$student[0]->id)->get();
            foreach($data as $row){
               if($row['type'] == 'workshop'){
                    $work = WorkshopModel::where('id',$row['booking_id'])->get();
                    if(count($work) != 0){
                        $row['name'] =  $work[0]->title;
                        $row['date'] =  $work[0]->workshopdates;
                        $row['starttime'] =  $work[0]->starttime;
                        $row['endtime'] =  $work[0]->endtime;
                        
                    }
               }
               if($row['type'] == 'openClass'){
                    $work = OpenClassModel::where('id',$row['booking_id'])->get();
                    if(count($work) != 0){
                        $row['name'] =  $work[0]->classname;
                        $row['date'] = $work[0]->scheduledate;
                        $row['starttime'] =  $work[0]->scheduletime;
                        $row['endtime'] =  '-';
                    }
               }
            }
            return $data;
        }
    }


    public function changeProductStatus(Request $req)
    {
        $product = ProductModel::where('id',$req->id)->get();

        if($product[0]->status == 1)
        {
        $i='0';
        $result=ProductModel::where("id",$product[0]->id)->update([
            "status" => $i
            ]); 
            return $result=0;
        }

        if($product[0]->status == 0)
        {
        $i='1';
        $result=ProductModel::where("id",$product[0]->id)->update([
            "status" => $i
            ]); 
            return $result=1;
        } 
        
    }
    
    
}