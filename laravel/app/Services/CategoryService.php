<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Lista todas as categorias
     */
    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Busca categoria por ID
     */
    public function getCategoryById(int $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }

    /**
     * Cria nova categoria
     */
    public function createCategory(array $data): Category
    {
        $validatedData = $this->validateCategoryData($data);
        return $this->categoryRepository->create($validatedData);
    }

    /**
     * Atualiza categoria
     */
    public function updateCategory(int $id, array $data): bool
    {
        $validatedData = $this->validateCategoryData($data, $id);
        return $this->categoryRepository->update($id, $validatedData);
    }

    /**
     * Remove categoria
     */
    public function deleteCategory(int $id): bool
    {
        // Verifica se a categoria existe
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            throw new \Exception('Categoria não encontrada');
        }

        // Verifica se a categoria possui produtos
        $categoryWithProducts = $this->categoryRepository->findWithProducts($id);
        if ($categoryWithProducts && $categoryWithProducts->products->count() > 0) {
            throw new \Exception('Não é possível excluir categoria que possui produtos');
        }

        return $this->categoryRepository->delete($id);
    }

    /**
     * Valida dados da categoria
     */
    private function validateCategoryData(array $data, ?int $id = null): array
    {
        $rules = [
            'nome' => 'required|string|max:100',
            'descricao' => 'nullable|string|max:1000'
        ];

        // Aqui você pode adicionar validação personalizada
        // Por exemplo, verificar se o nome já existe

        return $data; // Retorna dados validados
    }
}
