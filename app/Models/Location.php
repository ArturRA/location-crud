<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    // add name, slug, city and state to fillable
    protected $fillable = ['name', 'slug', 'city', 'state'];
}
