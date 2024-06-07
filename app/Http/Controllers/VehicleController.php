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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return false;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return false;
        }
    }
}
