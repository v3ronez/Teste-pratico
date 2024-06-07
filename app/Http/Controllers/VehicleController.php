<?php

namespace App\Http\Controllers;

use App\Database\Repository\User\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index()
    {
        try {
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return false;
        }
    }


    public function create(Request $request, $id)
    {
        try {
            $user = $this->userRepository->findById($id);
            if (!$user) {
                return back();
            }
            return response()->view('vehicle.create', compact('user'));
        } catch (Exception $e) {
            Log::error("Expection error", [$e->getMessage()]);
            return false;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
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
