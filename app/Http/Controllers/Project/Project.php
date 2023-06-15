<?php



namespace App\Http\Controllers\Project;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Ace\RoleModel;

use App\Models\Project\ProjectModel;

use App\Models\Project\SubProject;

use App\Models\Project\PropetyModel;

use App\Models\Ace\UserModel;

use App\Models\Ace\MediaModel;

use App\Models\Ace\PropertyStatusModel;

use App\Models\Ace\FeatureModel;

use App\Models\Ace\PropertyTypeModel;



use Session;



class Project extends Controller

{





    public function AllProjectView(){

        $data = ProjectModel::orderBy('id', 'DESC')->get();

        $imgUrl = [];

        $imgUrl1 = [];

        $proImages = [];

        foreach($data as $row){



            $img = (array) json_decode($row->images,true);

            $imgUrl = [];



            foreach($img as $r){

                $user = MediaModel::where('id',$r)->get()[0];

                $imgUrl[] = $user;

            }

            $media = MediaModel::where('id',$row->image)->get()[0];

            $imgUrl1[]=$media;

            $proImages =  $imgUrl1;

            $row['projectImages'] =  json_encode($imgUrl); 

        }



        $test = session('roleId');



        $test = json_decode($test);



        if($test->p1 != 1){

            return redirect('dashbord');

        }else{

            return view('content.Project.allProjects')->with('tableData',$data)->with('proImages',$proImages);

        }

    }



    public function projectAdd(){

        $media = MediaModel::all();

        return view('content.Project.addProject')->with('media',$media);

    }



    public function projectSubAdd($id){

        $data = ProjectModel::where('id',$id)->get();

        $media = MediaModel::all();

        return view('content.Project.addSubProject')->with('project',$data)->with('media',$media);

    }



    public function projectSubView($pid,$id){

        $pdata = ProjectModel::where('id',$pid)->get();

        $data = SubProject::where('id',$id)->get();

        $tableData = PropetyModel::where('categoryId',$id)->orderBy('id', 'DESC')->get();

        foreach($tableData as $row){

            $row['projectName'] = ProjectModel::where('id',$row['typeId'])->get()[0]->name;

            $row['subProjectName'] = SubProject::where('id',$row['categoryId'])->get()[0]->name;

            $user=UserModel::where('id',$row['userId'])->get()[0];

            $row['agentName'] =  $user->first_name .' '. $user->last_name;

            
            
            if($row->imgType != 'url'){
                $img = (array) json_decode($row->images,true);

                $imgUrl = [];
                
                
                
                foreach($img as $r){
                    
                    $user = MediaModel::where('id',$r)->get()[0];
                    
                    $imgUrl[] = $user;
                    
                }
                
                
                
                $row['agentImages'] =  json_encode($imgUrl);
            }else{
                $row['agentImages'] =  $row->images;
            }

        }



        return view('content.Project.allPropertiesView')->with('tableData',$tableData)->with('oldBreadName',$pdata[0]->name)->with('currentBreadName',$data[0]->name);

    }



    public function projectSubmit(Request $req){

        $data = new ProjectModel();
        $page_schema =trim($req->page_schema);

        $data->name = $req->name;
        
        $data->page_title = $req->page_title;
        
        $data->page_description = $req->page_description;
        
        $data->page_schema = $page_schema;
        
        $data->sliderImages = 0;

        $data->subImageUrl = $req->name;

        $data->subImageAlt = $req->name;

        $data->subImageCaption = $req->name;

        $data->description = $req->htmlcode;

        $data->short_description = $req->short_description;

        $data->location = $req->location;

        $data->image = $req->imgArr1;

        $data->images = $req->imgArr;

        $data->status = $req->status;

        $data->projectcategory=$req->projectcategory;

        $res = $data->save();

        return redirect('project-add');

    }



