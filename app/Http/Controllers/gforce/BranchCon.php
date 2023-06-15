<?php

namespace App\Http\Controllers\gforce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gforce\Branch;
use App\Models\Gforce\NewsletterModel;


class BranchCon extends Controller
{
    public function addBranch(){
        return view('content.Branch.addbranch');
    }

    public function editBranch($id){
        $branch = Branch::where('id',$id)->get();
        return view('content.Branch.editbranch')->with('branch',$branch[0]);        
    }

    public function deleteBranch(Request $req){
        $res = Branch::where('id',$req->id)->delete();
        return $res;
    }

    public function viewBranch($id){
        $branch = Branch::where('id',$id)->get();
        return view('content.Branch.viewbranch')->with('branch',$branch[0]);        
    }

    public function allBranch(){
        $tableData = Branch::orderBy('id','DESC')->get();
        return view('content.Branch.allbranch')->with('tableData',$tableData);
    }

    public function getBranch(){
        $branch = Branch::all();
        return $branch;
    }

    public function submitBranch(Request $req){
        $file = $req->file('img');
        $filename = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('uploadImages/branch/', $filename); 

        $data = new Branch;
        $data->name = $req->name;
        $data->fulllocation = $req->location;
        $data->city = '$req->city';
        $data->state = '$req->state';
        $data->country = '$req->country';
        $data->des = $req->des;
        $data->img = $filename;
        $data->phone =$req->phone;
        $res = $data->save();
        return $res;
    }
    
    public function submitNewsletterEmail(Request $req)
    {
        $data=new NewsletterModel();
        $data->email=$req->email;
        $result=$data->save();
        return $result;
        
    }
    
    public function allNewsView()
    {
    $getAllNewsLetter = NewsletterModel::orderBy('id','DESC')->get();
    return view('content.Newsletter.viewAllNew')->with('tableData',$getAllNewsLetter);    
    
    }
    
    public function DeleteNews(Request $req)
    {
        
        $result=NewsletterModel::where('id',$req->id)->delete();
        return $result;
    }
    
    //  public function getSingleNews($id){
    //     $getSingleNewsLetter = NewsletterModel::where('id',$id)->get();
    //     return view('content.Newsletter.viewSingleNews')->with('tableData',$getSingleNewsLetter);         
    // }


    public function updateBranch(Request $req){
        
        if($req->img != 'no'){
            $file = $req->file('img');
            $filename = date('YmdHi').rand().$file->getClientOriginalName();
            $file->move('uploadImages/branch/', $filename);

            $result = Branch::where("id",$req->id)->update([
                "name" => $req->name,
                "fulllocation" => $req->location,
                "phone" => $req->phone,
                "des" => $req->des,
                "img" => $filename
            ]);
            return $result;
        }else{
            $result = Branch::where("id",$req->id)->update([
                "name" => $req->name,
                "fulllocation" => $req->location,
                "phone" => $req->phone,
                "des" => $req->des,
            ]);
            return $result;
        }
    }
}
