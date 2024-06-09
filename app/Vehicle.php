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

    public function isValidYear(string $year): bool
    {
        $pattern = '/^(19[6-9]\d|20[0-9]\d)$/';
        return preg_match($pattern, $year);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
