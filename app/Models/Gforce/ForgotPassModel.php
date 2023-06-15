<?php

namespace App\Models\Gforce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotPassModel extends Model
{
    use HasFactory;
    public $table = 'forgotpassword';
    public $timestamps = false;
}
