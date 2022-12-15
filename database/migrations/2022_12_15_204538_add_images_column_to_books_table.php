<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
		Schema::table('books', function (Blueprint $table) {
			// Se crea la tabla de nombre image, que se ponga después del titulo del libro y debe ser nullable
			$table->string('image')->after('title')->nullable;
        });
    }
};
