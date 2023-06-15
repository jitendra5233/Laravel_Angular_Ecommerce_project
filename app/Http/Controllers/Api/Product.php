<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\CartModel;
use App\Models\Ecommerce\ProductModel;
use Illuminate\Http\Request;

class Product extends Controller
{
   public function AddProducttoCart(Request $req)
   {
    $data=new CartModel();
    $data->pro_id=$req->id;
    $data->quantity=$req->Quantity;
    $data->userId=$req->userId;
    $res=$data->Save();
    return $res;
   }
   public function GetallCartProduct(Request $req)
   {
    $total=0;
    $GetCart=CartModel::where('userId',$req->userId)->get();
    if(count($GetCart) !=0)
    {
    foreach($GetCart as $row)
    {
     $row['productName']=ProductModel::where('id',$row->pro_id)->get()[0]->name;
     $row['proQuantity']=$row->quantity;
     $row['image']=ProductModel::where('id',$row->pro_id)->get()[0]->image;
     $row['price']=ProductModel::where('id',$row->pro_id)->get()[0]->price;
     $row['count']=CartModel::count();
     $row['SigleTotal']=$row['price']*$row['quantity'];
     $total+=$row['price']*$row['quantity'];
     $row['total']=$total;
    }
    }
    return $GetCart;
   
   }

   public function DeleteCartProduct(Request $req)
   {

       $result = CartModel::where('pro_id',$req->pro_id)->delete();
       return $result;
   }

}
