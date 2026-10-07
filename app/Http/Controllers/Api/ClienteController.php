<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // GET /api/clientes
    public function index()
    {
        return response()->json(
            Cliente::latest()->get(),
            200
        );
    }

    // POST /api/clientes
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'documento' => 'required|string|max:50|unique:clientes,documento',
            'telefono' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        $cliente = Cliente::create($data);

        return response()->json($cliente, 201);
    }

    // GET /api/clientes/{cliente}
    public function show(Cliente $cliente)
    {
        return response()->json($cliente, 200);
    }

    // PUT/PATCH /api/clientes/{cliente}
    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'documento' => 'sometimes|required|string|max:50|unique:clientes,documento,' . $cliente->id,
            'telefono' => 'sometimes|required|string|max:30',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        $cliente->update($data);

        return response()->json($cliente, 200);
    }

    // DELETE /api/clientes/{cliente}
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return response()->json([
            'message' => 'Cliente eliminado'
        ], 200);
    }
}