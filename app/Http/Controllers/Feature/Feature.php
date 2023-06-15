<?php

namespace App\Http\Controllers\Feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ace\FeatureModel;

class Feature extends Controller
{
    public function saveNewFeature(Request $req){
        $data = new FeatureModel;
        $data->name = $req->name;
        $result = $data->save();
        return $result;
    }
}
