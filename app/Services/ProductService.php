<?php

namespace App\Services;

use App\Http\Interfaces\CategoryRepositoryInterface;
use App\Http\Interfaces\ProductRepositoryInterface;
use App\Http\Requests\ProductRequest;
use App\Traits\ImageUploaderTrait;

class ProductService
{

    use ImageUploaderTrait;

    protected ProductRepositoryInterface $productRepository;
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(ProductRequest $request)
    {
        $product = $request->filter ? $this->productRepository->filter($request->toArray()) : $this->productRepository->all();
        $categories = $this->categoryRepository->all(['id', 'name']);
        return view('product.index', ['products' => $product, 'categories' => $categories]);
    }

    public function create(ProductRequest $request)
    {
        $request = $request->validated();
        $request['image'] = $this->uploadImage($request['image']);
        return $this->productRepository->create($request);
    }
}
