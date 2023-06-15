<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\MediaModel;

class Media extends Controller
{
    public function index(){
        $data = MediaModel::where('alt','!=', 'no image')->orderBy('id', 'DESC')->get();
        return view('content.Media.viewMedia')->with('allData',$data);
    }

    public function submitMedia(Request $req){
        $file = $req->file('file');
        $filename = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('media/images', $filename);
        $data = new MediaModel;
        $data->name ='';
        $data->url = $filename;
        $data->alt = '';
        $data->caption = '';
        $data->type = '';
        $result = $data->save();
        return redirect('/all-media');
    }

    public function imgDetails(Request $req){

        $result = MediaModel::where('id',$req->id)->update(['name'=>$req->name,'alt'=>$req->alt,'caption'=>$req->caption]);

        return $result;
    }

    public function deleteimgDetails(Request $req)
    {

        $result = MediaModel::where("id",$req->id)->update([
            "url" =>'images.png',
            "alt" =>'no image'
            ]); 
            return $result;

    }

}

