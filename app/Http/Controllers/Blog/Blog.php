<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\BlogModel;
use App\Models\Ace\BlogCategoryModel;
use App\Models\Ace\MediaModel;
use App\Models\Ace\RoleModel;
use App\Models\Ace\UserModel;
class Blog extends Controller
{
      public function index(){
        $blog = BlogCategoryModel::orderBy('id', 'DESC')->get();
        return view('content.Blog.addblog')->with('blogcat',$blog);
    }

//     public  function addblogcategory(Request $req)
//     {
//         $data = new BlogCategoryModel;
//         $data->name = $req->Category;
//         $result = $data->save();
//         return $result;
//     }

//  public function Deleteblogcategory(Request $req)
//     {

//         $result = BlogCategoryModel::where('id',$req->id)->delete();
//         return $result;
//     }

    public function blogcategory()
    {
        $blog = BlogCategoryModel::orderBy('id', 'DESC')->get();

        return view('content.Blog.blogcat')->with('blogcat',$blog);


    }

    public function addnewblog(Request $req)
    {
        $file = $req->file('blogimg');
        $filename = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('BlogImg', $filename);
        $userId = $req->session()->get('id');
        $page_schema =trim($req->page_schema);
        $data = new BlogModel;
        $data->userId = $userId;
        $data->title = $req->title;
        $data->page_title = $req->page_title;
        $data->page_description = $req->page_description;
        $data->page_schema = $page_schema;
        $data->categoryId = $req->category;
        $data->postContent = $req->description;
        $data->image=$filename;
        $data->status=$req->status;
        $result = $data->save();
       return $result;
       
    }

    public function allblogview(Request $req)
    {
        
            $blogs= BlogModel::orderBy('id', 'DESC')->get();
            foreach($blogs as $row)
            {     
                if(BlogCategoryModel::where('id',$row->categoryId)->count() != 0){
                    $row['blogcategory'] = BlogCategoryModel::where('id',$row->categoryId)->get()[0]->name;
                }else{
                    $row['blogcategory'] = 'No Category';
                }
            }
           
            
            return view('content.Blog.allblogview')->with('blogs',$blogs); 
        

    }

    public function Deleteblog(Request $req)
    {
        $result = BlogModel::where('id',$req->id)->delete();
        return $result;
    }

    public function Editblog($id)
    {

        $blog = BlogModel::where('id',$id)->get();
        $blogcat = BlogCategoryModel::all();
        return view('content.Blog.editblog')->with('blogcat',$blogcat)->with('blog',$blog[0]); 
    }

    public function updateblog(Request $req)
    {
        $file = $req->file('blogimg');
        if($file != ""){
        $filename = date('YmdHi').rand().$file->getClientOriginalName();
        $file->move('BlogImg', $filename); 
        $image_path = public_path("BlogImg\\") .$req->oldblogimg;
        if (file_exists($image_path)) {
        @unlink($image_path);
        }
        }

        else{
        $filename =$req->oldblogimg;
        }

        $userId = $req->session()->get('id');
          $page_schema = trim($req->page_schema);
        $result = BlogModel::where("id",$req->blogid)->update([
            "title" => $req->title,
            "page_title" =>$req->page_title,
            "page_description" =>$req->page_description,
            "page_schema" =>$page_schema,
            "userId" => $userId,
            "postContent" => $req->description,
            "categoryId" => $req->category,
            "image"=>$filename,
            "status"=>$req->status

            ]); 
      return $result;

    }

    public function blogView($id)
    {
        $blog = BlogModel::where('id',$id)->get();
        $blogcat = BlogCategoryModel::all();
        return view('content.Blog.viewBlog')->with('blogcat',$blogcat)->with('blog',$blog[0]); 
    }
     public function getBlogs()
     {
          $blog = BlogModel::orderBy('id', 'DESC')->where('status',1)->get();
          return $blog;
     }
     
     public function getBlogsCat(){
          $blog = BlogCategoryModel::orderBy('id', 'DESC')->get();
          return $blog;
     }
     
     public function getSingleBlogs($id){
       $blog = BlogModel::where('id', $id)->get();
       return $blog;
     }

     

}
