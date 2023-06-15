<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gforce\JobPositionCategoryModel;
use App\Models\Gforce\JobPositionModel;
use App\Models\Gforce\CarrerModel;

class Job extends Controller
{
    public function getJobCategory(){
        $data = JobPositionCategoryModel::get();
        return $data;
    }

    public function getJobs(){
        $data = JobPositionModel::get();
        return $data;
    }

    public function submitCareerForm(Request $req){
        $data = CarrerModel::get();
        return $data;
    }
}
