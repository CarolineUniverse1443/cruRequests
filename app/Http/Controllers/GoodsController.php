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
    	$product = Good::where("name",$req->name)->update($req->all());
    	return response()->json("Запись изменена");
    }

    public function deleteGood(Request $req)
    {
    	$product = Good::where("name", $req->name)->delete();
    	return response()->json("Товар удален");
    }
}
