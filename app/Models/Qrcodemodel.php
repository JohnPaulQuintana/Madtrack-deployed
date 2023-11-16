<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcodemodel extends Model
{
    public $fillable = ['staff_id','path','status'];
    use HasFactory;
}
