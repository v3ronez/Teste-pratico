<?php

namespace App\Http\Controllers;

use App\Database\Repository\User\UserRepository;
use App\Database\Repository\Vehicle\VehicleRepository;
use App\Services\VehicleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    private $userRepository;
    private $vehicleRepository;
    private $vehicleService;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->vehicleRepository = new VehicleRepository();
        $this->vehicleService = new VehicleService($this->vehicleRepository, $this->userRepository);
    }

    public function index()
    {
        try {
            $vehicles = $this->vehicleService->getPaginateBootstrapWithRelation(['user']);
            return response()->view('vehicle.index', compact('vehicles'));
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return response()->redirectToRoute('admin.home');
        }
    }


    public function create(Request $request, $id)
    {
        try {
            $user = $this->userRepository->findById($id);
            if (!$user) {
                return redirect()->route('admin.home');
            }
            return response()->view('vehicle.create', compact('user'));
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return response()->redirectToRoute('admin.home');
        }
    }

    public function store(Request $request, $id)
    {
        try {
            $fields = $request->only(['plate', 'brand', 'year', 'model', 'renavam']);
            $newVehicle = $this->vehicleService->create($fields, $id);
            if (!$newVehicle) {
                return redirect()->route('admin.home');
            }
            return view('user.show', ['user' => $newVehicle['user']]);
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return response()->redirectToRoute('home');
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $vehicle = $this->vehicleService->withRelations($id, ['user']);
            if (!$vehicle) {
                return redirect()->route('admin.homehome');
            }
            return view('vehicle.edit', compact('vehicle'));
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return response()->redirectToRoute('admin.home');
        }
    }

    public function update(Request $request, $vehicleID)
    {
        try {
            $fields = $request->only(['plate', 'brand', 'year', 'model', 'renavam']);
            $vehicleUpdated = $this->vehicleService->update($fields, $vehicleID);
            if (!$vehicleUpdated) {
                return redirect()->route('admin.home');
            }
            return redirect()->route('user.show', ['id' => $vehicleUpdated['user']['id']]);
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return response()->redirectToRoute('admin.home');
        }
    }


    public function destroy($id)
    {
        try {
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return response()->redirectToRoute('admin.home');
        }
    }
}
