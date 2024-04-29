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
}
