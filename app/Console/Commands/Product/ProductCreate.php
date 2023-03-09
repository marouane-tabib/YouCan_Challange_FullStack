<?php

namespace App\Console\Commands\Product;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Console\Command;
use App\Traits\CliValidator;

class ProductCreate extends Command
{
    use CliValidator;

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
     */
    public function handle(): void
    {
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->all(['id', 'name']);

        if($this->option('ask') === "true"){
            // Product name, description, price
            $data['name'] = $this->argument('name') ?: $this->ask('Product Name?');
            $data['description'] =  $this->argument('description') ?: $this->ask('Product Description?');
            $data['price'] =  $this->argument('price') ?: $this->ask('Product Price?');

            // Product category
            $this->argument('category_id') ?? $this->info('Show All Categories.');
            $this->argument('category_id') ?? $this->table(['id', 'name'] , $categories);
            $data['category_id'] =  $this->argument('category_id') ?: $this->ask('Choise Product Category With Id?');

            // Validation
            $this->validatore($data);

            // Careate Product
            $productRepository = new ProductRepository();
            $productRepository->create($data);

            // Message
            $this->info('Product Created Successfully.');
        }else{
            // Product Arguments
            $data['name'] = $this->argument('name');
            $data['description'] =  $this->argument('description');
            $data['price'] =  $this->argument('price');
            $data['category_id'] =  $this->argument('category_id');

            // Validation
            $this->validatore($data);

            // Careate Product
            $productRepository = new ProductRepository();
            $productRepository->create($data);

            // Message
            $this->info('Product Created Successfully.');
        }
    }

    public function validatore($data){
        $this->validateInput('name', 'required|string|min:3|max:55', $data['name']);
        $this->validateInput('description', 'required|string|min:10|max:5000', $data['description']);
        $this->validateInput('price', 'required|numeric|min:1', $data['price']);
        $this->validateInput('category_id', 'required|numeric|exists:categories,id', $data['category_id']);
    }
}
