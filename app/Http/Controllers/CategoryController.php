<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
	public function getAllCategories()
	{
		$categories = Category::get();
		return response()->json(['categories' => $categories], 200);
	}
}
