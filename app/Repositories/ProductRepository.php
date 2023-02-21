<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends Repository
{

    public function __construct()
    {
        parent::__construct(new Product());
    }

    public function index(){
        return view('Product.productIndex' , ['products' => $this->all()]);
    }

}
