<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Book;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = [
		'name',
	];

	// Lleva Books porque una categoria tiene muchos libros (Ver diagrama)
	public function Books()
	{
		// Tiene muchos hasMany(Book::class <- Se le indica la clase Book en este caso para así crear la relación 1 a muchos.
		return $this->hasMany(Book::class, 'category_id', 'id');
		// llave foránea foreign_key -> category_id que proviene de Books
		// lave local local_key -> id que proviene de Categories
	}
}
