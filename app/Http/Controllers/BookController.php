<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;

class BookController extends Controller
{
	// Mostrar libros
	public function showBooks()
	{
		// Retornando una vista que va para la carpeta books -> index
		return view('books.index');
	}

	// Mostrar home con libros
	public function showHomeWithBooks()
	{
		// El return de getAllBooks queda en la variable $books
		$books = $this->getAllBooks()->original['books'];  // Se obtuvo desde getAllBooks haciendo debugging
		// Para mostrar una vista desde cualquier controlador, se retorna la función View, y su posicionamiento, en este caso Home:
		return view('index', compact('books'));  // Compact sirve para pasar a la vista la variable que contiene todos los libros.
	}

	// Read
	public function getAllBooks()
	{
		$books = Book::get();
		return response()->json(['books' => $books], 200);
	}

	// Create
	public function createBook(CreateBookRequest $request)
	{
		$book = new Book($request->all());
		$book->save();
		return response()->json(['book' => $book], 201);
	}

	public function getAnBook(Book $book)
	{
		return response()->json(['book' => $book], 200);
	}

	// update
	public function updateBook(Book $book, UpdateBookRequest $request)
	{
		$book->update($request->all());
		return response()->json(['book' => $book->refresh()], 201);
	}

	// Delete
	public function deleteBook(Book $book)
	{
		$book->delete();
		return response()->json([], 204);
	}
}
