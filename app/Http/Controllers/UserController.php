<?php

namespace App\Http\Controllers;

use App\Database\Repository\User\UserRepository;
use App\Services\UserService;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $userRepository;
    private $userService;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->userService = new UserService($this->userRepository);
    }

    public function index()
    {
        try {
            $users = $this->userService->getPaginateBootstrap();
            return response()->view('user.index', compact('users'));
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response('unexpected error', 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $fieldsValid = $request->validate([
                'name'     => ['required'],
                'email'    => ['email'],
                'document' => ['required'],
                'password' => ['required'],
            ]);
            $fieldsValid['password'] = bcrypt($request->password);
            $newUser = $this->userService->createUser($fieldsValid);
            if (!$newUser) {
                return redirect()->back();
            }
            return redirect('/');
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response('unexpected error', 500);
        }
    }


    public function show(Request $request, $id)
    {
        try {
            $user = $this->userService->withRelations($id, ['vehicles']);
            if (!$user) {
                return response()->redirectToRoute('admin.home');
            }
            return response()->view('user.show', compact('user'));
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response('unexpected error', 500);
        }
    }

    public function edit(Request $request, $id)
    {
        $user = $this->userService->findById($id);
        if (!$user) {
            return redirect()->route('home');
        }
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $fields = $request->only(['name', 'cpf', 'phone', 'email']);
            /** @var User $user */
            $userUpdated = $this->userService->updateUser($id, $fields);
            if (!$userUpdated) {
                return response('', 404);
            }
            return redirect()->route('user.show', ['id' => $id]);
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response('unexpected error', 500);
        }
    }


    public function destroy($id)
    {
        try {
            $deleted = $this->userService->delete($id);
            if (!$deleted) {
                return response('Error to delete', 400);
            }
            return redirect()->route('admin.user.index');
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response('unexpected error', 500);
        }
    }
}
