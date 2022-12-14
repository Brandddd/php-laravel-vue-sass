<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function getAllAuthors()
	{
		$authors = Author::get();
		return response()->json(['authors' => $authors], 200);
	}
}
