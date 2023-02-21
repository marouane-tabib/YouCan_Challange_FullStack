<?php

namespace App\Console\Commands\Product;

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
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use this command to create new product';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $data['name'] = $this->ask('Product Name?');
        $data['description'] = $this->ask('Product Description?');
        $data['price'] = $this->ask('Product Price?');
        $data['category_id'] = 3;

        // $validator->validateInput('name', 'min:3', $name);
        $this->validateInput('name', 'required|string|min:3|max:55', $data['name']);
        $this->validateInput('description', 'required|string|min:10', $data['description']);
        $this->validateInput('price', 'required|numeric|min:1', $data['price']);

        $productRepository = new ProductRepository();
        $productRepository->create($data);

        $this->info('Product Created Successfully.');
    }
}
