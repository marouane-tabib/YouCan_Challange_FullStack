<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;

class ProductRepository extends Repository
{
    protected $category;

    public function __construct()
    {
        parent::__construct(new Product());
        $this->category = new CategoryRepository();
    }

    public function index(){
        return view('product.productIndex' , ['products' => $this->all() , 'categories' => $this->category->all()]);
    }

}
