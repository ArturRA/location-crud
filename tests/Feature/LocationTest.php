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

  public function test_list_location_without_filter(): void
  {
    $arrayPost1 = [
      'name' => "Shopping Mall",
      'slug' => "shopping-mall",
      'city' => "Lages",
      'state' => "Santa Catarina",
    ];

    $location1 = new Location();
    $location1->fill($arrayPost1);
    $location1->save();

    $arrayPost2 = [
      'name' => "Shopping Mall 2",
      'slug' => "shopping-mall-2",
      'city' => "Curitiba",
      'state' => "Parana",
    ];

    $location2 = new Location();
    $location2->fill($arrayPost2);
    $location2->save();

    $arrayAssert1 = [
      'id' => $location1->id,
      'name' => $arrayPost1['name'],
      'slug' => $arrayPost1['slug'],
      'city' => $arrayPost1['city'],
      'state' => $arrayPost1['state'],
      'created_at' => $location1->created_at,
      'updated_at' => $location1->updated_at,
    ];

    $arrayAssert2 = [
      'id' => $location2->id,
      'name' => $arrayPost2['name'],
      'slug' => $arrayPost2['slug'],
      'city' => $arrayPost2['city'],
      'state' => $arrayPost2['state'],
      'created_at' => $location2->created_at,
      'updated_at' => $location2->updated_at,
    ];

    $response = $this->get('/api/locations/');

    $response->assertStatus(200);

    $response->assertJsonFragment($arrayAssert1);
    $response->assertJsonFragment($arrayAssert2);
  }

  public function test_list_location_with_name_filter(): void
  {
    $arrayPost1 = [
      'name' => "Shopping Mall",
      'slug' => "shopping-mall",
      'city' => "Lages",
      'state' => "Santa Catarina",
    ];

    $location1 = new Location();
    $location1->fill($arrayPost1);
    $location1->save();

    $arrayPost2 = [
      'name' => "Shopping Mall 2",
      'slug' => "shopping-mall-2",
      'city' => "Curitiba",
      'state' => "Parana",
    ];

    $location2 = new Location();
    $location2->fill($arrayPost2);
    $location2->save();

    $arrayPost3 = [
      'name' => "Golf Club",
      'slug' => "golf-club",
      'city' => "Curitiba",
      'state' => "Parana",
    ];

    $location3 = new Location();
    $location3->fill($arrayPost3);
    $location3->save();

    $arrayAssert1 = [
      'id' => $location1->id,
      'name' => $arrayPost1['name'],
      'slug' => $arrayPost1['slug'],
      'city' => $arrayPost1['city'],
      'state' => $arrayPost1['state'],
      'created_at' => $location1->created_at,
      'updated_at' => $location1->updated_at,
    ];

    $arrayAssert2 = [
      'id' => $location2->id,
      'name' => $arrayPost2['name'],
      'slug' => $arrayPost2['slug'],
      'city' => $arrayPost2['city'],
      'state' => $arrayPost2['state'],
      'created_at' => $location2->created_at,
      'updated_at' => $location2->updated_at,
    ];

    $arrayAssert3 = [
      'id' => $location3->id,
      'name' => $arrayPost3['name'],
      'slug' => $arrayPost3['slug'],
      'city' => $arrayPost3['city'],
      'state' => $arrayPost3['state'],
      'created_at' => $location3->created_at,
      'updated_at' => $location3->updated_at,
    ];

    $response = $this->get('/api/locations?name=Mall');

    $response->assertStatus(200);

    $response->assertJsonFragment($arrayAssert1);
    $response->assertJsonFragment($arrayAssert2);
    $response->assertJsonMissingExact($arrayAssert3);
  }
}
