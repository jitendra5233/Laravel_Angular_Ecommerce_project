<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\WishlistModel;
use App\Models\Ecommerce\ProductModel;
use Illuminate\Http\Request;

class Wishlist extends Controller
{
  
    public function AddRemoveWishlist(Request $req)
    {
        
        $result=ProductModel::where('id',$req->pro_id)->get();

        if($result !='')
        {
            $res=0;
            $chekdata=WishlistModel::where('pro_id',$req->pro_id)->count();
            if($chekdata ==0)
            {
                $data=new WishlistModel();
                $data->pro_id=$req->pro_id;
                $data->userId=$req->userId;
                $data->price=$result[0]->price;
                $data->name=$result[0]->name;
                $data->image=$result[0]->image;
                $res=$data->save(); 
            }
            if($chekdata !=0)
            {
                $res=WishlistModel::where('pro_id',$req->pro_id)->delete();
            }

        }
        if($res !='')
        {
            if($result[0]->wishlist == 'yes')
            {
               $i='no';
               $result = ProductModel::where("id",$result[0]->id)->update([
                   "wishlist" => $i,
                   "userId"=>null
                   ]); 
                   return $result=0;
            }
            if($result[0]->wishlist == 'no')
            {
               $i='yes';
               $result = ProductModel::where("id",$result[0]->id)->update([
                "wishlist" => $i,
                "userId"=>$req->userId
                   ]); 
                   return $result=1;
            }   
        }
       
    }

    public function GetWishlistData(Request $req)
    {
        $result=WishlistModel::where('userId',$req->userId)->get();

        return $result;
    }

   
}
