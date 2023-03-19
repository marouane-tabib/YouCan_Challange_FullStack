<?php

namespace App\Services;

use App\Http\Interfaces\CategoryRepositoryInterface;
use App\Http\Interfaces\ProductRepositoryInterface;
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

    public function all(object $data)
    {
        $product = $data->filter ? $this->productRepository->filter($data->toArray()) : $this->productRepository->all();
        return $product;
    }

    public function create(object $data)
    {
        $request = $data->validated();
        $request['image'] = $this->uploadImage($request['image']);
        return $this->productRepository->create($request);
    }
}
