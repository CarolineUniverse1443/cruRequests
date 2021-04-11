<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Good;

class GoodsController extends Controller
{
    public function getGoods()
    {
    	return response()->json(Good::get());
    }

    public function addGood(Request $req)
    {
    	$product = Good::create($req->all());
    	return response()->json("Товар добавлен");
    }

    public function updateGood(Request $req)
    {
    	$product = Good::where("name",$req->name)->first();/*update($req->all())*/

    	if($product)
    	{
    		$product->update($req->all());
	    	return response()->json("Запись изменена");
    	}
    	else
    		return response()->json("Запись не найдена");
    }

    public function deleteGood(Request $req)
    {
    	$product = Good::where("name", $req->name)->first();

    	if($product)
    	{
    		$product->delete();
    		return response()->json("Товар удален");
    	}
    	else
    		return response()->json("Запись не найдена");
    	
    }
}
