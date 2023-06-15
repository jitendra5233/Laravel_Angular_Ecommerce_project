<?php

namespace App\Http\Controllers\gforce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gforce\Package;
use App\Models\Gforce\Branch;
use App\Models\Gforce\ProjectClassModel;


class PackageCon extends Controller
{
    public function addPackage(){
        $tableData = Branch::all();
        $projectclass = ProjectClassModel::all();
      
        return view('content.Package.addPackage')->with('tableData',$tableData)->with('projectclass',$projectclass);
    }

    public function allPackage(){
        $package = Package::orderBy('id','DESC')->get();

        foreach($package as $row){
            $branch = Branch::where('id',$row->branch)->get();
            $projectclass = ProjectClassModel::where('id',$row->class_id)->get();
            if(count($branch) != 0){
                $row['branchName'] = $branch[0]->name;
            }else{
                $row['branchName'] = '';
            }
            if(count($projectclass) != 0){
                $row['className'] = $projectclass[0]->name;
            }else{
                $row['className'] = '';
            }
        }
        return view('content.Package.allPackage')->with('package',$package);
    }

    public function editPackage($id){
        $branch = Branch::all();
        $allProjectClass = ProjectClassModel::all();
        $package = Package::where('id',$id)->get();
        return view('content.Package.editPackage')->with('branch',$branch)->with('package',$package)->with('allProjectClass',$allProjectClass);
    }

    public function updatePackage(Request $req){
         
        $file = $req->file('image');
        if($file != ""){
        $filename = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('PackageImg', $filename); 
        $image_path = public_path("\PackageImg\\") .$req->oldimage;
        if (file_exists($image_path)) {
        @unlink($image_path);
        }
        
        }
        
        else{
        $filename =$req->oldimage;
        }

        $result = Package::where("id",$req->packageID)->update([
            "name" => $req->packageName,
            "price" => $req->price,
            "credit" => $req->credit,
            "expire"  => $req->expire,
            "branch" => $req->branch,
            "class_id" => $req->class_id,
            "image" => $filename,
            "package_limit" => $req->limit,
            "description" => $req->description,
        ]); 
       return $result;
    }

    public function deletePackage(Request $req){
        $result = Package::where('id',$req->id)->delete();
        return $result;
    }

    public function viewPackage($id){
        $branch = Branch::all();
        $package = Package::where('id',$id)->get();
        foreach($package as $row){
            $branch = Branch::where('id',$row->branch)->get();
            $projectclass = ProjectClassModel::where('id',$row->class_id)->get();
            if(count($branch) != 0){
                $row['branchName'] = $branch[0]->name;
            }else{
                $row['branchName'] = '';
            }
            if(count($projectclass) != 0){
                $row['className'] = $projectclass[0]->name;
            }else{
                $row['className'] = '';
            }
        }
        $projectclass = ProjectClassModel::where('id',$row->class_id)->get();

        return view('content.Package.showPackage')->with('branch',$branch)->with('package',$package);
    }

    public function submitPackage(Request $req){
        $file = $req->file('image');
        $filename = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('PackageImg', $filename); 
        $data = new Package;
        $data->name = $req->packageName;
        $data->price = $req->price;
        $data->credit = $req->credit;
        $data->expire = $req->expire;
        $data->branch = $req->branch;
        $data->class_id = $req->class_id;
        $data->image = $filename;
        $data->description = $req->description;
        $data->package_limit = $req->limit;
        $res = $data->save();
        return $res;
    }
}
