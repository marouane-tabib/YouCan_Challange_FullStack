<?php

namespace App\Repositories;

use App\Http\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    
    public function all(){
        return $this->product::all();
    }

    public function create(array $data){
        return $this->product::create($data);
    }

    public function filter(array $filter)
    {
        return $this->product::when($filter['category_filter'] != '' , function($query) use ($filter){
                        $query->where('category_id', $filter['category_filter']);
                    })
                    ->orderBy($filter['sort_by'] ?? 'id' , $filter['order_by'] ?? 'desc')
                    ->get();
    }
}
