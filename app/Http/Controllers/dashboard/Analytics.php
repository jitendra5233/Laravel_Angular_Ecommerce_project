<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gforce\StudentsModel;
use App\Models\Gforce\WorkshopModel;
use App\Models\Gforce\ProjectClassModel;
use App\Models\Gforce\OpenClassModel;
use App\Models\Gforce\Branch;
use App\Models\Gforce\Package;


class Analytics extends Controller
{
  public function index()
  {
    $role=session()->get('role');
    $id=session()->get('id');
    $totalworkshop = WorkshopModel::count();
    $totalbranch = Branch::count();
    $activeworkshop=WorkshopModel::where('status','1')->count();
    $activeprojectclasses=ProjectClassModel::where('status','1')->count();
    $totalprojectclasses =ProjectClassModel::count();
    $activeopenclasses=OpenClassModel::where('status','1')->count();
    $totalopenclasses =OpenClassModel::count();
    $students = StudentsModel::count();
    $package = Package::count();


    // $from_date=date("Y-m-d");

    return view('content.dashboard.dashboards-analytics')->with('totalworkshop',$totalworkshop)->with('activeworkshop',$activeworkshop)->with('activeprojectclasses',$activeprojectclasses)->with('totalprojectclasses',$totalprojectclasses)->with('activeopenclasses',$activeopenclasses)->with('totalopenclasses',$totalopenclasses)->with('students',$students)->with('totalbranch',$totalbranch)->with('package',$package);
  }
}