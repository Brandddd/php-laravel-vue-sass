<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use app\Models\Lend;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

	protected $table = 'users';

	// Atributos que se van a llenar en base de datos:
    protected $fillable = [
		'number_id',
        'name',
		'last_name',
        'email',
        'password',
    ];

	// El full_name en snake_case hace referencia al CamelCase del accessor, GetFullNameAttributes. Asi se muestra siempre por cada consulta.
	protected $appends = ['full_name'];

	// Ocultar datos a la hora de consultar
    protected $hidden = [
        'password',
        'remember_token',
    ];

	// Castear y modificar los datos a la hora de consutar
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',   // 2022-05-06. Por base datos normal mostraría mucha información, gracias a la casteada, se puede modificar la forma del formato en que llega.
        'updated_at' => 'datetime:Y-m-d',
    ];

	// Accessor, solo se ejecuta cuando se hace una consulta
	public function getFullNameAttribute()
	{
		return "{$this->name} {$this->last_name}";
	}

	// Mutator, solo se ejecuta en create o update.  $value -> valor del atributo, en este caso sería el password.
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);  // Coge el atributo password, y lo encripta con la función bcrypt.
	}

	// ------------------------------ Relations -------------------------------------
	// Prestamos que adquirió el cliente
	public function CustomerLends()
	{
		return $this->hasMany(Lend::class, 'customer_user_id', 'id');
	}

	// Prestamos que hizo el bibliotecario
	public function OwnerLends()
	{
		return $this->hasMany(Lend::class, 'owner_user_id', 'id');
	}
}
