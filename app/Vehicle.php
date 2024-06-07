<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vehicle extends Authenticatable
{
    use SoftDeletes;

    protected $table = "vehicles";
    protected $fillable
        = [
            "plate",
            "renavam",
            "model",
            "brand",
            "year",
            "user_id",
        ];

    public function isValidaPlate(string $plate): bool
    {
        $pattern = '/^[A-Za-z]{3}[0-9]{4}$/';
        return preg_match($pattern, $plate);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
