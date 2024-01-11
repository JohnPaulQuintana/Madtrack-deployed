<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rejected extends Model
{
    use HasFactory;
    public $fillable = ['inventories_id','product_type','product_name','product_brand','stocks','product_pcs_price','product_pack_price','product_pcs_per_pack', 'description'];

}
