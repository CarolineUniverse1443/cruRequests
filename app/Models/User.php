<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

/*    public $table -> timestamp('updated_at') -> nullable();
*/
    public $fillable =['name','surname','e-mail','telephone_number', 'date_of_birth'];

    public $guarded = ['ID'];	
}
