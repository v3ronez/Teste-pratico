<?php

namespace App\Database\Repository\Vehicle;

use App\Database\Repository\BaseRepository;
use App\Vehicle;

class VehicleRepository extends BaseRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Vehicle();
        parent::__construct($this->model);
    }

    public function createVehicle($fields, $id)
    {
        $isValidPlate = $this->model->isValidaPlate($fields['plate']);
        if (!$isValidPlate) {
            return false;
        }
        $fields['user_id'] = $id;
        return $this->create($fields);
    }
}
