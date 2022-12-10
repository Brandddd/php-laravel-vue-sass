<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lend\CreateLendRequest;
use App\Http\Requests\Lend\UpdateLendRequest;
use App\Models\Lend;

class LendController extends Controller
{
	public function createLend(CreateLendRequest $request)
	{
		// Creación del objeto lend
		$lend = new Lend($request->all());
		$lend->save();
		return response()->json(['lend' => $lend], 201);
	}

	public function updateLend(Lend $lend, UpdateLendRequest $request)
	{
		$lend->update($request->all());
		return response()->json(['lend' => $lend->refresh()], 201);
	}
}
