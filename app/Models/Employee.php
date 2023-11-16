<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $fillable = ['employee_id','time_in','day','month','year', 'status'];

    // belongs to user class
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
