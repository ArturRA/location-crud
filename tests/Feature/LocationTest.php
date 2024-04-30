<?php

namespace Tests\Feature;

use App\Models\Location;
use Tests\TestCase;

class LocationTest extends TestCase
{
  public function test_post_location_returns_a_successful_response(): void
  {
    $array = [
      'name' => "Shopping Mall",
      'slug' => "shopping-mall",
      'city' => "Lages",
      'state' => "Santa Catarina",
    ];

    $response = $this->post('/api/locations', $array);

    $response->assertStatus(201);
    $response->assertJson($array);
  }

  public function test_post_location_returns_a_failed_response(): void
  {
    $array = [
      'name' => "Shopping Mall",
      'slug' => "shopping-mall",
      'state' => "Santa Catarina",
    ];

    $response = $this->post('/api/locations', $array);

    $response->assertStatus(400);
    $response->assertJson(['city' => ["The city field is required."]]);
  }

  public function test_put_location_returns_a_successful_response(): void
  {
    $arrayPost = [
      'name' => "Shopping Mall",
      'slug' => "shopping-mall",
      'city' => "Lages",
      'state' => "Santa Catarina",
    ];

    $location = new Location();
    $location->fill($arrayPost);
    $location->save();

    $arrayPut = [
      'name' => "Shopping Mall Update",
      'slug' => "shopping-mall-update",
      'city' => "Lages Update",
      'state' => "Santa Catarina Update",
    ];

    $responsePut = $this->put('/api/locations/' . $location->id, $arrayPut);

    $responsePut->assertStatus(200);
    $responsePut->assertJson($arrayPut);
  }

  public function test_put_location_with_invalid_data_returns_a_failed_response(): void
  {
    $arrayPost = [
      'name' => "Shopping Mall",
      'slug' => "shopping-mall",
      'city' => "Lages",
      'state' => "Santa Catarina",
    ];

    $location = new Location();
    $location->fill($arrayPost);
    $location->save();

    $arrayPut = [
      'name' => "Shopping Mall Update",
      'slug' => "shopping-mall-update",
      'city' => "",
      'state' => "Santa Catarina Update",
    ];

    $responsePut = $this->put('/api/locations/' . $location->id, $arrayPut);

    $responsePut->assertStatus(400);
    $responsePut->assertJson(['city' => ["The city field is required."]]);
  }

  public function test_put_location_with_invalid_id_returns_a_failed_response(): void
  {
    $arrayPut = [
      'name' => "Shopping Mall Update",
      'slug' => "shopping-mall-update",
      'city' => "Lages Update",
      'state' => "Santa Catarina Update",
    ];

    $responsePut = $this->put('/api/locations/0', $arrayPut);

    $responsePut->assertStatus(404);
    $responsePut->assertJson(['error' => "invalid id"]);
  }

  public function test_get_location_returns_a_successful_response(): void
  {
    $array = [
      'name' => "Shopping Mall",
      'slug' => "shopping-mall",
      'city' => "Lages",
      'state' => "Santa Catarina",
    ];

    $location = new Location();
    $location->fill($array);
    $location->save();

    $response = $this->get('/api/locations/' . $location->id);

    $response->assertStatus(200);
    $response->assertJson($array);
  }

  public function test_get_location_with_invalid_id_returns_a_failed_response(): void
  {
    $responsePut = $this->get('/api/locations/0');

    $responsePut->assertStatus(404);
    $responsePut->assertJson(['error' => "invalid id"]);
  }
}
