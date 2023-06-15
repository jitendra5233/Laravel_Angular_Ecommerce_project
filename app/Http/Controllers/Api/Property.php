<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\PropertyTypeModel;
use App\Models\Project\ProjectModel;
use App\Models\Ace\MediaModel;
use App\Models\Project\PropetyModel;
use App\Models\Project\SubProject;
use App\Models\Ace\UserModel;
use App\Models\Ace\FeatureModel;
use App\Models\Ace\PropertyStatusModel;
use App\Models\Ace\ClientModel;
use App\Models\Ace\AppointmentModel;
use App\Models\Ace\AgentTimeSlotModel;
use App\Models\Ace\HolidayModel;
use App\Models\Ace\User;
use App\Models\Ace\Organization_calender;

class Property extends Controller
{
    public function GetPropertyTypes(){
        $result = PropertyTypeModel::all();
        foreach($result as $row){
            $image = MediaModel::where('id',$row->image)->get();
            $row['url'] = $image[0]->url;
        }
        return $result;
    }

    public function GetProject(){
        $result = ProjectModel::all();
        foreach($result as $row){
            $image = MediaModel::where('id',$row->image)->get();
            $row['url'] = $image[0]->url;
        }
        return $result;
    }

    public function GetProperty(){
        $result = PropetyModel::where('status',1)->get();
        foreach($result as $row){
            $row['subProjectName'] = SubProject::where('id',$row->categoryId)->get()[0]->name;
            $project = ProjectModel::where('id',$row->typeId)->get()[0]; 
            $row['ProjectName'] = $project->name;
            $row['ProjectCategory'] = $project->projectcategory;
            $user = UserModel::where('id',$row->userId)->get()[0];
            $row['UserName'] =  $user->first_name;
            $row['UserPhoto'] =  $user->photo;
            
            
                $typecount = PropertyTypeModel::where('id',$row->propertytypeId)->get();
            
                if(count($typecount) != 0){
                    $row['PropertyTypeName'] =  PropertyTypeModel::where('id',$row->propertytypeId)->get()[0]->name;
                }else{
                    $row['PropertyTypeName'] =  'invalid';
                }
    
            

            
            
            $fArray = [];
            if(false){
                foreach(json_decode($row->features) as $featureId){
                    $fArray[] = FeatureModel::where('id',$featureId)->get()[0]->name;
                }
            }
            $imgArray = [];
            foreach(json_decode($row->images) as $imageId){
                $imgArray[] = MediaModel::where('id',$imageId)->get()[0]->url;
            }
            $row['propertyFeatures'] = $fArray;
            $row['propertyImages'] = $imgArray;
            $row['demoLength'] = $fArray;
        }
        return $result;
    }
 
    public function GetPropertySearch(Request $req){
        $purpose = $req->purpose == 1 ? 'Buy' : 'Rent';
        $result = PropetyModel::where('propertytypeId',$req->propertyType)->where('purpose',$purpose)->where('address',$req->propertyLocation)->get();

        foreach($result as $row){
            // $row['subProjectName'] = SubProject::where('id',$row->categoryId)->get()[0]->name;

            $category = SubProject::where('id',$row['categoryId'])->get();
            if(count($category) != 0){
                $row['subProjectName'] = SubProject::where('id',$row['categoryId'])->get()[0]->name;
            }else{
                $row['subProjectName'] = 'Solo';
            }

            // $row['propertyListingStatusName'] = PropertyStatusModel::where('id',$row->propertyListingStatus)->get()[0]->name;

            $Pstatus = PropertyStatusModel::where('id',$row->propertyListingStatus)->get();
            if(count($Pstatus) != 0){
                $row['propertyListingStatusName'] = PropertyStatusModel::where('id',$row->propertyListingStatus)->get()[0]->name;
            }else{
                $row['propertyListingStatusName'] = '';
            }

            $project = ProjectModel::where('id',$row->typeId)->get()[0]; 
            $row['ProjectName'] = $project->name;
            $row['ProjectCategory'] = $project->projectcategory;
            $user = UserModel::where('id',$row->userId)->get()[0];
            $row['UserName'] =  $user->first_name;
            $row['UserPhoto'] =  $user->photo;
            $row['UserPhone'] =  $user->phone;
            $row['UserEmail'] =  $user->email;
            
                $typecount = PropertyTypeModel::where('id',$row->propertytypeId)->get();
            
                if(count($typecount) != 0){
                    $row['PropertyTypeName'] =  PropertyTypeModel::where('id',$row->propertytypeId)->get()[0]->name;
                }else{
                    $row['PropertyTypeName'] =  'invalid';
                }
    
            
            $fArray = [];
            if(false){
                foreach(json_decode($row->features) as $featureId){
                    $fArray[] = FeatureModel::where('id',$featureId)->get()[0]->name;
                }
            }
            $imgArray = [];
            foreach(json_decode($row->images) as $imageId){
                $imgArray[] = MediaModel::where('id',$imageId)->get()[0]->url;
            }
            $row['propertyFeatures'] = $fArray;
            $row['propertyImages'] = $imgArray;
            $row['demoLength'] = $fArray;
        }
        $newArrfilter = [];
        foreach($result as $row){
            if($req->currentActiveState == $row->ProjectCategory){
                $newArrfilter[] = $row;
            }
        }
        return $newArrfilter;
    }

