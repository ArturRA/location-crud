<?php

namespace App\Services;

use App\Models\Location;

class LocationService
{
  // store a newly created resource in storage.
  public function store(array $validatedData)
  {
    $location = new Location();
    $location->fill($validatedData);
    $location->save();

    return $location;
  }

  // update resource in storage
  public function update(int $id, array $validatedData)
  {
    $location = Location::findOrFail($id);
    $location->fill($validatedData);
    $location->save();

    return $location;
  }

  // get a resource in storage by it's id.
  public function show(int $id)
  {
    return Location::findOrFail($id);
  }

  // get all resource in storage or filter by it's name if the name is given.
  public function index(array $validatedData)
  {
    $query = Location::query();

    if (isset($validatedData['name'])) {
      $query->where('name', 'like', "%" . $validatedData['name'] . "%");
    }

    return $query->get();
  }
}
