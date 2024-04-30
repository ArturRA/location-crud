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
}
