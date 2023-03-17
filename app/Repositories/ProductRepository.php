<?php

namespace App\Repositories;

use App\Http\Interfaces\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Client\Request;

class ProductRepository implements ProductRepositoryInterface
{

    public function all(){
        return Product::all();
    }

    public function create(array $data){
        Product::create($data);
        return redirect()->back();
    }

    public function filter(array $filter)
    {
        return Product::when($filter['category_filter'] != '' , function($query) use ($filter){
                        $query->where('category_id', $filter['category_filter']);
                    })
                    ->orderBy($filter['sort_by'] ?? 'id' , $filter['order_by'] ?? 'desc')
                    ->get();
    }

}
