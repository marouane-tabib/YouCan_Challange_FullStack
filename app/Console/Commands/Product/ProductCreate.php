<?php

namespace App\Console\Commands\Product;

use App\Repositories\ProductRepository;
use Illuminate\Console\Command;

class ProductCreate extends Command
{
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

        $repository = new ProductRepository();
        $repository->create($data);

        $this->info('Product Created Successfully.');
    }
}
