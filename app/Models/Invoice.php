<?php

namespace App\Models;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    public $fillable = ['inventories_id','sold_to','quantity','price','date'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventories_id', 'id');
    }
}