    public function GetPropertySearchFilter(Request $req){
        $purpose = $req->purpose == 1 ? 'Buy' : 'Rent';

        $result = PropetyModel::where('status',1)->get();

        $fArray = [];

        


        if($req->propertyLocation != ''){
            
            foreach($result as $row){
                if($req->propertyLocation == $row->address){
                    $fArray[] = $row;
                }
            }
            $result = $fArray;
        }


        
        if($req->pType != 0){
            $newArr = [];
            foreach($result as $row){
                if($req->pType == $row->propertytypeId){
                    $newArr[] = $row;
                }
            }
            $result = $newArr;
        }



        if($purpose != ''){
            $newArr = [];
            foreach($result as $row){
                if($purpose == $row->purpose){
                    $newArr[] = $row;
                }
            }
            $result = $newArr;
        }

     


        if($req->minPrice != 00){
            $newArr = [];
            $minprice = $req->minPrice * 1000;
            foreach($result as $row){
                if($minprice <= str_replace(",","",$row->price)){
                    $newArr[] = $row;
                }
            }
            $result = $newArr;
        }
        


            if($req->maxPrice != 00){
                $newArr = [];
                foreach($result as $row){
                    if(($req->maxPrice * 1000) >= str_replace(",","",$row->price)){
                        $newArr[] = $row;
                    }
                }
                $result = $newArr;
            }

        if($req->beds != 0){
            $newArr = [];
            foreach($result as $row){
                if($req->beds == $row->bedroom){
                    $newArr[] = $row;
                }
            }
            $result = $newArr;
        }

        if($req->minSize != 0){
            $newArr = [];
            foreach($result as $row){
                if($req->minSize <= str_replace(",","",$row->sizeSqFt)){
                    $newArr[] = $row;
                }
            }
            $result = $newArr;
        }
        
        // if($req->minSize != 0){
        //     $newArr = [];
        //     foreach($result as $row){
        //         if($req->minSize <= str_replace(",","",$row->sizeSqFt)){
        //             $newArr[] = $row;
        //         }
        //     }
        //     $result = $newArr;
        // }
        
        
        // return $result;
        foreach($result as $row){
            if($row->categoryId != 'no_sub_project'){
                // $row['subProjectName'] = SubProject::where('id',$row->categoryId)->get()[0]->name;
                $category = SubProject::where('id',$row['categoryId'])->get();
                if(count($category) != 0){
                    $row['subProjectName'] = SubProject::where('id',$row['categoryId'])->get()[0]->name;
                }else{
                    $row['subProjectName'] = 'Solo';
                }
            }else{
                $row['subProjectName'] = 'Solo';
            }
            // $row['propertyListingStatusName'] = PropertyStatusModel::where('id',$row->propertyListingStatus)->get()[0]->name;
            $project = ProjectModel::where('id',$row->typeId)->get()[0]; 
            $row['ProjectName'] = $project->name;
            $row['ProjectCategory'] = $project->projectcategory;

            if($project->projectcategory == 1){
                $row['propertyListingStatusName'] = 'Residential';
            }

            if($project->projectcategory == 2){
                $row['propertyListingStatusName'] = 'Commercial';
            }

            if($project->projectcategory == 3){
                $row['propertyListingStatusName'] = 'Off-Plan';
            }

            $user = UserModel::where('id',$row->userId)->get()[0];
            $row['UserName'] =  $user->first_name;
            $row['UserPhoto'] =  $user->photo;
            $row['UserEmail'] =  $user->email;
            $row['UserPhone'] =  $user->phone;
    
            $typecount = PropertyTypeModel::where('id',$row->propertytypeId)->get();
            
                if(count($typecount) != 0){
                    $row['PropertyTypeName'] =  PropertyTypeModel::where('id',$row->propertytypeId)->get()[0]->name;
                }else{
                    $row['PropertyTypeName'] =  'invalid';
                }
    
            if(false){
                $fArray = [];
                foreach(json_decode($row->features) as $featureId){
                    $fArray[] = FeatureModel::where('id',$featureId)->get()[0]->name;
                }
            }
            $imgArray = [];
            if($row->imgType != 'url'){
                foreach(json_decode($row->images) as $imageId){
                    $imgArray[] = MediaModel::where('id',$imageId)->get()[0]->url;
                }
            }else{
                $imgArray[] = $row->images;
            }
            // $row['propertyFeatures'] = $fArray;
            $row['propertyImages'] = $imgArray;
            // $row['demoLength'] = $fArray;
        }

        // return $result;


        $newArrfilter = [];
        if($req->propertyLocation == ''){
              $newArrfilter = $result;         
        }else{
            
        foreach($result as $row){
            if($req->check1 == 1){
                if($row->ProjectCategory == 1){
                    $newArrfilter[] = $row;
                }
            }
            if($req->check2 == 1){
                if($row->ProjectCategory == 2){
                    $newArrfilter[] = $row;
                }
            }
            if($req->check3 == 1){
                if($row->ProjectCategory == 3){
                    $newArrfilter[] = $row;
                }
            }
        }
        }
        return $newArrfilter;
    }

