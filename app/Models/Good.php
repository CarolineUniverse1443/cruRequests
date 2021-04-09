<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    //use HasFactory;
	public $timestamps = false;

    public $fillable = ['name', 'brand', 'amount', 'price'];
}
