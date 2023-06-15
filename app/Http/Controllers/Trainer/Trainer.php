<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Gforce\TrainerModel;
use App\Models\Gforce\Branch;


use Illuminate\Http\Request;

class Trainer extends Controller
{
    public function index()
    {
        $tableData = TrainerModel::orderBy('id','DESC')->get();
        foreach($tableData as $row)
        {
          $branch = Branch::where('id',$row->branch_id)->get();
            if(count($branch) != 0){
            $row['branchName'] = $branch[0]->name;
            }else{
            $row['branchName'] = 'NA';
            }
        }
        return view('content.Trainer.viewAllTrainer')->with('tableData',$tableData);
    }

   
    public function create()
    {
         // This function is Send data in AddWorkshop Blade file with ProjectClass and Batch 
         $tableData = Branch::all();
         return view('content.Trainer.addTrainer')->with('tableData',$tableData);
    }

   
    public function store(Request $req)
    {
    
        //This Function get data from Add View Blade and save data in database

        $file = $req->file('image');
        $image = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('TrainerImg', $image);
        $data= new TrainerModel;
        $page_schema =trim($req->page_schema);
        $data->name = $req->name;
        $data->branch_id = $req->branch_id;
        $data->speciality=$req->speciality;
        $data->page_title = $req->page_title;
        $data->page_description = $req->page_description;
        $data->page_schema = $page_schema;
        $data->image =$image;
        $data->status = $req->status;
        $data->ameneties = $req->ameneties;
        $res = $data->save();
        return $res;
        
    }

   
    
   
    public function edit($id)
    {
        $getTrainer=TrainerModel::where('id',$id)->get()[0];
        $branch = Branch::all();
        return view('content.Trainer.editTrainer')->with('getTrainer',$getTrainer)->with('branch',$branch); 
    }

    
    public function update(Request $req)
    {
         // This Function is Update Value that are get from Edit View Blade file 

         $file = $req->file('image');
         if($file != ''){
             $filename = date('YmdHi').rand().$file->getClientOriginalName();
             $file->move('TrainerImg', $filename); 
             $image_path = public_path("\TrainerImg\\") .$req->oldimage;
             if (file_exists($image_path)) {
                 @unlink($image_path);
              }
         }
 
         else{
             $filename =$req->oldimage;
           }
         $page_schema =trim($req->page_schema);
         $result=TrainerModel::where("id",$req->proid)->update([
             "name"=>$req->name,
             "branch_id"=>$req->branchname,
             "speciality"=>$req->speciality,
             "page_title"=>$req->page_title,
             "page_description"=>$req->page_description,
             "page_schema"=>$page_schema,
             "image"=>$filename,
             "status"=>$req->status,
             "ameneties" => $req->ameneties,
           ]); 
     
        return $result;
    }

   
    public function destroy(Request $req)
    {
        $trainer=TrainerModel::where('id',$req->id)->get()[0];
        $image_path = public_path("\TrainerImg\\") .$trainer->image;
        if (file_exists($image_path)) {
        @unlink($image_path);
        }

        $result=TrainerModel::where('id',$req->id)->delete();

         return $result;
    }

    public function trainerView($id)
    { 
        //This function is View all Details on behalf of Trainer id  and redirect view details page 
        $branch = Branch::all();
        $getTrainer= TrainerModel::where('id',$id)->get()[0];
        return view('content.Trainer.viewTrainer')->with('getTrainer',$getTrainer)->with('branch',$branch); 
    }
}
