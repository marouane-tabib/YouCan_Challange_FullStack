<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends Repository
{

    public function __construct()
    {
        parent::__construct(new Category());
    }

}
