<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Credito;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    // GET /api/creditos
    public function index()
    {
        $creditos = Credito::with(['cliente', 'producto'])
            ->latest()
            ->get();

        return response()->json($creditos, 200);
    }

    // POST /api/creditos
    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'product_id' => 'required|exists:products,id',
            'valor_producto' => 'required|numeric|min:0',
            'cuota_inicial' => 'required|numeric|min:0',
            'saldo' => 'required|numeric|min:0',
            'numero_cuotas' => 'required|integer|min:1|max:12',
            'valor_cuota' => 'required|numeric|min:0',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|in:activo,pagado,mora',
        ]);

        $credito = Credito::create($data);

        return response()->json(
            $credito->load(['cliente', 'producto']),
            201
        );
    }

    // GET /api/creditos/{credito}
    public function show(Credito $credito)
    {
        return response()->json(
            $credito->load(['cliente', 'producto']),
            200
        );
    }

    // PUT/PATCH /api/creditos/{credito}
    public function update(Request $request, Credito $credito)
    {
        $data = $request->validate([
            'cliente_id' => 'sometimes|required|exists:clientes,id',
            'product_id' => 'sometimes|required|exists:products,id',
            'valor_producto' => 'sometimes|required|numeric|min:0',
            'cuota_inicial' => 'sometimes|required|numeric|min:0',
            'saldo' => 'sometimes|required|numeric|min:0',
            'numero_cuotas' => 'sometimes|required|integer|min:1|max:12',
            'valor_cuota' => 'sometimes|required|numeric|min:0',
            'fecha_inicio' => 'sometimes|required|date',
            'estado' => 'sometimes|required|in:activo,pagado,mora',
        ]);

        $credito->update($data);

        return response()->json(
            $credito->load(['cliente', 'producto']),
            200
        );
    }

    // DELETE /api/creditos/{credito}
    public function destroy(Credito $credito)
    {
        $credito->delete();

        return response()->json([
            'message' => 'Crédito eliminado'
        ], 200);
    }
}