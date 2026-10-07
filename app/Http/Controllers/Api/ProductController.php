<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
 
class ProductController extends Controller
{
    // GET /api/products
    public function index()
    {
        return response()->json(Product::latest()->get(), 200);
    }
 
    // POST /api/products
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);
 
        $product = Product::create($data);
 
        return response()->json($product, 201);
    }
 
    // GET /api/products/{product}
    public function show(Product $product)
    {
        return response()->json($product, 200);
    }
 
    // PUT/PATCH /api/products/{product}
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'sometimes|required|numeric|min:0',
            'stock'       => 'sometimes|required|integer|min:0',
        ]);
 
        $product->update($data);
 
        return response()->json($product, 200);
    }
 
    // DELETE /api/products/{product}
    public function destroy(Product $product)
    {
        $product->delete();
 
        return response()->json(['message' => 'Producto eliminado'], 200);
    }
}
