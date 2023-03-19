<?php

namespace App\Repositories;

use App\Models\SubCategory as ModelsSubCategory;

class SubCategoryRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new ModelsSubCategory());
    }
}
