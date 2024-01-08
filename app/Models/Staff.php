<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    public $fillable = ['first_name', 'last_name', 'middle_name', 'birthdate', 'gender', 'contact', 'hired', 'address', 'present'];
    use HasFactory;
}
