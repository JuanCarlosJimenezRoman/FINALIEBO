<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compania;
use App\Models\Detalleventa;
use App\Models\Venta;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

/**
 * Class VentaController
 * @package App\Http\Controllers
 */
class VentaController extends Controller
{
    public function index()
    {
        return view('venta.index');
    }

    public function store(Request $request)
    {
        $datosVenta = $request->all();

        $id_cliente = $datosVenta['id_cliente'] ?? null;
        $total = (float) Cart::subtotal();

        if ($total > 0) {
            $userId = Auth::id();
            $sale = Venta::create([
                'total' => $total,
                'id_cliente' => $id_cliente,
                'id_usuario' => $userId,
                'estado' => 'pendiente',
            ]);

            if ($sale) {
                foreach (Cart::content() as $item) {
                    Detalleventa::create([
                        'precio' => $item->price,
                        'cantidad' => $item->qty,
                        'id_producto' => $item->id,
                        'id_venta' => $sale->id,
                    ]);
                }
                Cart::destroy();
                return response()->json([
                    'title' => 'VENTA GENERADA',
                    'icon' => 'success',
                    'ticket' => $sale->id,
                ]);
            }
        }

        return response()->json([
            'title' => 'CARRITO VACÍO',
            'icon' => 'warning',
        ]);
    }

    public function ticket($id)
    {
        $venta = Venta::with(['cliente', 'detalleventa.producto'])->find($id);

        if (!$venta) {
            return redirect()->route('venta.index')->with('error', 'Venta no encontrada.');
        }

        $company = [
            'nombre' => 'INSTITUTO DE ESTUDIO DE BACHILLERATO DE OAXACA',
            'direccion' => 'Dalias 321, Reforma, 68050 Oaxaca de Juárez, Oax.',
            'telefono' => '951 518 6601',
        ];

        return view('tickets.ticket', [
            'venta' => $venta,
            'productos' => $venta->detalleventa,
            'fecha' => now()->format('d/m/Y'),
            'hora' => now()->format('H:i:s'),
            'company' => $company,
        ]);
    }

    public function show()
{
    $ventas = Venta::all(); // Cargar todas las ventas
    return view('venta.show', compact('ventas'));
}


    public function cliente(Request $request)
    {
        $term = $request->get('term');
        $clients = Cliente::where('nombre', 'LIKE', '%' . $term . '%')
            ->select('id', 'nombre AS label', 'telefono', 'direccion')
            ->limit(10)
            ->get();
        return response()->json($clients);
    }

    public function edit($id)
    {
        $venta = Venta::with('detalleventa.producto', 'cliente')->findOrFail($id);
        return view('ventas.edit', compact('venta'));
    }

    public function update(Request $request, $id)
    {
        $venta = Venta::findOrFail($id);

        $venta->estado = $request->input('estado', $venta->estado);
        $venta->save();

        foreach ($request->input('productos', []) as $detalleId => $detalleData) {
            $detalle = Detalleventa::findOrFail($detalleId);
            $detalle->cantidad = $detalleData['cantidad'];
            $detalle->precio = $detalleData['precio'];
            $detalle->save();
        }

        return redirect()->route('ventas.detalles', $venta->id)->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);

        $venta->detalleventa()->delete();
        $venta->delete();

        return redirect()->route('sales.list')->with('success', 'Venta eliminada correctamente.');
    }

    public function detalles($id)
    {
        // Carga la venta por su ID con sus relaciones
        $venta = Venta::with(['cliente', 'productos'])->find($id);

        // Si no se encuentra la venta, retorna un error 404
        if (!$venta) {
            abort(404, 'La venta no fue encontrada.');
        }

        // Retorna la vista con los datos de la venta
        return view('venta.detalles', compact('venta'));
    }
}
