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
        $this->userRepository = new UserRepository(new User());
        $this->userService = new UserService($this->userRepository);
    }

    public function index()
    {
        try {
            $users = $this->userRepository->getPaginateBootstrap();
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
            $created = $this->userRepository->create($fieldsValid);
            if (!$created) {
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
            $user = $this->userRepository->withRelations($id, ['vehicles']);
            if (!$user) {
                return response('', 404);
            }
            return response()->view('user.show', compact('user'));
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response('unexpected error', 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $fields = $request->only(['name', 'document', 'email', 'password']);
            $user = $this->userRepository->updateById($id, $fields);
            if (!$user) {
                return response('Error to update user', 400);
            }
            return response('', 200);
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response('unexpected error', 500);
        }
    }


    public function destroy($id)
    {
        try {
            $deleted = $this->userRepository->delete($id);
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
