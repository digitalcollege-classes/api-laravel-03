<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * Retorna todos os produtos
     */
    public function getAll(): Collection
    {
        return $this->model->with('category')->get();
    }

    /**
     * Busca produto por ID
     */
    public function findById(int $id): ?Product
    {
        return $this->model->with('category')->find($id);
    }

    /**
     * Cria novo produto
     */
    public function create(array $data): Product
    {
        return $this->model->create($data);
    }

    /**
     * Atualiza produto
     */
    public function update(int $id, array $data): bool
    {
        $product = $this->model->find($id);
        if (!$product) {
            return false;
        }
        return $product->update($data);
    }

    /**
     * Remove produto
     */
    public function delete(int $id): bool
    {
        $product = $this->model->find($id);
        if (!$product) {
            return false;
        }
        return $product->delete();
    }

    /**
     * Busca produtos por categoria
     */
    public function getByCategory(int $categoryId): Collection
    {
        return $this->model->where('categoria_id', $categoryId)->with('category')->get();
    }

    /**
     * Busca produtos por preço
     */
    public function getByPriceRange(float $minPrice, float $maxPrice): Collection
    {
        return $this->model->whereBetween('preco', [$minPrice, $maxPrice])
                          ->with('category')
                          ->get();
    }
}
