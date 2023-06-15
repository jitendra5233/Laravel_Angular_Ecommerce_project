<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\AppointmentModel;
use App\Models\Ace\UserModel;
use App\Models\Project\PropetyModel;
use App\Models\Ace\ClientModel;
use App\Models\Ace\AppointmentStatus;
use App\Models\Ace\PropertyStatusModel;
use App\Models\Ace\CallbackModel;


class Appointment extends Controller
{
    public function Index(){

        $tableData=[];
        $role=session()->get('role');
        $id=session()->get('id');
        if($role == 'Admin')
        {
        $tableData = AppointmentModel::where('status','!=',23)->orderBy('id', 'DESC')->get();
        }
        if($role =='Agent')
        {
        $tableData = AppointmentModel::where('userId',$id)->where('status','!=',23)->orderBy('id', 'DESC')->get();
        }
        foreach($tableData as $row){
            $cData = ClientModel::where('id',$row->client_id)->get();
            $row['clientName'] = $cData[0]->first_name .' '.  $cData[0]->last_name;

            $pCount = PropetyModel::where('id',$row->propertyId)->get();
            if(count($pCount) != 0){
                $row['propertyName'] = PropetyModel::where('id',$row->propertyId)->get()[0]->name;
            }else{
                $row['propertyName'] = '';
            }
        
            $pCount = PropetyModel::where('id',$row->propertyId)->get();
            if(count($pCount) != 0){
                $row['propertyName'] = PropetyModel::where('id',$row->propertyId)->get()[0]->name;
                $row['propertypurpose'] = PropetyModel::where('id',$row->propertyId)->get()[0]->purpose;
                $row['propertylocation'] = PropetyModel::where('id',$row->propertyId)->get()[0]->address;
            }else{
                $row['propertyName'] = '';
                $row['propertypurpose'] = '';
                $row['propertylocation'] = '';
            }

            $aData = UserModel::where('id',$row->userId)->get();
            $row['agentName'] = $aData[0]->first_name .' '.$aData[0]->last_name; 
            $status= $aData[0]->status; 
            if($status == 1)
            {
                $row['agentstatus'] = "Active";
            }
            if($status == 0)
            {
                $row['agentstatus'] = "Inactive";
            }

            $row['clientphone'] = $cData[0]->phone;
            $tableDataStatus=AppointmentStatus::where('id',$row->status)->get();
            if(count($tableDataStatus) == 0){
            $row['tableDataStatus'] = "Status Not Found";

            }
            else{
                $row['tableDataStatus']= AppointmentStatus::where('id',$row->status)->get()[0]->name;
            }
        }
        return view('content.Appointment.viewAllAppointment')->with('tableData',$tableData);
    }

    public function appointmentStatus(){
        $tableData = AppointmentStatus::orderBy('id', 'DESC')->get();
        return view('content.Appointment.viewAppointmentStatus')->with('tableData',$tableData);
    }

    public function addAppointment($id){
        $client = CallbackModel::where('id',$id)->get();
        $users = UserModel::where('role',10)->get();
        $property = PropetyModel::orderBy('id', 'DESC')->where('status',1)->get();
        return view('content.Appointment.addTestAppointment')->with('users',$users)->with('property',$property)->with('client',$client);
    }

     public function addmyAppointment(){
        $users = UserModel::all();
        $property = PropetyModel::orderBy('id', 'DESC')->where('status',1)->get();
        return view('content.Appointment.addTestAppointment')->with('users',$users)->with('property',$property);
    }

