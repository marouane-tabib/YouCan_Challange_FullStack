<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReouteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_home_screen_shows_welcome()
    {
        $response = $this->get('/');

    $response->assertOk();
    // $response->assertViewIs('users.show');
    //     $response->assertViewHas('Products');
    }
}
