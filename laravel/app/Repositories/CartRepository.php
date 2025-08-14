<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    protected $model;

    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }

    public function create(array $data): Cart
    {
        return $this->model->create($data);
    }

    /**
     * Busca carrinho por ID
     */
    public function findById(int $id): ?Cart
    {
        return $this->model->with(['products', 'user'])->find($id);
    }

    /**
     * Busca carrinho ativo do usuário
     */
    public function findActiveByUser(int $userId): ?Cart
    {
        return $this->model->where('usuario_id', $userId)
                            ->where('status', 'ativo')
                            ->with('products')
                            ->first();
    }

    /**
     * Adiciona produto ao carrinho
     */
    public function addProduct(int $cartId, int $productId, int $quantity, float $unitPrice): bool
    {
        $cart = $this->model->find($cartId);
        if (!$cart) {
            return false;
        }

        // Verifica se o produto já existe no carrinho
        $existingProduct = $cart->products()->where('produto_id', $productId)->first();

        if ($existingProduct) {
            // Atualiza a quantidade se já existe
            $newQuantity = $existingProduct->pivot->quantidade + $quantity;
            $cart->products()->updateExistingPivot($productId, [
                'quantidade' => $newQuantity,
                'preco_unitario' => $unitPrice
            ]);
        } else {
            // Adiciona novo produto
            $cart->products()->attach($productId, [
                'quantidade' => $quantity,
                'preco_unitario' => $unitPrice
            ]);
        }

        return true;
    }

    /**
     * Remove produto do carrinho
     */
    public function removeProduct(int $cartId, int $productId): bool
    {
        $cart = $this->model->find($cartId);
        if (!$cart) {
            return false;
        }

        $cart->products()->detach($productId);
        return true;
    }

    /**
     * Atualiza quantidade do produto no carrinho
     */
    public function updateProductQuantity(int $cartId, int $productId, int $quantity): bool
    {
        $cart = $this->model->find($cartId);
        if (!$cart) {
            return false;
        }

        $cart->products()->updateExistingPivot($productId, [
            'quantidade' => $quantity
        ]);

        return true;
    }

    /**
     * Finaliza carrinho
     */
    public function finalize(int $cartId): bool
    {
        $cart = $this->model->find($cartId);
        if (!$cart) {
            return false;
        }

        return $cart->update(['status' => 'finalizado']);
    }

    /**
     * Atualiza total do carrinho
     */
    public function updateTotal(int $cartId): bool
    {
        $cart = $this->model->find($cartId);
        if (!$cart) {
            return false;
        }

        $total = $cart->calculateTotal();
        return $cart->update(['total' => $total]);
    }
}
