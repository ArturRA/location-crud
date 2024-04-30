<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationIndexRequest;
use App\Http\Requests\LocationRequest;
use App\Services\LocationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
  public function store(LocationRequest $request)
  {
    $response = $this->locationService->store($request->all());

    return response()->json($response, 201);
  }

  // Update a resource in storage
  public function update(LocationRequest $request, int $id)
  {
    try {
      $response = $this->locationService->update($id, $request->validated());
    } catch (ModelNotFoundException $e) {
      return response()->json(["error" => "invalid id"], 404);
    }

    return response()->json($response);
  }

  // get a resource in storage by it's id.
  public function show(int $id)
  {
    try {
      $response = $this->locationService->show($id);
    } catch (ModelNotFoundException $e) {
      return response()->json(["error" => "invalid id"], 404);
    }

    return response()->json($response);
  }

  // get all resource in storage or filter by it's name if the name is given.
  public function index(LocationIndexRequest $request)
  {
    $response = $this->locationService->index($request->all());

    return response()->json($response);
  }
}
