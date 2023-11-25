<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeout extends Model
{
    use HasFactory;
    public $fillable = ['employee_id','timeout','status'];
}
