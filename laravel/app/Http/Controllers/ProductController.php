<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Lista todos os produtos
     */
    public function index(): JsonResponse
    {
        try {
            $products = $this->productService->getAllProducts();
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Busca produto específico
     */
    public function show(string $id): JsonResponse
    {
        try {
            $product = $this->productService->getProductById((int) $id);

            if (!$product) {
                return response()->json(['error' => 'Produto não encontrado'], 404);
            }

            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Cria novo produto
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $product = $this->productService->createProduct($request->all());
            return response()->json($product, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Atualiza produto existente
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $success = $this->productService->updateProduct((int) $id, $request->all());

            if (!$success) {
                return response()->json(['error' => 'Produto não encontrado'], 404);
            }

            return response()->json(['message' => 'Produto atualizado com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove produto
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $success = $this->productService->deleteProduct((int) $id);

            if (!$success) {
                return response()->json(['error' => 'Produto não encontrado'], 404);
            }

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
