<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['total', 'id_cliente', 'id_usuario', 'estado'];


    // En el modelo Venta
    public function cliente()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }
    public function detalleventa()
    {
        return $this->hasMany(Detalleventa::class, 'id_venta'); // Relación con los detalles de venta
    }
    public function productos()
{
    return $this->belongsToMany(Producto::class, 'venta_producto', 'id_venta', 'id_producto')
                ->withPivot('cantidad', 'precio_unitario')
                ->withTimestamps();
}


}
