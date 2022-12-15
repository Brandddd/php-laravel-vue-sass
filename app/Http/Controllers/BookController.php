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
		$books = Book::with('Author')->get();
		return response()->json(['books' => $books], 200);
	}

	public function getABook(Book $book)
	{
		$book->load('Author', 'Category');
		return response()->json(['book' => $book], 200);
	}

	// Create
	public function createBook(CreateBookRequest $request)
	{
		$book = new Book($request->all());
		$book->save();
		return response()->json(['book' => $book], 201);
	}

	// update
	public function updateBook(Book $book, UpdateBookRequest $request)
	{
		// update -> actualiza la rquest con all()
		$book->update($request->all());
		// Con el refresh mostramos el libro actualizado y con el load cargamos el author y la category para mostrarla
		return response()->json(['book' => $book->refresh()->load('Author', 'Category')], 201);
	}

	// Delete
	public function deleteBook(Book $book)
	{
		$book->delete();
		return response()->json([], 204);
	}
}
