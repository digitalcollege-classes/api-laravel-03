<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Product;

class ProductService
{
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Lista todos os produtos
     */
    public function getAllProducts(): Collection
    {
        return $this->productRepository->getAll();
    }

    /**
     * Busca produto por ID
     */
    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->findById($id);
    }

    /**
     * Cria novo produto
     */
    public function createProduct(array $data): Product
    {
        $validatedData = $this->validateProductData($data);
        return $this->productRepository->create($validatedData);
    }

    /**
     * Atualiza produto
     */
    public function updateProduct(int $id, array $data): bool
    {
        $validatedData = $this->validateProductData($data, $id);
        return $this->productRepository->update($id, $validatedData);
    }

    /**
     * Remove produto
     */
    public function deleteProduct(int $id): bool
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            throw new \Exception('Produto não encontrado');
        }

        return $this->productRepository->delete($id);
    }

    /**
     * Busca produtos por categoria
     */
    public function getProductsByCategory(int $categoryId): Collection
    {
        // Verifica se a categoria existe
        $category = $this->categoryRepository->findById($categoryId);
        if (!$category) {
            throw new \Exception('Categoria não encontrada');
        }

        return $this->productRepository->getByCategory($categoryId);
    }

    /**
     * Busca produtos por faixa de preço
     */
    public function getProductsByPriceRange(float $minPrice, float $maxPrice): Collection
    {
        if ($minPrice < 0 || $maxPrice < 0 || $minPrice > $maxPrice) {
            throw new \Exception('Faixa de preço inválida');
        }

        return $this->productRepository->getByPriceRange($minPrice, $maxPrice);
    }

    /**
     * Valida dados do produto
     */
    private function validateProductData(array $data, ?int $id = null): array
    {
        // Verifica se a categoria existe
        if (isset($data['categoria_id'])) {
            $category = $this->categoryRepository->findById($data['categoria_id']);
            if (!$category) {
                throw new \Exception('Categoria não encontrada');
            }
        }

        // Validações básicas
        if (empty($data['nome'])) {
            throw new \Exception('Nome do produto é obrigatório');
        }

        if (isset($data['preco']) && $data['preco'] <= 0) {
            throw new \Exception('Preço deve ser maior que zero');
        }

        return $data;
    }
}