    public function GetPropertySingle(Request $req){
        $result = PropetyModel::where('id',$req->id)->get();

        foreach($result as $row){
            
                $subcount = SubProject::where('id',$row->categoryId)->get();
            
                if(count($subcount) != 0){
                    $row['subProjectName'] = SubProject::where('id',$row->categoryId)->get()[0]->name;
                }else{
                    $row['PropertyTypeName'] =  'invalid';
                }
            
                $lcount = PropertyStatusModel::where('id',$row->propertyListingStatus)->get();
            
                if(count($lcount) != 0){
                    $row['propertyListingStatusName'] = PropertyStatusModel::where('id',$row->propertyListingStatus)->get()[0]->name;
                }else{
                    $row['PropertyTypeName'] =  'invalid';
                }
            
                $pcount = ProjectModel::where('id',$row->typeId)->get();
            
                if(count($pcount) != 0){
                    $project = ProjectModel::where('id',$row->typeId)->get()[0];
                    $row['ProjectName'] = $project->name;
                    $row['ProjectCategory'] = $project->projectcategory;
                }else{
                    $row['ProjectName'] = 'invalid';
                    $row['ProjectCategory'] = 'invalid';
                }
            
            
            $user = UserModel::where('id',$row->userId)->get()[0];
            $row['UserName'] =  $user->first_name;
            $row['UserPhoto'] =  $user->photo;
            $row['UserPhone'] =  $user->phone;
            $row['UserEmail'] =  $user->email;
            
                $typecount = PropertyTypeModel::where('id',$row->propertytypeId)->get();
            
                if(count($typecount) != 0){
                    $row['PropertyTypeName'] =  PropertyTypeModel::where('id',$row->propertytypeId)->get()[0]->name;
                }else{
                    $row['PropertyTypeName'] =  'invalid';
                }
    
            
            
            
            $fArray = [];
            if(false){
                foreach(json_decode($row->features) as $featureId){
                    $fArray[] = FeatureModel::where('id',$featureId)->get()[0]->name;
                }
            }
            $imgArray = [];
            $imgArray = [];
            if($row->imgType != 'url'){
                foreach(json_decode($row->images) as $imageId){
                    $imgArray[] = MediaModel::where('id',$imageId)->get()[0]->url;
                }
            }else{
                $imgArray[] = $row->images;
            }
            $row['propertyFeatures'] = $fArray;
            $row['propertyImages'] = $imgArray;
            $row['demoLength'] = $fArray;
        }
        return $result;
    }


    public function saveAppointmeant(Request $req){
     
        $result = ClientModel::where('first_name',$req->fname)->where('last_name',$req->lname)->where('email',$req->email)->get();

        if(count($result) == 0){

            $client = new ClientModel;

            $client->first_name = $req->fname;

            $client->last_name = $req->lname;

            $client->email = $req->email;

            $client->phone = $req->phone;

            $client->save();

        }

        $clientId = ClientModel::where('first_name',$req->fname)->where('last_name',$req->lname)->where('email',$req->email)->get()[0]->id;        

        $data = new AppointmentModel;

        $data->propertyId = $req->propertyId;

        $data->userId = $req->userId;

        $data->client_id = $clientId;

        $data->date = $req->a_date;

        $data->time = $req->a_time;

        $data->status = 20;

        $result = $data->save();

        return $result;
    }

