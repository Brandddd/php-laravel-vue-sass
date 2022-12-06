<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('last_name');
			$table->string('email')->unique(); // unique() cosa que no se puede repetir
			$table->string('password');
			$table->timestamps(); // Crea un campo llamado created_at y updated_at lo cual indica en que fecha fue creado y en que fecha fue actualizado
			$table->softDeletes(); // Crea un campo llamado delete_at que indica cuando fue eliminado
		});
	}

	public function down()
	{
		Schema::dropIfExists('users');
	}
};