    public function projectView($id){

        $projecctid=$id;

        $data = ProjectModel::where('id',$id)->get();

        $tableData = SubProject::where('projectId',$id)->orderBy('id', 'DESC')->get();

        $imgUrl = [];

        $subproImages = [];

        foreach($tableData as $row){

            $img = (array) json_decode($row->images,true);

            $imgUrl = [];

            foreach($img as $r){

                $user = MediaModel::where('id',$r)->get()[0];

                $imgUrl[] = $user;

            }

            $media = MediaModel::where('id',$row->image)->get()[0];

            $imgUrl1[]=$media;

            $subproImages =  $imgUrl1;

            $row['subprojectImages'] =  json_encode($imgUrl); 

        }

        return view('content.Project.projectView')->with('currentBreadName',$data[0]->name)->with('tableData',$tableData)->with('currentId',$id)->with('subproImages',$subproImages)->with('projectid',$projecctid);

    }



    public function projectSubSubmit(Request $req){

        $data = new SubProject();
        $page_schema =trim($req->page_schema);
        $data->name = $req->name;
        
         $data->page_title = $req->page_title;
        
        $data->page_description = $req->page_description;
        
        $data->page_schema = $page_schema;
        

        $data->projectId = $req->projectId;

        $data->sliderImages = 0;

        $data->subImageUrl = $req->name;

        $data->subImageAlt = $req->name;

        $data->subImageCaption = $req->name;

        $data->description = $req->htmlcode;

       $data->short_description = $req->short_description;

        $data->image = $req->imgArr1;

        $data->images = $req->imgArr;

        $data->status = $req->status;

        $res = $data->save();

        return redirect('/project-view/'.$req->projectId);

    }





    public function propertyAdd($pid = 0,$id = 0){

        $oldName = ProjectModel::where('id',$pid)->get();

        $currentName = SubProject::where('id',$id)->get();

        $project = ProjectModel::all();

        $projectType = PropertyTypeModel::all();

        $subProject = SubProject::all();

        $agents = UserModel::all();

        $media = MediaModel::all();



        $test = session('roleId');



        $test = json_decode($test);



        if($test->p1 != 1){

            return redirect('dashbord');

        }else{

            return view('content.Project.addProperty')->with('projectType',$projectType)->with('project',$project)->with('subProject',$subProject)->with('agents',$agents)->with('media',$media);

        }

    }



    public function SubmitAddProperty(Request $req){

         $page_schema =$req->page_schema;
        $finalprice = str_replace(',', '', $req->price);
        $data = new PropetyModel;

        $data->userId = $req->agent;

        $data->typeId = $req->project;

        $data->categoryid = $req->subproject;

        $data->name = $req->name;
        
         $data->page_title = $req->page_title;
        
        $data->page_description = $req->page_description;
        
        $data->page_schema = $page_schema;

        $data->address = $req->address;

        $data->city = $req->zipCode;

        $data->state = $req->state;

        $data->country = $req->country;

        $data->nearbyJson = $req->nearByJson;

        $data->ameneties = $req->ameneties;

        $data->images = $req->imgArr;

        $data->description = $req->description;

        $data->price = $finalprice;

        $data->sizeSqFt = $req->size;

        $data->bedroom = $req->beadroom;

        $data->bathroom = $req->bathroom;

        $data->features = '';

        $data->lat_long = 0;

        $data->propertyListingStatus = $req->status;

        $data->purpose = $req->purpose;

        $data->propertytypeId = $req->propertytype;

        $data->status = $req->chkstatus;

        $result = $data->save();

        return redirect('/project-addProperty');

    }



