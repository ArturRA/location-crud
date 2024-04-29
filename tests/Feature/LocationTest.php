<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationTest extends TestCase
{
    public function test_create_location_returns_a_successful_response(): void
    {
        $array = [
          'name' => "Churrascaria",
          'slug' => "churrascaria",
          'city' => "Lages",
          'state' => "Santa Catarina",
        ];

        $response = $this->post('/api/locations', $array);

        $response->assertStatus(201);
        $response->assertJson($array);
    }

    public function test_create_location_returns_a_failed_response(): void
    {
        $array = [
          'name' => "Churrascaria",
          'slug' => "churrascaria",
          'state' => "Santa Catarina",
        ];

        $response = $this->post('/api/locations', $array);

        $response->assertStatus(400);
        $response->assertJson(['city' => ["The city field is required."]]);
    }
}
