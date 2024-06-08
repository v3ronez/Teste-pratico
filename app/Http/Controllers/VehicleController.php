<?php

namespace App\Http\Controllers;

use App\Database\Repository\User\UserRepository;
use App\Database\Repository\Vehicle\VehicleRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    private $userRepository;
    private $vehicleRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->vehicleRepository = new VehicleRepository();
    }

    public function index()
    {
        try {
            $vehicles = $this->vehicleRepository->getPaginateBootstrapWithRelation(['user']);
            return response()->view('vehicle.index', compact('vehicles'));
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return;
        }
    }


    public function create(Request $request, $id)
    {
        try {
            $user = $this->userRepository->findById($id);
            if (!$user) {
                return redirect()->route('home');
            }
            return response()->view('vehicle.create', compact('user'));
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return response('', 500);
        }
    }


    public function store(Request $request, $id)
    {
        try {
            $user = $this->userRepository->findById($id);
            if (!$user) {
                return redirect()->route('home');
            }
            $fields = $request->only(['plate', 'brand', 'year', 'model', 'renavam']);
            $created = $this->vehicleRepository->createVehicle($fields, $user->id);
            if (!$created) {
                return redirect()->back()->with('errors', ['plate' => 'Modelo de placa inválido']);
            }
            return view('user.show', ['vehicle_create' => 'true']);
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return false;
        }
    }

    public function show($id)
    {
        try {
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return false;
        }
    }


    public function edit(Request $request, $id)
    {
        try {
            $vehicle = $this->vehicleRepository->withRelations($id, ['user']);
            if (!$vehicle) {
                return redirect()->route('home');
            }
            return view('vehicle.edit', compact('vehicle'));
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return false;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $fields = $request->only(['plate', 'brand', 'year', 'model', 'renavam']);
            $vehicle = $this->vehicleRepository->withRelations($id, ['user']);
            if (!$vehicle) {
                return redirect()->route('home');
            }
            $plateValid = $vehicle->isValidaPlate($fields['plate']);
            if (!$plateValid) {
                return back();
            }
            $updated = $this->vehicleRepository->updateById($id, $fields);
            if (!$updated) {
                return back();
            }
            return redirect()->route('admin.user.show', ['id' => $vehicle->user->id]);
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return false;
        }
    }


    public function destroy($id)
    {
        try {
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return false;
        }
    }
}
