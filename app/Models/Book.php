<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Category;
use app\Models\Author;
use app\Models\Lend;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'category_id',
		'author_id',
		'title',
		'stock',
		'description',
	];

	//Desde la perspectiva de Book, la relación cambia, BelongsTo, 1 libro le pertenece a una categoría. Por ende es en singular. Se lee desde a libros hacia la categoría
	public function Category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	//Desde la perspectiva de Book, la relación cambia, BelongsTo, 1 libro le pertenece a un Author. Por ende es en singular. Se lee desde a libros hacia el Author
	public function Author()
	{
		return $this->belongsTo(Author::class, 'author_id', 'id');
	}

	// Un libro puede ser prestado muchas veces. Por eso es HasMany
	public function Lends()
	{
		return $this->hasMany(Lend::class, 'book_id', 'id');
		// Llave foránea -> book_id
		// Llave local -> id
	}
}
