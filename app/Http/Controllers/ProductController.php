<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ProductRepositoryInterface;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Traits\ImageUploaderTrait;

class ProductController extends Controller
{
    use ImageUploaderTrait;

    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(ProductRequest $request)
    {
         $product = $request->filter ? $this->productRepository->filter($request->toArray()) : $this->productRepository->all();
        $categories = Category::all();
        return view('product.index', ['products' => $product, 'categories' => $categories]);
    }

    public function create(ProductRequest $request)
    {
        // $request = $request->validated();
        // $request['image'] = $this->uploadImage($request['image']);
        // return $this->repository->create($request);
    }
}
