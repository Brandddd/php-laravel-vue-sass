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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    //protected $casts = [
    //    'email_verified_at' => 'datetime',
    //];

	public function CustomerLends()
	{
		return $this->hasMany(Lend::class, 'customer_user_id', 'id');
	}

	public function OwnerLends()
	{
		return $this->hasMany(Lend::class, 'owner_user_id', 'id');
	}
}