   public function getAgentTimesloat(Request $req){
        $data = AgentTimeSlotModel::where('userId',$req->id)->get();
        if(count($data) == 0){
            return count($data);
        }else{
            return $data;
        }
    }

    public function getProjectSingle(Request $req){
        $result = ProjectModel::where('id',$req->id)->get();

        foreach($result as $row){
            $image = MediaModel::where('id',$row->image)->get();
            $row['url'] = $image[0]->url;
            $imgArray = [];
            foreach(json_decode($row->images) as $imageId){
                $imgArray[] = MediaModel::where('id',$imageId)->get()[0]->url;
            }
            $row['propertyImages'] = $imgArray;
        }

        return $result;
    }

    public function getSubProjects(Request $req){
        $result = SubProject::where('projectId',$req->id)->get();

        foreach($result as $row){
            $image = MediaModel::where('id',$row->image)->get();
            $row['url'] = $image[0]->url;
            $imgArray = [];
            foreach(json_decode($row->images) as $imageId){
                $imgArray[] = MediaModel::where('id',$imageId)->get()[0]->url;
            }
            $row['propertyImages'] = $imgArray;
        }

        return $result;
    }

    public function getProjectSingleSub(Request $req){
        $result = SubProject::where('id',$req->id)->get();

        foreach($result as $row){
            $image = MediaModel::where('id',$row->image)->get();
            $row['location'] = ProjectModel::where('id',$row->projectId)->get()[0]->location;
            $row['url'] = $image[0]->url;
            $imgArray = [];
            foreach(json_decode($row->images) as $imageId){
                $imgArray[] = MediaModel::where('id',$imageId)->get()[0]->url;
            }
            $row['propertyImages'] = $imgArray;
        }

        return $result;
    } 

    public function getSubProperty(Request $req){
        $result = PropetyModel::where('categoryId',$req->id)->get();

        foreach($result as $row){
            $user = UserModel::where('id',$row->userId)->get()[0];
            $row['UserName'] =  $user->first_name .' '. $user->first_name;
            $row['UserPhoto'] =  $user->photo;

            $imgArray = [];
            if($row->imgType != 'url'){
                foreach(json_decode($row->images) as $imageId){
                    $imgArray[] = MediaModel::where('id',$imageId)->get()[0]->url;
                }
            }else{
                $imgArray[] = $row->images;
            }

            $row['propertyImages'] = $imgArray;
            $row['url'] = $imgArray[0];
        }

        return $result;
    } 
    
    public function getSubProperty2(Request $req){
        $result = PropetyModel::where('typeId',$req->id)->get();

        foreach($result as $row){
            $user = UserModel::where('id',$row->userId)->get()[0];
            $row['UserName'] =  $user->first_name .' '. $user->first_name;
            $row['UserPhoto'] =  $user->photo;

            $imgArray = [];
            if($row->imgType != 'url'){
                foreach(json_decode($row->images) as $imageId){
                    $imgArray[] = MediaModel::where('id',$imageId)->get()[0]->url;
                }
            }else{
                $imgArray[] = $row->images;
            }

            $row['propertyImages'] = $imgArray;
            $row['url'] = $imgArray[0];
        }

        return $result;
    } 

    public function getAllSubProject(Request $req){
        $result = SubProject::all();

        foreach($result as $row){
            $image = MediaModel::where('id',$row->image)->get();
            if(count($image) != 0){
                $row['url'] = $image[0]->url;
            }else{
                $row['url'] = 'images.png';
            }
        }

        return $result;
    }

    public function getAllPublicHolidays(){
        $result = HolidayModel::all();
        return $result; 
    }

    public function getAgentSlot(Request $req){
        $result = [];
        $result['slot'] = AgentTimeSlotModel::where('userId',$req->id)->orderBy('id', 'DESC')->get();
        $result['property'] = PropetyModel::where('userId',$req->id)->get();
        $result['appointmeant'] = AppointmentModel::where('userId',$req->id)->get();
        return $result;
    }
    
    public function getAppointmentTime(Request $req){
        $result = AppointmentModel::where('userId',$req->userId)->where('date',$req->ndate)->get();
        return $result;
    }
    
   public function getWorkingDays(){
        $result = Organization_calender::all();
        return $result;
    }
}
