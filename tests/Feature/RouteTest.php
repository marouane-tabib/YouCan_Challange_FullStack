<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    public function test_home_screen_shows_welcome()
    {
        $response = $this->get('/');
        $response->assertViewIs('product.index');
        $response->assertOk();
    }

    public function test_create_new_product(){
        $response = $this->post('/',  [
            'name' => "Testing fake name",
            'description' => "Testing fake description...",
            'price' => 443,
            'category_id' => 4
        ]);
        $response->assertRedirect('/');
    }
}
