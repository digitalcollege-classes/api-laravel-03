<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Model;

#[ApiResource(
    rules: [
        'license_plate' => 'required|unique:cars,license_plate',
    ]
)]
class Car extends Model
{
    //
}
