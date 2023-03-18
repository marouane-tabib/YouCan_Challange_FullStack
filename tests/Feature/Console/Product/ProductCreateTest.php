<?php

namespace Tests\Feature\Console\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductCreateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_product_create(): void
    {
        $this->artisan('product:create')
        ->expectsQuestion('Add Your Product name', 'Testing Red T-shirt')
        ->expectsQuestion('Add Your Product description', 'She held up the bowl to the window light and smiled her fakest smile yet')
        ->expectsQuestion('Add Your Product price', 200)
        ->expectsOutput('Show All Categories.')
        ->expectsQuestion('Add Your Product category_id', 2)
        ->expectsOutput('Product created successfully!')
        ->assertExitCode(0);
    }
}
