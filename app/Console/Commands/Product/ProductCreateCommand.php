<?php

namespace App\Console\Commands\Product;

use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Console\Command;
use App\Traits\CliValidator;

class ProductCreateCommand extends Command
{
    use CliValidator;

    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService
    )
    {
        parent::__construct(
            $this->productService = $productService,
            $this->categoryService = $categoryService
        );
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
        $categories = $this->categoryService->all(['id', 'name']);

        if($this->option('ask') === "true"){
            foreach($this->arguments() as $key => $argument){
                if ($key === "category_id") {
                    $this->argument('category_id') ?? $this->info('Show All Categories.');
                    $this->argument('category_id') ?? $this->table(['id', 'name'] , $categories);
                }
                $data[$key] = $this->argument($key) ?: $this->ask('Add Your Product '.$key);
            }
        }else {
            $data = $this->arguments();
        }

        // Validation
            $validation = $this->validatore($data);
        // Careate Product
            $validation ?: $this->productService->create($data);
        // Create Message
            $this->info('Product created successfully!');
    }

    public function validatore($data){
        $this->validateInput('name', 'required|string|min:3|max:55', $data['name']);
        $this->validateInput('description', 'required|string|min:10|max:5000', $data['description']);
        $this->validateInput('price', 'required|numeric|min:1', $data['price']);
        $this->validateInput('category_id', 'required|numeric|exists:categories,id', $data['category_id']);
    }
}
