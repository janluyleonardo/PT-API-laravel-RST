<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 15);
            $perPage = min($perPage, 10);
            $products = Product::paginate($perPage);
            return response()->json($products);
        } catch (\Throwable $th) {
            Log::channel('daily')->error("Error al consultar los productos: " . $th->getMessage());
            return $this->errorResponse('500', "Error al obtener los productos.", $this->extractDetailError($th->getMessage()),);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::create($request->validated());
            DB::commit();
            return response()->json([
                'message' => 'Producto creado con éxito',
                'data' => $product,
                'status' => true
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::channel('daily')->error("Error al crear el producto: " . $th->getMessage());
            return $this->errorResponse('500', "En store creando producto.", $this->extractDetailError($th->getMessage()),);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json($product);
        } catch (\Throwable $th) {
            Log::channel('daily')->error("Error consultando el producto: {$id} " . $th->getMessage());
            return $this->errorResponse('500', "En show consultando producto.", $this->extractDetailError($th->getMessage()),);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $product->update($request->validated());
            DB::commit();
            return response()->json([
                'message' => 'Producto actualizado con éxito',
                'data' => $product->fresh(),
                'status' => true
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::channel('daily')->error("Error actualizando el producto: {$product->id} " . $th->getMessage());
            return $this->errorResponse('500', "En update actualizando producto.", $this->extractDetailError($th->getMessage()),);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            DB::beginTransaction();
            $product->delete();
            DB::commit();
            return response()->json([
                'message' => 'Producto eliminado con éxito',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::channel('daily')->error("Error eliminando el producto: {$id} " . $th->getMessage());
            return $this->errorResponse('500', "En destroy eliminando producto.", $this->extractDetailError($th->getMessage()),);
        }
    }
}
