<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function getUsers()
    {
    	$var = User::get();
    	return response()->json($var);
    }

    public function createUser()
    {
    	$info = array('name' => 'Ян', 'surname' => 'Топлес', 'e-mail' => 'toples@mail.ru', 'telephone_number' => '+79284302417', 'date_of_birth' => '1987/03/04');

    	$person = new User();
    	$person -> create($info);
    	return response() -> json('Запись добавлена');
    }

    public function updateUser()
    {
    	$change = User::where('name', 'Топа')
      ->update(['name' => 'Евгений']);

        /*$change = User::where('name', 'Евгений')
      ->update(['name' => 'Топа']);*/

      	return response()->json('Запись изменена');
    }
}
