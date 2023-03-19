<?php

namespace App\Http\Interfaces;

interface CategoryRepositoryInterface
{
    public function all(array $select);
}
