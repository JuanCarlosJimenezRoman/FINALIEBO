<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Venta;

class AdminVentaController extends Controller
{
    public function index()
{
    // Obtén todas las ventas con cliente y detalles
    $ventas = Venta::with('cliente', 'detalleventa.producto')->get();

    // Retorna las ventas en formato JSON para DataTables
    return response()->json([
        'data' => $ventas,
    ]);
}
public function cambiarEstado(Request $request, $id)
{
    $venta = Venta::find($id);

    if (!$venta) {
        return response()->json(['success' => false, 'error' => 'Venta no encontrada'], 404);
    }

    if (!in_array($request->estado, ['pendiente', 'aprobado', 'cancelado'])) {
        return response()->json(['success' => false, 'error' => 'Estado inválido'], 400);
    }

    $venta->estado = $request->estado;
    $venta->save();

    return response()->json(['success' => true]);
}

public function detalles($id)
{
    // Obtén la venta con cliente y productos relacionados

    $venta = Venta::with('detalleventa.producto')->findOrFail($id);


    if (!$venta) {
        return redirect()->route('sales.list')->with('error', 'Venta no encontrada.');
    }

    return view('venta.detalles', compact('venta'));
}
public function edit($id)
{
    $venta = Venta::with('detalleventa.producto', 'cliente')->findOrFail($id);
    return view('ventas.edit', compact('venta'));
}

public function ticket($id)
{
    $venta = Venta::with('detalleventa.producto', 'cliente')->findOrFail($id);
    return view('ventas.ticket', compact('venta')); // Asegúrate de crear esta vista
}

public function destroy($id)
{
    $venta = Venta::findOrFail($id);

    // Eliminar los detalles asociados primero
    $venta->detalleventa()->delete();

    // Luego eliminar la venta
    $venta->delete();

    return redirect()->route('sales.list')->with('success', 'Venta eliminada correctamente.');
}



}
