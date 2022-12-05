<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('books', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('category_id')->unsigned();    // El unsigned() siempre debe estar en las llaves foráneas, porque estás nunca pueden ser negativas.
			$table->bigInteger('author_id')->unsigned();    // El unsigned() siempre debe estar en las llaves foráneas, porque estás nunca pueden ser negativas.
			$table->string('title');
			$table->integer('stock')->unsigned();  // unsigned() es una restriccion que me permite hacer que este atributo NO sea menor a cero o negativo
			$table->text('description');
			$table->timestamps();
			$table->softDeletes();

			//creacion de las relaciones
			$table->foreign('category_id')
				->references('id')
				->on('categories')
				->onDelete('cascade'); // La llave foránea se llama category_id, hace referencia al 'id' de la tabla 'categories' y se puede eliminar en cascada

			$table->foreign('author_id')
				->references('id')
				->on('authors')
				->onDelete('cascade');  // Se elimina en cascada para que borre además de la categoria, todo lo relacionado a ella, el libro y el autor. Con el fin de evitar incongrencias en la base de datos
		});
	}

	public function down()
	{
		Schema::dropIfExists('books');
	}
};
