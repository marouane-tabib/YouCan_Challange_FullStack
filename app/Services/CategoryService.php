<?php

namespace App\Services;

use App\Http\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all(array $select = ['*'])
    {
        return $this->categoryRepository->all($select);
    }
}