    public function allPropertiesView(){

        $tableData = PropetyModel::orderBy('id', 'DESC')->get();

        $roleId = [];

        $Agentname = '';

        foreach($tableData as $row){

            if($row['typeId'] == 'no_project'){

                $row['projectName'] = 'No Project';

            }else{

                $row['projectName'] = ProjectModel::where('id',$row['typeId'])->get()[0]->name;

            }



            if($row['categoryId'] == 'no_sub_project'){

                $row['subProjectName'] = 'No Sub Project';

            }else{

                $category = SubProject::where('id',$row['categoryId'])->get();

                if(count($category) != 0){

                    $row['subProjectName'] = SubProject::where('id',$row['categoryId'])->get()[0]->name;

                }else{

                    $row['subProjectName'] = 'No Sub Project';

                }

            }

            

            $user = UserModel::where('id',$row['userId'])->get()[0];

            $row['agentName'] =  $user->first_name .' '. $user->last_name;

            if($row->imgType != 'url'){
            $img = (array) json_decode($row->images,true);



            $imgUrl = [];



            foreach($img as $r){
                
                $user = MediaModel::where('id',$r)->get()[0];
                
                $imgUrl[] = $user;
                
            }
            
            $row['agentImages'] =  json_encode($imgUrl);
        }else{
            $row['agentImages'] = $row->images;
        }

            $role = session('role');

            $roleaccess = RoleModel::where('name',$role)->get()[0]->access;

            $roleId = json_decode($roleaccess);

            $Agentname= $user->first_name .' '. $user->last_name;

        }

        $test = session('roleId');



    //    $user = UserModel::where('id',$row['userId'])->get()[0];

        $test = json_decode($test);



        if($test->p1 != 1){

            return redirect('dashbord');

        }else{

            return view('content.Project.allPropertiesView')->with('tableData',$tableData)->with('roleId',$roleId)->with('Agentname',$Agentname);

        }

    }



    



    public function getImgUrl($img) {

        return $img;

    }



    public function singlePropertiesView($id){

        $project = ProjectModel::all();

        $subProject = SubProject::all();

        $agents = UserModel::all();

        $propertyTypes = PropertyTypeModel::all();

        $propertyDetail = PropetyModel::where('id',$id)->get();

        return view('content.Project.singlePropertyView')->with('propertyTypes',$propertyTypes)->with('project',$project)->with('subProject',$subProject)->with('agents',$agents)->with('propertyDetail',$propertyDetail[0]);

    }

    public function getSubProjectById(Request $req){



        $result = SubProject::where('projectId',$req->id)->get();

        return $result;

    }



    public function getAllPropetyStatus(){

        $result = PropertyStatusModel::orderBy('id', 'DESC')->get();

        return $result;

    }



    public function getAllPropetyFeatures(){

        $result = FeatureModel::all();

        return $result;

    }



    public function Deleteproject(Request $req)

    {

        $project=ProjectModel::where('id',$req->id)->delete();

        $property=SubProject::where('projectId',$req->id)->delete();

        $result=PropetyModel::where('typeId',$req->id)->delete();

         return $project;



    }

    public function Ediproject($id)

    {

        $project = ProjectModel::where('id',$id)->get();

        $media = MediaModel::all();

        return view('content.Project.EditProject')->with('media',$media)->with('project',$project[0]); 

    }



    public function updateproject(Request $req)

    {

        $page_schema =trim($req->page_schema);
         $result = ProjectModel::where("id",$req->proid)->update([

            "name"=>$req->name,
            
             "page_title" =>$req->page_title,
             
            "page_description" =>$req->page_description,
            
            "page_schema" =>$page_schema,

            "description"=> $req->description,

            "sliderImages" =>0,

            "subImageUrl"=> $req->name,

            "subImageAlt" => $req->name,

             "subImageCaption" => $req->name,

            "location"=> $req->location,

            "short_description"=> $req->short_description,

            "image" => $req->imgArr1,

            "images"=>$req->imgArr,

            "status"=>$req->status,

            "projectcategory"=>$req->projectcategory,

            ]); 

            return redirect('/project-all'); 

    }

    public function Editsubproject($id)

    {

        $project = ProjectModel::all();

        $tableData = SubProject::where('id',$id)->get();

        $media = MediaModel::all();

        return view('content.Project.EditSubproject')->with('currentId',$id)->with('media',$media)->with('project',$project)->with('tableData',$tableData[0]);

    }



    public function updatesubproject(Request $req)

