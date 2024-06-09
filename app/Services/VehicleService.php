<?php

namespace App\Services;

use App\Database\Repository\User\UserRepository;
use App\Database\Repository\Vehicle\VehicleRepository;
use App\Events\SendEmailEvent;
use App\Vehicle;

class VehicleService
{
    private $vehicleRepository;
    private $userRepository;

    public function __construct($vehicleRepository, $userRepository)
    {
        /** @var VehicleRepository $vehicleRepository */
        $this->vehicleRepository = new $vehicleRepository();

        /** @var UserRepository $vehicleRepository */
        $this->userRepository = new $userRepository();
    }

    public function getPaginateBootstrapWithRelation(array $relations)
    {
        return $this->vehicleRepository->getPaginateBootstrapWithRelation($relations);
    }

    public function create($fields, $userID)
    {
        $user = $this->userRepository->findById($userID);
        if (!$user) {
            return $user;
        }
        $newVehicle = $this->vehicleRepository->createVehicle($fields, $user->id);
        if (!$newVehicle) {
            return $newVehicle;
        }
        return [
            'user'    => $user,
            'vehicle' => $newVehicle
        ];
    }

    public function withRelations($id, array $relations)
    {
        return $this->vehicleRepository->withRelations($id, $relations);
    }

    public function update($fields, $vehicleID)
    {
        /** @var Vehicle | null $vehicle */
        $vehicle = $this->vehicleRepository->withRelations($vehicleID, ['user']);
        $isValidPlate = $vehicle->isValidaPlate($fields['plate']);
        if (!$isValidPlate) {
            return false;
        }
        $isValidYear = $vehicle->isValidYear($fields['year']);
        if (!$isValidYear) {
            return false;
        }
        $vehicleUpdated = $this->vehicleRepository->updateById($vehicleID, $fields);
        if (!$vehicleUpdated) {
            return false;
        }
        event(new SendEmailEvent($vehicle->user));
        return [
            'user'    => $vehicleUpdated->user,
            'vehicle' => $vehicleUpdated
        ];
    }

    public function delete($vehicleID)
    {
        return $this->vehicleRepository->delete($vehicleID);
    }
}
