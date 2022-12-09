<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = [
		'name',
		'biography',
	];

	// Lleva Books porque una categoria tiene muchos libros (Ver diagrama)
	public function Books()
	{
		// Tiene muchos hasMany(Book::class <- Se le indica la clase Book en este caso para así crear la relación 1 a muchos.
		return $this->hasMany(Book::class, 'author_id', 'id');
		// llave foránea foreign_key -> author_id que proviene de Books
		// lave local local_key -> id que proviene de Authors
	}
}
