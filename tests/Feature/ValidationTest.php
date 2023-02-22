<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    public function test_simple_validation_rules()
    {
        // Add Product without any data should fail because title is required
        $response = $this->post('/');
        $response->assertSessionHasErrors('name')->assertStatus(302);
        $response->assertSessionHasErrors('description')->assertStatus(302);
        $response->assertSessionHasErrors('price')->assertStatus(302);
        $response->assertSessionHasErrors('category_id')->assertStatus(302);
    }

    public function test_validation_errors_shown_in_blade()
    {
        $response = $this->followingRedirects()->post('/');
        $response->assertStatus(200);
        $response->assertSee('The name field is required.');
        $response->assertSee('The description field is required.');
        $response->assertSee('The price field is required.');
        $response->assertSee('The category id field is required.');
    }
}
