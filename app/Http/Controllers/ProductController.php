<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $repositoty;

    public function __construct()
    {
        $this->repositoty = new ProductRepository;
    }

    public function index(){
        return $this->repositoty->index();
    }

    public function create($id){
        // 
    }
}
