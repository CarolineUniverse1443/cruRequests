<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function getUsers()
    {
    	$var = User::get();
    	return response()->json($var);
    }

    public function createUser(Request $req)
    {
    	//$info = array('name' => 'Ян', 'surname' => 'Топлес', 'email' => 'toples@mail.ru', 'telephone_number' => '+79284302417', 'date_of_birth' => '1987/03/04');
        
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
 
    public function registerUser(Request $req)
    {
        $label = false;
        $res = "";
        if($req->name == null)
        {
            $label = true;
            $res .= 'Не заполнено поле name \n';
        }
        if($req->surname == null)
        {
            $label = true;
            $res .= 'Не заполнено поле surname \n';
        }
        if($req->date_of_birth == null)
        {
            $label = true;
            $res .= 'Не заполнено поле date_of_birth \n';
        }
        if($req->telephone == null)
        {
            $label = true;
            $res .= 'Не заполнено поле telephone \n';
        }
        if($req->password == null)
        {
            $label = true;
            $res .= 'Не заполнено поле password \n';
        }
        if($label == false)
        {
            $user = new User();
            $user -> create($req->all());
            $res = 'Регистрация прошла успешно';         
        }

        return response()->json($res);
    }

    public function signIn(Request $req)
    {
        $user = User::where('telephone', $req->telephone)->first();

        if($user)
        {
            if($req->password == $user->password)
            {
                return response()->json('Авторизация прошла успешно');
            }
            else
            {
                return response()->json('Неправильно указан пароль');
            }
        }
        else
        {
            return response()->json('Неправильно указан логин');
        }
    }

    public function registerValidate(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'surname' => 'required',
            'date_of_birth' => 'required',
            'telephone' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $user = User::create($req->all());
        return response()->json('Регистрация прошла успешно');
    }

    public function loginValidate(Request $req) 
    {
        $validator = Validator::make($req->all(), [
            'telephone' => 'required|digits:11|exists:users,telephone',
            'password' => 'required|exists:users,password',
        ]);

        if ($validator->fails()) {
            $failedRule = $validator->failed();
            if(isset($failedRule['telephone']['Exists']) || isset($failedRule['password']['Exists']))
                return response()->json('Логин или пароль введены неверно');
            return response()->json($validator->errors());
        }

        $user = User::where("telephone",$req->telephone)->first();
        $user->api_token = Str::random(50);
        $user->save();
        return response()->json('Авторизация прошла успешно, api_token юзера: '.$user->api_token);
    }

    public function logout(Request $req)
    {
        $user = User::where("api_token",$req->api_token)->first();

        if($user && $req->api_token != null)
        {
            $user->api_token = null;
            $user->save();
            return response()->json('Пользователь разлогинился');
        }
    }
}
