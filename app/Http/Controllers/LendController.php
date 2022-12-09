<?php

namespace App\Http\Controllers;


use App\Models\Lend;
use Illuminate\Http\Request;

class LendController extends Controller
{
	public function createLend(Request $request)
	{
		// Creación del objeto lend
		$lend = new Lend($request->all());
		$lend->save();
		return response()->json(['lend' => $lend], 201);
	}
}
