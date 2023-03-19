<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $product = $request->filter ? $this->productService->filter($request) : $this->productService->all();
        $categories = $this->categoryService->all();
        return view('product.index', ['products' => $product, 'categories' => $categories]);
    }

    public function create(Request $request)
    {
        return $this->productService->create($request);
    }
}
