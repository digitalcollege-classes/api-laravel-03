<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::with(['category', 'advertisements']);

        // Filtros opcionais
        if ($request->has('category_id')) {
            $query->byCategory($request->category_id);
        }

        if ($request->has('brand')) {
            $query->byBrand($request->brand);
        }

        if ($request->has('condition')) {
            $query->byCondition($request->condition);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $query->priceRange($request->min_price, $request->max_price);
        }

        if ($request->has('active_only') && $request->boolean('active_only')) {
            $query->active();
        }

        $products = $query->paginate(15);
        
        return response()->json([
            'success' => true,
            'data' => $products->items(),
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ],
            'message' => 'Products retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'brand' => 'nullable|string|max:50',
            'condition' => 'required|in:new,used,refurbished',
            'price' => 'nullable|numeric|min:0|max:99999999.99',
            'image_path' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $product = Product::create($validated);
        $product->load('category');

        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product created successfully'
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        $product->load(['category', 'advertisements.product']);
        
        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => 'sometimes|required|exists:categories,id',
            'name' => 'sometimes|required|string|max:100',
            'description' => 'nullable|string',
            'brand' => 'nullable|string|max:50',
            'condition' => 'sometimes|required|in:new,used,refurbished',
            'price' => 'nullable|numeric|min:0|max:99999999.99',
            'image_path' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $product->update($validated);
        $product->load('category');

        return response()->json([
            'success' => true,
            'data' => $product->fresh(['category']),
            'message' => 'Product updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        try {
            // Verifica se há anúncios ativos associados
            $activeAds = $product->advertisements()->where('status', 'active')->count();
            if ($activeAds > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete product with active advertisements'
                ], Response::HTTP_CONFLICT);
            }

            $product->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting product: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Toggle product active status.
     */
    public function toggleActive(Product $product): JsonResponse
    {
        if ($product->isActive()) {
            $product->deactivate();
            $message = 'Product deactivated successfully';
        } else {
            $product->activate();
            $message = 'Product activated successfully';
        }

        return response()->json([
            'success' => true,
            'data' => $product->fresh(),
            'message' => $message
        ]);
    }
}
