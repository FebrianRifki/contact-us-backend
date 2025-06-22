<?php

namespace App\Http\Controllers;

use App\Repositories\AuthRepositoryInterface;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request)
    { 
        try {
            $data = $this->authRepository->login($request->only(['email', 'password']));

            if ($data['success']) {
                return response()->json(['success' => true, 'message' => 'Login successful', 'status_code' => 200, 'data' => $data['data']], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Login failed', 'status_code' => 401, 'data' => $data['data']], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Internal server error', 'status_code' => 500, 'data' => []], 500);
        }
    }

    public function logout()
    {
        $this->authRepository->logout();
        return response()->json(['success' => true, 'message' => 'Logout successful', 'status_code' => 200, 'data' => []], 200);
    }
}
