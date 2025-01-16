<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Muestra una lista de clientes.
     */
    public function index()
    {
        $clientes = Cliente::with('user')->get(); // Relación con usuarios
        return view('cliente.index', compact('clientes'));
    }

    /**
     * Muestra el formulario para crear un nuevo cliente.
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Guarda un nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'plante_educativo' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
        ]);

        // Crear el usuario relacionado
        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'cliente', // Rol predeterminado
        ]);

        // Crear el cliente y asociarlo al usuario
        Cliente::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'user_id' => $user->id, // Asociar al usuario recién creado
            'plante_educativo' => $request->plante_educativo,
            'region' => $request->region,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Muestra un cliente específico.
     */
    public function show($id)
    {
        $cliente = Cliente::with('user')->findOrFail($id);
        return view('cliente.show', compact('cliente'));
    }

    /**
     * Muestra el formulario para editar un cliente.
     */
    public function edit($id)
    {
        $cliente = Cliente::with('user')->findOrFail($id);
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Actualiza un cliente en la base de datos.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'plante_educativo' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
        ]);

        // Actualizar el cliente
        $cliente->update([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'plante_educativo' => $request->plante_educativo,
            'region' => $request->region,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Elimina un cliente de la base de datos.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        // Eliminar el usuario relacionado
        if ($cliente->user) {
            $cliente->user->delete();
        }

        // Eliminar el cliente
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }

    public function cliente()
{
    return $this->belongsTo(Cliente::class, 'id_cliente');
}

}
