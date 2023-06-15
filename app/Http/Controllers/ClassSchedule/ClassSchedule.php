<?php

namespace App\Http\Controllers\ClassSchedule;
use App\Http\Controllers\Controller;
use App\Models\Gforce\Branch;
use App\Models\Gforce\TrainerModel;
use App\Models\Gforce\OpenClassModel;
use App\Models\Gforce\ProjectClassModel;
use App\Models\Gforce\WorkshopModel;
use Illuminate\Http\Request;

class ClassSchedule extends Controller
{
   public function index()
   {

    $AllProjectValue [] ='';
    $AllOpenValue [] ='';
    $from_date=date("Y-m-d");
    $AllProjectValue = ProjectClassModel::orderBy('id', 'DESC')->get();
        foreach($AllProjectValue as $row){
            $row['projectclassid']=$row['id'];
            $branch = Branch::where('id',$row->branchname)->get();
            if(count($branch) != 0){
                $row['ProjectbranchName'] = $branch[0]->name;
            }else{
                $row['ProjectbranchName'] = '';
            }
            $trainer = TrainerModel::where('id',$row->trainer_id)->get();
            if(count($trainer) != 0){
                $row['Projecttrainername'] = $trainer[0]->name;
            }else{
                $row['Projecttrainername'] = '';
            }
        }

        $AllOpenValue = OpenClassModel::where('scheduledate', '>=', $from_date)->orderBy('id', 'DESC')->get();
        foreach($AllOpenValue as $row1){
            $row1['openclassid']=$row1['id'];
            $branch = Branch::where('id',$row1->branchname)->get();
            if(count($branch) != 0){
                $row1['OpnebranchName'] = $branch[0]->name;
            }else{
                $row1['OpnebranchName'] = '';
            }
            $trainer = TrainerModel::where('id',$row1->trainer_id)->get();
            if(count($trainer) != 0){
                $row1['Opnetrainername'] = $trainer[0]->name;
            }else{
                $row1['Opnetrainername'] = '';
            }
        }


        $getAllWorkshop= WorkshopModel::orderBy('id', 'DESC')->get();
        foreach($getAllWorkshop as $row)
        {

            $branch = Branch::where('id',$row->branch_id)->get();
            if(count($branch) != 0){
            $row['workshopbranchName'] = $branch[0]->name;
            }else{
            $row['workshopbranchName'] = '';
            }
            $trainer = TrainerModel::where('id',$row->trainer_id)->get();
            if(count($trainer) != 0){
                $row['workshoptrainername'] = $trainer[0]->name;
            }else{
                $row['workshoptrainername'] = '';
            }
        $workshopdates = json_decode($row->workshopdates,TRUE);
        
        $projectClassName =ProjectClassModel::where('id',$row->class_id)->get();

        if(count($projectClassName) != 0){
            $row['workshopprojectClassName'] = $projectClassName[0]->name;
        }else{
            $row['workshopprojectClassName'] = 'NA';
        }

         $row['workshopdates'] =$workshopdates;

        }
      
        // $mergarray = $AllOpenValue->merge($AllProjectValue);


        return view('content.classSchedule.classScheduleView')->with('AllProjectValue',$AllProjectValue)->with('AllOpenValue',$AllOpenValue)->with('getAllWorkshop',$getAllWorkshop);
   }
}
