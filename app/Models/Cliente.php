<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    static $rules = [
        'nombre' => 'required',
        'telefono' => 'required',
        'direccion' => 'required',
        'id_usuario' => 'required', // O cualquier clave foránea que relaciones al usuario
        'plante_educativo' => 'nullable|string|max:255',
        'region' => 'nullable|string|max:255',
    ];

    protected $fillable = ['nombre', 'telefono', 'direccion', 'user_id', 'plante_educativo', 'region'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