    {

         $page_schema =trim($req->page_schema);
         $result = SubProject::where("id",$req->id)->update([

            "name"=>$req->name,
            
            "page_title" =>$req->page_title,
             
            "page_description" =>$req->page_description,
            
            "page_schema" =>$page_schema,

            "description"=> $req->description,

            "short_description"=> $req->short_description,

            "projectId"=> $req->projectid,

            "image" => $req->imgArr1,

            "images"=>$req->imgArr,

            "status"=>$req->status

            ]); 



            return redirect('/project-view/'.$req->projectid);

    }



    public function Deletesubprojet(Request $req)

    {

        $property=PropetyModel::where('categoryId',$req->id)->delete();

        $result = SubProject::where('id',$req->id)->delete();

       return $result;



    }



    public function propertyEdit($id)

    {

        $project = ProjectModel::all();

        $subproject = SubProject::all();

        $properystatus = PropertyStatusModel::all();

        $media = MediaModel::all();

        $agents = UserModel::all();

        $property = PropetyModel::where('id',$id)->get();

        $features = FeatureModel::all();

        $propertyTypes = PropertyTypeModel::all();

        return view('content.Project.EditProperty')->with('propertyTypes',$propertyTypes)->with('media',$media)->with('project',$project)->with('properystatus',$properystatus)->with('subproject',$subproject)->with('property',$property[0])->with('agents',$agents)->with('features',$features);

    }



    public function updateproperty(Request $req)

    {

        if(!empty($req->mycheck))

        {

        $arr=$req->mycheck;

        $string_version = implode(',', $arr);

        $features="[$string_version]";

        }

        else{

            $features=$req->propertyFeatures; 

        }

        $page_schema =$req->page_schema;
        $finalprice = str_replace(',', '', $req->price);

          $result = PropetyModel::where("id",$req->propertyid)->update([

            "userId"=>$req->UserId,

            "typeId"=> $req->projectId,

            "categoryId" => $req->subproject,

            "name" => $req->name,
            
             "page_title" =>$req->page_title,
             
            "page_description" =>$req->page_description,
            
            "page_schema" =>$page_schema,

            "city" => $req->zipCode,

            "state" => $req->state,

            "address" => $req->address,

            "country" => $req->country,

            "nearbyJson" => $req->nearByJson,

            "images" => $req->imgArr,

            "imgType" => $req->imgType,

            "description" => $req->description,

            "price" => $finalprice,

            "sizeSqFt" => $req->size,

            "bedroom" => $req->beadroom,

            "bathroom" => $req->bathroom,

            "features"=>'',

            "ameneties"=> $req->ameneties,

            "lat_long"=>0,

            "propertyListingStatus"=>$req->status,    

            "purpose"=>$req->purpose,  

            'propertytypeId'=>$req->propertytype,

            'status'=>$req->chkstatus

            ]); 

            return redirect('/project-allPropertiesView');

    }



    public function Deleteproperty(Request $req)

    {

        $result = PropetyModel::where('id',$req->id)->delete();

        return $result;

    }



    public function propertyTypeView(){

        $media=MediaModel::orderBy('id', 'DESC')->get();

        $tableData = PropertyTypeModel::orderBy('id', 'DESC')->get();

        $imgUrl = [];

        $PropertyImages=[];

        foreach($tableData as $row)

            {     

           $user = MediaModel::where('id',$row->image)->get()[0];

           $imgUrl[]=$user;

            }

            $PropertyImages =  $imgUrl;



            $test = session('roleId');



            $test = json_decode($test);



            if($test->p1 != 1){

                return redirect('dashbord');

            }else{

                return view('content.Project.PropertyType')->with('media',$media)->with('tableData',$tableData)->with('PropertyImages',$PropertyImages);

            }

    }



    public function SavePropertyType(Request $req){

        $data = new PropertyTypeModel;

        $data->name = $req->name;

        $data->image = $req->imgArr1;

        $result = $data->save();

        return $result;

    }



    

    public function UpdatePropertyType(Request $req)

    {

         $result = PropertyTypeModel::where("id",$req->id)->update([

            "name"=>$req->name,

            "image" => $req->imgArr1

            ]);

            return $result;

    }



