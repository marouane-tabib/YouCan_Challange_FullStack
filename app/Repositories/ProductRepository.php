<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Client\Request;

class ProductRepository extends Repository
{
    protected $category;

    public function __construct()
    {
        parent::__construct(new Product());
        $this->category = new CategoryRepository();
    }

    public function index(array $filter = null)
    {
        $product = $filter ? $this->filter($filter) : $this->all();
        return view('product.productIndex' , ['products' => $product, 'categories' => $this->category->all()]);
    }

}
