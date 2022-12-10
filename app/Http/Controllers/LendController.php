<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lend\CreateLendRequest;
use App\Models\Lend;
use Illuminate\Http\Request;

class LendController extends Controller
{
	public function createLend(CreateLendRequest $request)
	{
		// Creación del objeto lend
		$lend = new Lend($request->all());
		$lend->save();
		return response()->json(['lend' => $lend], 201);
	}
}
