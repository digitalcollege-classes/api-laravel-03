<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use App\Models\Cart;

class CartService
{
    protected $cartRepository;
    protected $productRepository;

    public function __construct(
        CartRepository $cartRepository,
        ProductRepository $productRepository
    ) {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Cria novo carrinho
     */
    public function createCart(int $userId): Cart
    {
        // Verifica se já existe um carrinho ativo para o usuário
        $existingCart = $this->cartRepository->findActiveByUser($userId);
        if ($existingCart) {
            return $existingCart;
        }

        return $this->cartRepository->create([
            'usuario_id' => $userId,
            'total' => 0,
            'status' => 'ativo'
        ]);
    }

    /**
     * Busca carrinho por ID
     */
    public function getCartById(int $id): ?Cart
    {
        return $this->cartRepository->findById($id);
    }

    /**
     * Adiciona produto ao carrinho
     */
    public function addProductToCart(int $cartId, int $productId, int $quantity = 1): bool
    {
        // Verifica se o carrinho existe
        $cart = $this->cartRepository->findById($cartId);
        if (!$cart) {
            throw new \Exception('Carrinho não encontrado');
        }

        if ($cart->status !== 'ativo') {
            throw new \Exception('Carrinho não está ativo');
        }

        // Verifica se o produto existe
        $product = $this->productRepository->findById($productId);
        if (!$product) {
            throw new \Exception('Produto não encontrado');
        }

        if ($quantity <= 0) {
            throw new \Exception('Quantidade deve ser maior que zero');
        }

        // Adiciona produto ao carrinho
        $success = $this->cartRepository->addProduct($cartId, $productId, $quantity, $product->preco);

        if ($success) {
            // Atualiza o total do carrinho
            $this->cartRepository->updateTotal($cartId);
        }

        return $success;
    }

    /**
     * Remove produto do carrinho
     */
    public function removeProductFromCart(int $cartId, int $productId): bool
    {
        $cart = $this->cartRepository->findById($cartId);
        if (!$cart) {
            throw new \Exception('Carrinho não encontrado');
        }

        if ($cart->status !== 'ativo') {
            throw new \Exception('Carrinho não está ativo');
        }

        $success = $this->cartRepository->removeProduct($cartId, $productId);

        if ($success) {
            // Atualiza o total do carrinho
            $this->cartRepository->updateTotal($cartId);
        }

        return $success;
    }

    /**
     * Atualiza quantidade do produto no carrinho
     */
    public function updateProductQuantity(int $cartId, int $productId, int $quantity): bool
    {
        $cart = $this->cartRepository->findById($cartId);
        if (!$cart) {
            throw new \Exception('Carrinho não encontrado');
        }

        if ($cart->status !== 'ativo') {
            throw new \Exception('Carrinho não está ativo');
        }

        if ($quantity <= 0) {
            throw new \Exception('Quantidade deve ser maior que zero');
        }

        $success = $this->cartRepository->updateProductQuantity($cartId, $productId, $quantity);

        if ($success) {
            // Atualiza o total do carrinho
            $this->cartRepository->updateTotal($cartId);
        }

        return $success;
    }

    /**
     * Finaliza carrinho
     */
    public function finalizeCart(int $cartId): bool
    {
        $cart = $this->cartRepository->findById($cartId);
        if (!$cart) {
            throw new \Exception('Carrinho não encontrado');
        }

        if ($cart->status !== 'ativo') {
            throw new \Exception('Carrinho não está ativo');
        }

        if ($cart->products->count() === 0) {
            throw new \Exception('Carrinho está vazio');
        }

        // Atualiza o total antes de finalizar
        $this->cartRepository->updateTotal($cartId);

        return $this->cartRepository->finalize($cartId);
    }

    /**
     * Busca carrinho ativo do usuário
     */
    public function getActiveCartByUser(int $userId): ?Cart
    {
        return $this->cartRepository->findActiveByUser($userId);
    }
}
