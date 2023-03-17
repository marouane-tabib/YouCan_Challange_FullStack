<?php

namespace App\Repositories;

use App\Http\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function all(array $select = []){
        return Category::all($select);
    }

}
