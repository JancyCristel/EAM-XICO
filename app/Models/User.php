<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'no_telefono',
        'sexo',
        'direccion',
        'rol',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'idUser');
    }
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'idUser');
    }

        public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'idUsuario');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'idUsuario');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class); // Relación uno a muchos con Address
    }
    

}
