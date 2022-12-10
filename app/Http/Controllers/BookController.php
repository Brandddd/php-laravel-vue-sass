<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

	//Create
	public function createBook(Request $request)
	{
		$book = new Book($request->all());
		$book->save();
		return response()->json(['book' => $book], 201);
	}

	//Read
	public function getAllBooks()
	{
		$books = Book::get();
		return response()->json(['books' => $books], 200);
	}

	//update
	public function updateBook(Book $book, Request $request)
	{
		$book->update($request->all());
		return response()->json(['book' => $book->refresh()], 201);
	}

	//Delete
	public function deleteBook(Book $book)
	{
		$book->delete();
		return response()->json([], 204);
	}
}