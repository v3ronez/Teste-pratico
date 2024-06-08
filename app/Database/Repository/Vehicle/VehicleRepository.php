<?php

namespace App\Database\Repository\Vehicle;

use App\Database\Repository\BaseRepository;
use App\Vehicle;
use Illuminate\Support\Facades\Log;

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

    public function getPaginateBootstrapWithRelation()
    {
        try {
            return $this->model->with(['user'])->paginate();
        } catch (\Exception $e) {
            Log::error("Error to delete on DB", [$e->getMessage()]);
            return false;
        }
    }
}
