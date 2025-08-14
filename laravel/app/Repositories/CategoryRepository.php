<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * Retorna todas as categorias
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Busca categoria por ID
     */
    public function findById(int $id): ?Category
    {
        return $this->model->find($id);
    }

    /**
     * Cria nova categoria
     */
    public function create(array $data): Category
    {
        return $this->model->create($data);
    }

    /**
     * Atualiza categoria
     */
    public function update(int $id, array $data): bool
    {
        $category = $this->findById($id);
        if (!$category) {
            return false;
        }
        return $category->update($data);
    }

    /**
     * Remove categoria
     */
    public function delete(int $id): bool
    {
        $category = $this->findById($id);
        if (!$category) {
            return false;
        }
        return $category->delete();
    }

    /**
     * Busca categoria com produtos
     */
    public function findWithProducts(int $id): ?Category
    {
        return $this->model->with('products')->find($id);
    }
}
