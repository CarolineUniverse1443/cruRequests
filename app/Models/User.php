<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Model
{ 
    public $timestamps = false;

	public $fillable =['name','surname','date_of_birth','telephone','password', 'api_token'];

	//public $hidden = ['password'];

	public function generate()
	{
		$token = Str::random(50);
		$this->api_token = $token;
		$this->save();
		return $token;
	}
}
