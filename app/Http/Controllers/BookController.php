<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
		$this->uploadImage($request, $book);
		$book->save();
		return response()->json(['book' => $book], 201);
	}

	// update
	public function updateBook(Book $book, UpdateBookRequest $request)
	{
		// Se crea una variable para que la imagen que llegue a actualizar se almacene bien y no se sobreescriba
		$request_data = $request->all();
		// update -> actualiza la rquest con all() / Se manda el request con el book hacia la imagen
		$this->uploadImage($request, $book);
		// Se le asigna la imagen al book image nuevamente para que no se sobre escriba y se pasa al update
		$request_data['image'] = $book->image;
		$book->update($request_data);
		// Con el refresh mostramos el libro actualizado y con el load cargamos el author y la category para mostrarla
		return response()->json(['book' => $book->refresh()->load('Author', 'Category')], 201);
	}

	// Delete
	public function deleteBook(Book $book)
	{
		$book->delete();
		return response()->json([], 204);
	}

	// Logica para subir la imagen
	// El & es para conservar el mismo espacio de memoria, para quelas varibles de book sean iguales, indepediente de lo que llegue
	private function uploadImage($request, &$book)
	{
		// SI no existe la imagen que viene por request, que lo retorne
		if (!isset($request->image)) return;
		// Si existe:
		// 1. Se le debe dar un nombre a la imagen para poderla almacenar
		$random = Str::random(20);  // Nombre aleatorio de 8 digitos para la imagen
		$image_name = "{$random}.{$request->image->clientExtension()}";  // Se lo pasamos a la imagen + La extension de la imagen que venga por request.
		// Función que me mueve la imagen a su dirección
		// Esta la del storage es para imagenes y datos sensibles. La ota ruta seriá public, que no cubre los datos
		$request->image->move(storage_path('app/public/images'), $image_name);
		// Pasamos el libro para poder settear la imagen con el libro y este no pierda le referencia de su imagen.
		$book->image = $image_name;
	}
}