    public function submitAppointment(Request $req){
        
        if($req->firstName == 0){
            $result = CallbackModel::where('id',$req->id)->update(['remark' => $req->remark,'status'=>$req->status]);
        }

        if($req->firstName != 0){
        $clietdata = ClientModel::where('first_name',$req->firstName)->where('last_name',$req->lastName)->where('email',$req->email)->get();
        if(count($clietdata) == 0){
            $client = new ClientModel;
            $client->first_name = $req->firstName;
            $client->last_name = $req->lastName;
            $client->email = $req->email;
            $client->phone = $req->phone;
            $client->save();   
        }
        $clientId = ClientModel::where('first_name',$req->firstName)->where('last_name',$req->lastName)->where('email',$req->email)->get()[0]->id;

            $data = new AppointmentModel;
           if($req->property != "no_property")
            {
            $data->propertyId = $req->property; 
            }
            $data->userId = $req->user;
            $data->client_id =$clientId;
            $data->date = $req->date;
            $data->time = $req->time;
            $data->status = 20;
            $result = $data->save();
           if($req->property != "no_property"){
                if($result == 1)
            {
                $client = CallbackModel::where('id',$req->id)->update(['remark' => $req->remark,'status'=>$req->status]); 

                $getuser = UserModel::where('id',$req->user)->get();
                $property = PropetyModel::where('id',$req->property)->get()[0]->name;
                $proplocation = PropetyModel::where('id',$req->property)->get()[0]->address;
                $username = $getuser[0]->first_name .' '.  $getuser[0]->last_name;
                $phone = $getuser[0]->phone;
                $email = $getuser[0]->email;
              $message="
              
              Hello $req->firstName, 
        
              Your Appointment is Book  And Your Appointment Date - ". $req->date."  And Your Appintment Time - ". $req->time." 
              And Your Asigned Agent - ".$username."  And Your Agent Contact Number - ".$phone." And Your Choosed Property -".$property." 
              And Your Property Location - ".$proplocation.".
       
        
              
              The Ace Capital  Team
              ";
              $message1="

              Hello $username, 
        
              This  Appointment Assigend to You And Your Appointment Date - ". $req->date."  And Your Appintment Time - ". $req->time." 
              And Your Client - ".$req->firstName." $req->lastName  And Your Client Contact Number - ".$req->phone." And Your Client 
              Email - ".$req->email." And Property - ".$property.".


              The Ace Capital  Team
              ";
             mail($req->email,"Congratulations Your Appointment is Book",$message); 
             mail($email,"This is An Appointment for you",$message1);

            } 
            }
           
        }
        return $result;
    }

    public function AddManualappointment()
    {  
        $property = PropetyModel::orderBy('id', 'DESC')->where('status',1)->get();
        $appointment = AppointmentStatus::all();
        return view('content.Appointment.AddManualappointment')->with('property',$property)->with('appointment',$appointment);  
    }

    public function ManualAppointment(Request $req)
    {
        
        $result = ClientModel::where('first_name',$req->firstName)->where('last_name',$req->lastName)->where('email',$req->email)->get();

        if(count($result) == 0){
            $client = new ClientModel;
            $client->first_name = $req->firstName;
            $client->last_name = $req->lastName;
            $client->email = $req->email;
            $client->phone = $req->phone;
            $client->save();   
        }

        $clientId = ClientModel::where('first_name',$req->firstName)->where('last_name',$req->lastName)->where('email',$req->email)->get()[0]->id;
        
        $data = new AppointmentModel;
        
         if($req->property != "no_property")
            {
            $data->propertyId = $req->property; 
            }
        $data->userId = $req->user;
        $data->client_id = $clientId;
        $data->date = $req->date;
        $data->time = $req->time;
        $data->status = $req->status;
        $data->remark = $req->remark;
        $result = $data->save();
       if($req->property != "no_property")
            {
         if($result == 1)
        {
        $getuser = UserModel::where('id',$req->user)->get();
        $property = PropetyModel::where('id',$req->property)->get()[0]->name;
        $proplocation = PropetyModel::where('id',$req->property)->get()[0]->address;
        $username = $getuser[0]->first_name .' '.  $getuser[0]->last_name;
        $phone = $getuser[0]->phone;
        $email = $getuser[0]->email;
        $message="
              
        Hello $req->firstName, 
  
         Your Appointment is Book  And Your Appointment Date - ". $req->date."  And Your Appintment Time - ". $req->time." 
         And Your Asigned Agent - ".$username."  And Your Agent Contact Number - ".$phone." And Your Choosed Property -".$property." 
         And Your Property Location - ".$proplocation.".
  
        
        The Ace Capital  Team
        ";
        $message1="

        Hello $username, 
  
         This  Appointment Assigend to You And Your Appointment Date - ". $req->date."  And Your Appintment Time - ". $req->time." 
         And Your Client - ".$req->firstName." $req->lastName  And Your Client Contact Number - ".$req->phone." And Your Client 
         Email - ".$req->email." And Property - ".$property.".
        
        The Ace Capital  Team
        ";
        mail($req->email,"Congratulations Your Appointment is Book",$message); 
        mail($email,"This is An Appointment for you",$message1);



        }
        
            }
       
    return $result;

    }

