<?php

namespace App\Console\Commands\Product;

use App\Http\Interfaces\CategoryRepositoryInterface;
use App\Http\Interfaces\ProductRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Console\Command;
use App\Traits\CliValidator;

class ProductCreateCommand extends Command
{
    use CliValidator;

    protected ProductRepositoryInterface $productRepository;
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        parent::__construct(
        $this->productRepository = $productRepository,
        $this->categoryRepository = $categoryRepository);
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create
                        {name? : Add product name.          [string|min:3|max:55]}
                        {description? : Add product description.   [string|min:10]}
                        {price? : Add product price.         [numeric|min:1]}
                        {category_id? : Add product category_id.   [numeric]}
                        {--a|ask=true : Do not show any ask message }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new custom Product';

    /**
     * Execute the console command.
     * introuction , features ,requirements, installation, usage, author "(é e=
     *
     */
    public function handle(): void
    {
        $categories = $this->categoryRepository->all(['id', 'name']);
        foreach($this->arguments() as $key => $argument){
            if($key === "category_id"){
                // Product category
                $this->argument('category_id') ?? $this->info('Show All Categories.');
                $this->argument('category_id') ?? $this->table(['id', 'name'] , $categories);
            }
            $data[$key] = $this->argument($key) ?: $this->ask('Add Your Product '.$key);
        }
        // Validation
        $validation = $this->validatore($data);
        // Careate Product
        $validation ?: $this->productRepository->create($data);
        $this->info('Product created successfully!');
    }

    public function validatore($data){
        $this->validateInput('name', 'required|string|min:3|max:55', $data['name']);
        $this->validateInput('description', 'required|string|min:10|max:5000', $data['description']);
        $this->validateInput('price', 'required|numeric|min:1', $data['price']);
        $this->validateInput('category_id', 'required|numeric|exists:categories,id', $data['category_id']);
    }
}
