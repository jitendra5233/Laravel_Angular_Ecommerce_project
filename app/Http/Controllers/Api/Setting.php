<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\Customize;
use App\Models\Gforce\TrainerModel;

class Setting extends Controller
{
    public function getSettingData(){
        $data = Customize::get();
        return $data;
    }

    public function  GetAllTeam()
    {
        $data=TrainerModel::all()->take(4);
        return $data;
    }
}