    public function SaveAppointmentStatus(Request $req){
        $data = new AppointmentStatus;
        $data->name = $req->name;
        $result = $data->save();
        return $result;
    }

    public function updateAppointmentStatus(Request $req){
       
        $result = AppointmentModel::where('id',$req->Appidid)->update(['status' => $req->status]);
        return $result;
    }

    public function deleteAppointmentStatus(Request $req){
        $result = AppointmentStatus::where('id',$req->id)->delete();
        return $result;
    }

    public function clientsShow(){
        $users = ClientModel::all();
        return view('content.Appointment.ViewClient')->with('tableData',$users);
    }

    //   Export client csv
      
    public function exportCSV(Request $request)
{
   $fileName = 'Client.csv';
   $tasks = ClientModel::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Id','First Name', 'Last Name', 'Email', 'Phone','Contacted  Date','Contacted Time');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['id']  = $task->id;
                $row['first_name']    = $task->first_name;
                $row['last_name']    = $task->last_name;
                $row['email']    = $task->email;
                $row['phone']    = $task->phone;
                $dt=$task->created_at;
                $d = $dt->format('m/d/Y');
                $t = $dt->format('H:i A');
                $row['Contacted  Date']  =  $d;
                $row['Contacted  Time']  =  $t;
                fputcsv($file, array($row['id'], $row['first_name'], $row['last_name'],$row['email'],$row['phone'], $row['Contacted  Date'],$row['Contacted  Time']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

 //   Export Appointment  csv
 
    public function exportappointmentCSV()
    {
        $fileName = 'Appointment.csv';
        $tableData = AppointmentModel::all();
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Id','Client Name', 'Property Name', 'Property Purpose', 'Property Location', 'Agent Name','Client Phone','Client Email','Contacted  Date','Contacted Time','Appointment  Date','Appointment Time','Appointment Status','Remark');

        $callback = function() use($tableData, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            
        foreach($tableData as $task){
            $row['id']  = $task->id;
            $cData = ClientModel::where('id',$task->client_id)->get();
            $row['clientName'] = $cData[0]->first_name .' '.  $cData[0]->last_name;

            $pCount = PropetyModel::where('id',$task->propertyId)->get();
        
            if(count($pCount) != 0){
                $row['propertyName'] = PropetyModel::where('id',$task->propertyId)->get()[0]->name;
                $row['propertypurpose'] = PropetyModel::where('id',$task->propertyId)->get()[0]->purpose;
                $row['propertylocation'] = PropetyModel::where('id',$task->propertyId)->get()[0]->address;
            }else{
                $row['propertyName'] = '';
                $row['propertypurpose'] = '';
                $row['propertylocation'] = '';
            }
            
            $aData = UserModel::where('id',$task->userId)->get();
            $row['agentName'] = $aData[0]->first_name .' '.$aData[0]->last_name;
            $row['clientphone'] = $cData[0]->phone;
            $row['clientemail'] = $cData[0]->email;
            $sData = AppointmentStatus::where('id',$task->status)->get();
            if(count($sData) == 0){
                $row['tableDataStatus'] = "Status Not Found";
    
                }
                else{
                    $row['status']=$sData[0]->name;
                }
            
            $dt=$task->created_at;
            $d = $dt->format('m/d/Y');
            $t = $dt->format('H:i A');
            $row['Contacted  Date']  =  $d;
            $row['Contacted  Time']  =  $t;
            $row['Appointment Date'] = $task->date;
            $row['Appointment Time'] = $task->time;
            $row['Remark'] = $task->remark;
            fputcsv($file, array($row['id'], $row['clientName'], $row['propertyName'],$row['propertypurpose'], $row['propertylocation'],$row['agentName'], $row['clientphone'],$row['clientemail'],$row['Contacted  Date'],$row['Contacted  Time'],$row['Appointment Date'],$row['Appointment Time'],$row['status'],$row['Remark']));
        }
        fclose($file);
    };
    return response()->stream($callback, 200, $headers);

    }
    
    public function getuserbyaddress(Request $req)
    {
        
        $result = UserModel::where('location',$req->location)->where('status','1')->get();
        return $result;

    }

    public function GetAppointment_single_data($id)
    {
       $tableData = AppointmentModel::where('id',$id)->get();

        
        $pCount = PropetyModel::where('id',$tableData[0]->propertyId)->get();
        
        if(count($pCount) != 0){
            $propertyName = PropetyModel::where('id',$tableData[0]->propertyId)->get()[0]->name;
            $propertypurpose = PropetyModel::where('id',$tableData[0]->propertyId)->get()[0]->purpose;
            $propertylocation = PropetyModel::where('id',$tableData[0]->propertyId)->get()[0]->address;
        }else{
            $propertyName = '';
            $propertypurpose = '';
            $propertylocation = '';
        }

//    $propertyName= PropetyModel::where('id',$tableData[0]->propertyId)->get()[0]->name;
//    $propertypurpose= PropetyModel::where('id',$tableData[0]->propertyId)->get()[0]->purpose;
//    $propertylocation= PropetyModel::where('id',$tableData[0]->propertyId)->get()[0]->address;

       $tableDataStatus = AppointmentStatus::where('id',$tableData[0]->status)->get()[0]->name;
       $cData = ClientModel::where('id',$tableData[0]->client_id)->get();
       $clientphone = $cData[0]->phone; 
       $clientfName = $cData[0]->first_name;
       $clientlName=$cData[0]->last_name;
       $aData = UserModel::where('id',$tableData[0]->userId)->get();
       $agentfName = $aData[0]->first_name;
       $agentlName=$aData[0]->last_name; 
       $dt=$tableData[0]->created_at;
       $d = $dt->format('m/d/Y');
       $t = $dt->format('H:i A');
       return view('content.Appointment.SingleAppointmentView')->with('clientlName',$clientlName)->with('clientfName',$clientfName)->with('propertyName',$propertyName)->with('agentfName',$agentfName)->with('agentlName',$agentlName)->with('clientphone',$clientphone)->with('tableData',$tableData)->with('tableDataStatus',$tableDataStatus)->with('propertylocation',$propertylocation)->with('propertypurpose',$propertypurpose)->with('d',$d)->with('t',$t);
    }

    public function Add_remark($id)
    {
       $appointmentstatus = AppointmentStatus::all();
       $status=AppointmentModel::where('id',$id)->get()[0]->status;
       $remark=AppointmentModel::where('id',$id)->get()[0]->remark;
       $Appidid=$id;
       return view('content.Appointment.AddRemark')->with('appointmentstatus',$appointmentstatus)->with('Appidid',$Appidid)->with('status',$status)->with('remark',$remark);
    }

    public function Save_remark(Request $req){
       $result = AppointmentModel::where('id',$req->Appidid)->update(['status' => $req->status,'remark'=>$req->remark]);
       return $result;
    }
    
    public function updateprivacy(Request $req)
    {
        return $req;
        
    }

}