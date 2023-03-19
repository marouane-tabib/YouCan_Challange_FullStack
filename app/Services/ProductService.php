<?php

namespace App\Services;

use App\Http\Interfaces\ProductRepositoryInterface;
use App\Http\Requests\ProductRequest;
use App\Traits\ImageUploaderTrait;

class ProductService
{

    use ImageUploaderTrait;

    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function filter(ProductRequest $request)
    {
        return $this->productRepository->filter($request->toArray());
    }

    public function create(ProductRequest $request)
    {
        $request = $request->validated();
        $request['image'] = $this->uploadImage($request['image']);
        return $this->productRepository->create($request);
    }
}
