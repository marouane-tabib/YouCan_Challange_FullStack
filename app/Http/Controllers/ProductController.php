<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Traits\ImageUploaderTrait;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    use ImageUploaderTrait;

    protected $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository;
    }

    public function index(ProductRequest $request)
    {
        return $this->repository->index($request->all());
    }

    public function create(ProductRequest $request)
    {
        $request = $request->validated();
        $request['image'] = $this->uploadImage($request['image']);
        return $this->repository->create($request);
    }
}
