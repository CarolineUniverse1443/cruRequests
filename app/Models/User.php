<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

	public $fillable =['name','surname','date_of_birth','telephone','password', 'api_token'];

	public $hidden = ['password'];
}
