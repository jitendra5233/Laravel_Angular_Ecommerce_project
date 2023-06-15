<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\UserModel;
use App\Models\Ace\SettingModel;
use App\Models\privacymodel;
use App\Models\Ace\Customize;

class setting extends Controller
{
  
        public function index(Request $req)
        {
            $result = Customize::orderBy('id', 'DESC')->take(1)->get();

            return view('content.Setting.setingaddupdate')->with('tableData',$result);

        }


       public function UpdateHome(Request $req){

                $file = $req->file('abt_image');
                if($file != ''){
                $filename = date('YmdHi').rand().$file->getClientOriginalName();
                $file->move('AboutusImage', $filename); 
                $image_path = public_path("\AboutusImage\\") .$req->oldimage;
                if (file_exists($image_path)) {
                @unlink($image_path);
                }
                }

                else{
                $filename =$req->oldimage;
                }

                $file1 = $req->file('banner_image');
                if($file1 != ''){
                $filename1 = date('YmdHi').rand().$file1->getClientOriginalName();
                $file1->move('BannerImage', $filename1); 
                $image_path = public_path("\BannerImage\\") .$req->oldbannerimage;
                if (file_exists($image_path)) {
                @unlink($image_path);
                }
                }

                else{
                $filename1 =$req->oldbannerimage;
                }

                $page_schema =trim($req->page_schema);
                $result = Customize::where("id",$req->web_id)->update([
                "page_title" => $req->page_title,
                "abt_title" => $req->abt_title,
                "abt_sub_title" => $req->abt_sub_title,
                "abt_description" => $req->abt_description,
                "abt_image" => $filename,
                "banner_image" =>$filename1,
                "page_description"=> $req->page_description,
                "page_schema" =>$page_schema,
                "header_code" => $req->header_code,
                "footer_code" => $req->footer_code,
                "footer_desc" => $req->footer_desc,
                "dance_desc"=>$req->dance_desc,
                "c_number" => $req->c_number,
                "w_number" => $req->w_number,
                "ameneties" => $req->ameneties,
                "cUsEmail" => $req->cUsEmail,
                "creersEmail" => $req->creersEmail,
                ]);
            
           return $result;

        }
        
        public function getHomeData(){
                     $result = Customize::orderBy('id', 'DESC')->take(1)->get();
                     return $result;
        }
        
        public function getOtherData(){
         $result =  privacymodel::orderBy('id', 'DESC')->get()[0];
         return $result;
        }
        public function front_book(){
            return view('content.Appointment.frontendAppointment');
        }
        public function open_location(){
            return view('content.Map.Location');
        }
        
         public function privacy()
        {
           
            $result = privacymodel::orderBy('id', 'DESC')->get()[0]->privacy;
            return view('content.Setting.privacy')->with('tableData',$result);

        }
        
         public function term_condetion()
        {
            $result = privacymodel::orderBy('id', 'DESC')->get()[0]->term_condetion;
            return view('content.Setting.term_condetion')->with('tableData',$result);

        }
       
    public function updateprivacy(Request $req)

    {
         $id=1;
         $result =privacymodel::where('id',$id)->update(['privacy' =>$req->privacy]);
        return $result;
    }
       
     public function updateterm(Request $req)
    {
        $id=1;
        $result =privacymodel::where('id',$id)->update(['term_condetion' =>$req->term_condetion]);
        return $result;

    }
  public function updatehomepageameneties(Request $req){
    $ameneties = json_decode($req->ameneties);
    $file = $req->file('img');
    $filename = date('YmdHi').rand().$file->getClientOriginalName();
    $file->move('AmentiesImage', $filename); 
    $ameneties[count($ameneties) -1]->img = $filename;
    $result = Customize::where("id",$req->web_id)->update(["ameneties"=>$ameneties,]);
    return $ameneties;
  }
        
}