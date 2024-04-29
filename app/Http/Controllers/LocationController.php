<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationStoreRequest;
use App\Services\LocationService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class LocationController extends BaseController
{
  use AuthorizesRequests, ValidatesRequests;

  private LocationService $locationService;

  public function __construct(LocationService $locationService)
  {
    $this->locationService = $locationService;
  }

  // store a newly created resource in storage.
  public function store(LocationStoreRequest $request)
  {
    $response = $this->locationService->store($request->all());

    return response()->json($response, 201);
  }
}
