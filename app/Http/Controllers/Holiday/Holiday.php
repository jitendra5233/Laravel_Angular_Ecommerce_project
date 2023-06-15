<?php

namespace App\Http\Controllers\Holiday;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\HolidayModel;
use App\Models\Ace\Organization_calender;
use App\Models\Ace\User;

class Holiday extends Controller
{
    public function Index(){
        return view('content.Holiday.view');
    }

    public function getAllHolidays(){
        $data = HolidayModel::all();
        return $data;
    }

    public function addHoliday(Request $req){
        $userId = session('id');
        $data = new HolidayModel;
        $data->userId = $userId;
        $data->name = $req->title;
        $data->date = $req->hDate;
        $data->everyYear = $req->everyyear;
        $res = $data->save();
        return $res;
    }

    public function organization_calendar()
    {
        $data= Organization_calender::all();
        return view('content.Holiday.organization-calendar')->with('row',$data[0]);
    }

    public function updateOrganizationcal(Request $req){
        $ourdata = json_decode($req->access);
        $dataval = json_encode($ourdata);
        $result = Organization_calender::where('id',$req->id)->update(['access' => $dataval]);
        $data= Organization_calender::all();
        return view('content.Holiday.organization-calendar')->with('row',$data[0]);
    }
}
