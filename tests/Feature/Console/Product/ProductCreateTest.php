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
    public function test_example(): void
    {
        $this->artisan('product:create')
        ->expectsQuestion('Product Name?', 'Testing Red T-shirt')
        ->expectsQuestion('Product Description?', 'She held up the bowl to the window light and smiled her fakest smile yet')
        ->expectsQuestion('Product Price?', 200)
        ->expectsOutput('Product Created Successfully.')
        ->assertExitCode(0);
    }
}