    public function DeletePropertyType(Request $req){

        $result = PropertyTypeModel::where('id',$req->id)->delete();

        return $result;

    }



    public function AddMedia(Request $req){

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

         if($result == 1)

         {

            $result = MediaModel::where('url',$filename)->get();

            return $result;

         }

         else{

            return 0;

         }

    }



    public function exportpropertyCSV()

    {

        $fileName = 'Property.csv';

        $tableData = PropetyModel::all();



        $headers = array(

            "Content-type"        => "text/csv",

            "Content-Disposition" => "attachment; filename=$fileName",

            "Pragma"              => "no-cache",

            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",

            "Expires"             => "0"

        );

        $columns = array('Id','Name', 'Project Name','Sub Project Name','Agent Name','Property Type', 'Status', 'Property Status','Address','Price','Size','Bedroom','Bathroom','Purpose','Description','Created  Date','Created  Time');

        

        $callback = function() use($tableData, $columns) {

            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);



        foreach($tableData as $task){



            $row['id'] = $task->id;

            $row['name']=$task->name;



            if($task['typeId'] == 'no_project'){

                $row['projectName'] = 'No Project';

            }else{

                $row['projectName'] = ProjectModel::where('id',$task['typeId'])->get()[0]->name;

            }



            if($task['categoryId'] == 'no_sub_project'){

                $row['subProjectName'] = 'No Sub Project';

            }else{

                $row['subProjectName'] = SubProject::where('id',$task['categoryId'])->get()[0]->name;

            }

            

            $user = UserModel::where('id',$task['userId'])->get()[0];

            $row['agentName'] =  $user->first_name .' '. $user->last_name;



            $propertytype=PropertyTypeModel::where('id',$task['propertytypeId'])->get()[0]->name;

            $row['propertytype']=$propertytype;



            if($task['status']==1)

            {

                $row['status']='Active';

            }

            if($task['status']==0)

            {

                $row['status']='Inactive';

            }

            $PropertyStatus=PropertyStatusModel::where('id',$task['propertyListingStatus'])->get()[0]->name;

            $row['PropertyStatus']=$PropertyStatus;

            $row['address']=$task->address;

            $row['price']=$task->price;

            $row['sizeSqFt']=$task->sizeSqFt;

            $row['bedroom']=$task->bedroom;

            $row['bathroom']=$task->bathroom;

            $row['purpose']=$task->purpose;

            $row['description']=$task->description;

            $dt=$task->created_at;

            $d = $dt->format('m/d/Y');

            $t = $dt->format('H:i A');

            $row['Created  Date']  =  $d;

            $row['Created  Time']  =  $t;

            fputcsv($file, array($row['id'], $row['name'], $row['projectName'], $row['subProjectName'],$row['agentName'], $row['propertytype'], $row['status'], $row['PropertyStatus'], $row['address'], $row['price'], $row['sizeSqFt'], $row['bedroom'], $row['bathroom'], $row['purpose'], $row['description'],  $row['Created  Date'],$row['Created  Time']));

        }

        

        fclose($file);

    };

