<?php

namespace App\Services;

use App\Http\Interfaces\SubCategoryRepositoryInterface;

class SubCategoryService
{
    protected SubCategoryRepositoryInterface $subCategoryRepository;

    public function __construct(SubCategoryRepositoryInterface $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function all(array $select = ['*'])
    {
        return $this->subCategoryRepository->all($select);
    }
}
