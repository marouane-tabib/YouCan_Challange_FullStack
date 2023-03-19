<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    public function test_simple_validation_rules()
    {
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

    public function test_old_value_stays_in_form_after_validation_error()
    {
        $response = $this->followingRedirects()->post('/',  [
            'description' => "Testing fake description...",
            'price' => 443,
            'category_id' => 4
        ]);
        $response->assertStatus(200);
        $response->assertSee('The name field is required.');
        $response->assertSee('Testing fake description...');
        $response->assertSee(443);
    }

    public function test_form_request_validation()
    {
        $response = $this->post('/');
        $response->assertStatus(302);

        $response = $this->post('/',  [
            'image' => "default-img.jpg",
            'name' => "Testing fake name",
            'description' => "Testing fake description...",
            'price' => 443,
            'category_id' => 4
        ]);
        $response->assertRedirect('/');
    }
}
