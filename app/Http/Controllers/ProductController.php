<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageUploaderTrait;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImageUploaderTrait;

    protected $repositoty;

    public function __construct()
    {
        $this->repositoty = new ProductRepository;
    }

    public function index()
    {
        return $this->repositoty->index();
    }

    public function create(Request $request)
    {
        $request = $request->all();
        $request['image'] = $this->uploadImage($request['image']);
        return $this->repositoty->create($request);
    }
}
