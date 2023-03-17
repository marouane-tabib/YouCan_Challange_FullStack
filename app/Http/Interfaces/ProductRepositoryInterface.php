<?php

namespace App\Http\Interfaces;

interface ProductRepositoryInterface
{
    public function all();

    public function create(array $data);
    
}
