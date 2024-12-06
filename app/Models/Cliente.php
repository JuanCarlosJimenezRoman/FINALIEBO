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
  ];

  protected $fillable = ['nombre', 'telefono', 'direccion', 'user_id'];

  public function user()
{
    return $this->belongsTo(User::class);
}


}


