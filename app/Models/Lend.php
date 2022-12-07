<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Book;
use app\models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lend extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'owner_user_id',
		'customer_user_id',
		'book_id',
		'date_out',
		'date_in',
		'status',
	];

	// Cada prestamo se le hace a un libro. 1 a 1
	public function Book()
	{
		return $this->belongsTo(Book::class, 'book_id', 'id');
	}

	// Propietario
	public function Owner()
	{
		return $this->belongsTo(User::class, 'owner_user_id', 'id');
	}

	// Cliente que registro el prestamo
	public function Customer()
	{
		return $this->belongsTo(User::class, 'customer_user_id', 'id');
	}
}
