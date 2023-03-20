<?php

namespace App\Repositories;

use App\Http\Interfaces\SubCategoryRepositoryInterface;
use App\Models\SubCategory;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    protected SubCategory $subCategory;

    public function __construct(SubCategory $subCategory)
    {
        $this->subCategory = $subCategory;
    }

    public function all(array $select = []){
        return $this->subCategory::all($select);
    }
}
