<?php

namespace App\Models\gforce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    
    public $table = 'package';
    public $timestamps = false;
}