    return response()->stream($callback, 200, $headers);



    }



    public function AddWish_list(Request $req)

    {
       

        if($req->wishlist == 1){

            $result = PropetyModel::where("id",$req->id)->update([

                "wishlist"=>'0'

                ]);
                $getval=PropetyModel::where("id",$req->id)->get()[0]->wishlist;

        }



        if($req->wishlist == 0){
            $result = PropetyModel::where("id",$req->id)->update([

                "wishlist"=>'1'

                ]);
            $getval=PropetyModel::where("id",$req->id)->get()[0]->wishlist;
        }

        

        return $getval;





    }



    public function wishlist()

    {

        $tableData = PropetyModel::where('wishlist','1')->where('status','1')->orderBy('id', 'DESC')->get();


        foreach($tableData as $row){

            if($row['typeId'] == 'no_project'){

                $row['projectName'] = 'No Project';

            }else{

                $row['projectName'] = ProjectModel::where('id',$row['typeId'])->get()[0]->name;

            }


            if($row['categoryId'] == 'no_sub_project'){

                $row['subProjectName'] = 'No Sub Project';

            }else{

                $row['subProjectName'] = SubProject::where('id',$row['categoryId'])->get()[0]->name;

            }

            

            $user = UserModel::where('id',$row['userId'])->get()[0];

            $row['agentName'] =  $user->first_name .' '. $user->last_name;

            $img = (array) json_decode($row->images,true);



            $imgUrl = [];



            foreach($img as $r){

                $user = MediaModel::where('id',$r)->get()[0];

                $imgUrl[] = $user;

            }

            $row['agentImages'] =  json_encode($imgUrl);

        }



        $test = session('roleId');



        $test = json_decode($test);



        if($test->p1 != 1){

            return redirect('dashbord');

        }else{

            return view('content.Project.Wishlist')->with('tableData',$tableData);

        }

    



    }



    public function BulkUploadView(){

        return view('content.Project.bulkupload');

    }



    public function bulkuploadproperty(Request $req){

        $filecsv = $req->file('filecsv');



        $total_result = [];



        if (($open = fopen($filecsv, "r")) !== FALSE) 

        {

            $i = 0;

        

          while (($data = fgetcsv($open, 10000, ",")) !== FALSE) 

          {        

            if($i != 0){

                $data2 = new PropetyModel();

                if(count($data) == 21){


                    $userFound = UserModel::where('first_name',$data[0])->where('last_name',$data[1])->count();

                    if($userFound != 0){

                        $userId = UserModel::where('first_name',$data[0])->where('last_name',$data[1])->get()[0]->id;

                        $data2->userId = $userId;

                    }



                    $projectFound = ProjectModel::where('name',$data[2])->count();

                    if($projectFound != 0){

                        $projectId = ProjectModel::where('name',$data[2])->get()[0]->id;

                        $data2->typeId = $projectId;

                    }



                    $subprojectFound = SubProject::where('name',$data[3])->count();

                    if($subprojectFound != 0){

                        $subprojectId = SubProject::where('name',$data[3])->get()[0]->id;

                        $data2->categoryId = $subprojectId;

                    }

                    

                    $data2->name = $data[4];



                    $propertyType = PropertyTypeModel::where('name',$data[5])->count();



                    if($propertyType != 0){

                        $propertyTypeId = PropertyTypeModel::where('name',$data[5])->get()[0]->id;

                        $data2->propertytypeId = $propertyTypeId;

                    }


                    $imgJsonData = [];
                    $imgJsonData[] = $data[7]; 
                    $imgJsonData[] = $data[8]; 
                    $imgJsonData[] = $data[9]; 
                    $imgJsonData[] = $data[10];
                    $imgJsonData[] = $data[11];
                    $imgJsonData[] = $data[12];
                    $imgJsonData[] = $data[13]; 


                    $data2->address = $data[6];

                    $data2->city = 'no';

                    $data2->state = 'no';

                    $data2->nearbyJson = 'no';

                    $data2->images = json_encode($imgJsonData);
                    
                    $data2->imgType = 'url';
                    
                    $data2->description = $data[14];

                    $data2->price = str_replace(',', '', $data[15]);

                    $data2->sizeSqFt = str_replace(',', '', $data[16]);

                    $data2->bedroom = $data[17];

                    $data2->bathroom = $data[18];

                    $data2->features = 'no';

                    $data2->lat_long = 0;

                    $data2->country = $data[19];

                    $data2->purpose = $data[20];

                    $data2->status = 1;

                    $data2->wishlist = 1;

                    $data2->propertyListingStatus = '1';

                    $result = $data2->save();

                    // $total_result[] = $result;

                    // return $data[14];
                }else{
                    return redirect('project-inValidFileFormatView');
                }

            }

            $i++;

          }

        

          fclose($open);

        }
        return redirect('project-bulkSuccess');

    }



    public function inValidFileFormatView(){
        return view('content.Project.InValidFileFormatView');
    }

    public function bulkSuccess(){
        return view('content.Project.bulkSuccess');
    }

}
