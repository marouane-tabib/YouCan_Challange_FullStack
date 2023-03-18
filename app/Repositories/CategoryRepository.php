<?php

namespace App\Repositories;

use App\Http\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    protected Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all(array $select = []){
        return $this->category::all($select);
    }

}
