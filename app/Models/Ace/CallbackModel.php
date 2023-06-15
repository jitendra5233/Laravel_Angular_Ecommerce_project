<?php

namespace App\Models\Ace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallbackModel extends Model
{
    use HasFactory;
    protected $table = 'request_callback';
}
