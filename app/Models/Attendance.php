<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $fillable = [ 'staff_id', 'time_in','time_out','day', 'month', 'year', 'status'];
    use HasFactory;
}
