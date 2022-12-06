<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
		Schema::table('users', function (Blueprint $table) {
			// Se pone nullable(), para que los usuarios que no tengan este valor en el campo, lo asigne como null, para evitar conflictos errores o un default('texto_default') para asignar valor especifico
			$table->string('number_id')->after('id')->nullable();  // aquellos numeros que no se sumen, se comportan como un str / after('id') para que se ubique despues de algun atributo, en este caso id
        });
    }

	// No es necesario poner el down en este tipo de tablas
};
