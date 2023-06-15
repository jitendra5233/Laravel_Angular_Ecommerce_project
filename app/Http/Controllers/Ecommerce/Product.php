<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\ProductModel;

use Illuminate\Http\Request;

class Product extends Controller
{
   
    public function index()
    {
        $getAllProducts=ProductModel::orderBy('id','DESC')->get();
        return view('content.Ecommerce.ProductView')->with('tableData',$getAllProducts);
    }
        public function addProduct()
        {
        return view('content.Ecommerce.addProject');
        }


        public function addNewProduct(Request $req)
        {
            $file = $req->file('image');
            $filename = date('YmdHi').rand().$file->getClientOriginalName();
            $file->move('ProductImage', $filename);

           $data=new ProductModel();
           $data->name =$req->name;
           $data->price =$req->price;
           $data->description =$req->description;
           $data->status=$req->status;
           $data->image=$filename;
          $res=$data->save();
          return $res;
        }

        public function GetAllProducts(Request $req)
        {
           $result=ProductModel::orderBy('id','DESC')->where('status',1)->get();
           foreach($result as $row)
           {
            if($row['userId'] == $req->userId)
            {
                $row['wishlist']='yes';
            }
            else{
                $row['wishlist']='no';
            }

           }
           return $result; 
        }

      

        public function GetSingleProduct($id){
            $products = ProductModel::where('id',$id)->get();
            return $products;
          }
}
