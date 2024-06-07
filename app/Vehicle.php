<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vehicle extends Authenticatable
{
    use SoftDeletes;

    protected $primaryKey = "id";
    protected $casts = [
        "id" => "string",
    ];
    public $incrementing = false;
    protected $table = "vehicles";
    protected $fillable = [
        "plate",
        "renavam",
        "model",
        "brand",
        "year",
        "owner_id",
    ];

    public function isValidaPlate(string $plate): bool
    {
        return false;
    }

    public function isValidaYear(string $plate): bool
    {
        return false;
    }
}
