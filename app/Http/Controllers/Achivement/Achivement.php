<?php

namespace App\Http\Controllers\Achivement;

use App\Http\Controllers\Controller;
use App\Models\Gforce\AchivementModel;

use Illuminate\Http\Request;

class Achivement extends Controller
{
   
    public function index()
    {
       $getAchicvement=AchivementModel::orderBy('id', 'DESC')->take(4)->get();
       return view('content.Achievement.allAchievementView')->with('tableData',$getAchicvement);
    }
    
    public function getAchievement()
    {
      $getAchicvement=AchivementModel::orderBy('id', 'DESC')->get();
      return $getAchicvement;
    }
    public function addAchievement()
    {

       return view('content.Achievement.addAchievement');

    }
    public function addNewAchievement(Request $req)
    {

        $file = $req->file('image');
        $image = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('AchievementImage', $image);
        $data= new AchivementModel();
        $data->title=$req->title;
        $data->image=$image;
        $data->description= $req->description;
        $res = $data->save();
         return $res;
    }

    public function editAchievement($id)
    {
        $getAchicvement= AchivementModel::where('id',$id)->get()[0];
        return view('content.Achievement.editAchievement')->with('getAchicvement',$getAchicvement);
    }

    public function updateAchievement(Request $req)
    {

        $file = $req->file('image');
        if($file != ''){
            $filename = date('YmdHi').rand().$file->getClientOriginalName();
            $file->move('AchievementImage', $filename); 
            $image_path = public_path("\AchievementImage\\") .$req->oldimage;
            if (file_exists($image_path)) {
                @unlink($image_path);
             }
        }

        else{
            $filename =$req->oldimage;
        }
        $result = AchivementModel::where("id",$req->proid)->update([
            "title"=>$req->title,
            "image" =>$filename,
            "description"=> $req->description,
          ]); 
       return $result;
    }

    public function AchievementView($id)
    {
        $getAchicvement= AchivementModel::where('id',$id)->get()[0];
        return view('content.Achievement.viewSingleAchievement')->with('getAchicvement',$getAchicvement);
    }

    

}
