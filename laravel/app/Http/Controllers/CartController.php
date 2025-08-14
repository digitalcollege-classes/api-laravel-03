<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Cria novo carrinho
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $userId = $request->input('usuario_id');
            if (!$userId) {
                return response()->json(['error' => 'ID do usuário é obrigatório'], 400);
            }

            $cart = $this->cartService->createCart((int) $userId);
            return response()->json($cart, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Busca carrinho específico
     */
    public function show(string $id): JsonResponse
    {
        try {
            $cart = $this->cartService->getCartById((int) $id);

            if (!$cart) {
                return response()->json(['error' => 'Carrinho não encontrado'], 404);
            }

            return response()->json($cart);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Adiciona produto ao carrinho
     */
    public function addProduct(Request $request, string $id): JsonResponse
    {
        try {
            $productId = $request->input('produto_id');
            $quantity = $request->input('quantidade', 1);

            if (!$productId) {
                return response()->json(['error' => 'ID do produto é obrigatório'], 400);
            }

            $success = $this->cartService->addProductToCart((int) $id, (int) $productId, (int) $quantity);

            if (!$success) {
                return response()->json(['error' => 'Falha ao adicionar produto ao carrinho'], 400);
            }

            return response()->json(['message' => 'Produto adicionado ao carrinho com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove produto do carrinho
     */
    public function removeProduct(string $cartId, string $productId): JsonResponse
    {
        try {
            $success = $this->cartService->removeProductFromCart((int) $cartId, (int) $productId);

            if (!$success) {
                return response()->json(['error' => 'Falha ao remover produto do carrinho'], 400);
            }

            return response()->json(['message' => 'Produto removido do carrinho com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Atualiza quantidade do produto no carrinho
     */
    public function updateProductQuantity(Request $request, string $cartId, string $productId): JsonResponse
    {
        try {
            $quantity = $request->input('quantidade');

            if (!$quantity) {
                return response()->json(['error' => 'Quantidade é obrigatória'], 400);
            }

            $success = $this->cartService->updateProductQuantity((int) $cartId, (int) $productId, (int) $quantity);

            if (!$success) {
                return response()->json(['error' => 'Falha ao atualizar quantidade'], 400);
            }

            return response()->json(['message' => 'Quantidade atualizada com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Finaliza carrinho
     */
    public function finalize(string $id): JsonResponse
    {
        try {
            $success = $this->cartService->finalizeCart((int) $id);

            if (!$success) {
                return response()->json(['error' => 'Falha ao finalizar carrinho'], 400);
            }

            return response()->json(['message' => 'Carrinho finalizado com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
