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

    public function all()
    {
        return $this->productRepository->all();
    }

    public function filter(array $data)
    {
        return $this->productRepository->filter($data);
    }

    public function create(array $data)
    {
        if(isset($data['image'])){ $data['image'] = $this->uploadImage($data['image']); }
        $this->productRepository->create($data);
        return redirect()->back();
    }
}
