<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CategoryRepositoryInterface;
use App\Http\Interfaces\ProductRepositoryInterface;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Traits\ImageUploaderTrait;

class ProductController extends Controller
{
    // use ImageUploaderTrait;

    // protected ProductRepositoryInterface $productRepository;
    // protected CategoryRepositoryInterface $categoryRepository;
    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    // public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    // {
    //     $this->productRepository = $productRepository;
    //     $this->categoryRepository = $categoryRepository;
    // }

    public function index(ProductRequest $request)
    {
        // $product = $request->filter ? $this->productRepository->filter($request->toArray()) : $this->productRepository->all();
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
