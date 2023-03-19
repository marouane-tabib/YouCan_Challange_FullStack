<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\CategoryService;
use App\Services\ProductService;

class ProductController extends Controller
{

    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index(ProductRequest $request)
    {
        $product = $this->productService->all($request);
        $categories = $this->categoryService->all(['id', 'name']);
        return view('product.index', ['products' => $product, 'categories' => $categories]);
    }

    public function create(ProductRequest $request)
    {
        $request = $request->validated();
        $request['image'] = $this->uploadImage($request['image']);
        return $this->productService->create($request);
    }
}
