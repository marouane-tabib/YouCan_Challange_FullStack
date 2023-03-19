<?php

namespace App\Services;

use App\Http\Interfaces\ProductRepositoryInterface;
use App\Traits\ImageUploaderTrait;

class ProductService
{

    use ImageUploaderTrait;

    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
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
