<?php

namespace App\Console\Commands\Product;

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
        $name = $this->ask('Product Name?');
        $description = $this->ask('Product Description?');
        $price = $this->ask('Product Price?');
        $this->info('Product Created Successfully.');
    }
}
