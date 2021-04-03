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

    public function createUser(Request $req)
    {
    	//$info = array('name' => 'Ян', 'surname' => 'Топлес', 'e-mail' => 'toples@mail.ru', 'telephone_number' => '+79284302417', 'date_of_birth' => '1987/03/04');
        
    	$person = new User();
    	$person -> create($req->all());
        //$person->save(); - 2 variant
    	return response() -> json('Запись добавлена');
    }

    public function updateUser(Request $req)
    {
        $user = User::where("name",$req->name)->first();

        return response()->json($user->update($req->all()));

        /*$user = User::where("ID", $req->id)->first();
    	//$user = User::where('name', $req->name)->first();
        $user->name = $req->name;
        $user->surname = $req->surname;
        $user->email = $req->email;
        $user->telephone_number = $req->telephone_number;
        $user->date_of_birth = $req->date_of_birth;*/

        /*$change = User::where('name', 'Евгений')
      ->update(['name' => 'Топа']);
*/
        /*$change = User::where('name', 'Топа')
      ->update(['name' => 'Евгений']);  
      	return response()->json('Запись изменена'/*$user->save()); */
    }
}
