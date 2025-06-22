<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Repositories\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{

    public function login(array $credentials): array
    {
        try {
            $admin = Admin::where('email', $credentials['email'])->first();
            if (!$admin) {
                return [
                    'success' => false,
                    'message' => 'Admin user not found.',
                    'status_code' => 404,
                    'data' => []
                ];
            }

            if (!Hash::check($credentials['password'], $admin->password)) {
                return [
                    'success' => false,
                    'message' => 'Password is incorrect.',
                    'status_code' => 401,
                    'data' => []
                ];
            }

            $token = $admin->createToken('adminToken')->plainTextToken;

            return [
                'success' => true,
                'message' => 'Login successful.',
                'status_code' => 200,
                'data' => [
                    'token' => $token,
                    'admin' => $admin->only(['id', 'email']),
                ]
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'An error occurred during login.',
                'status_code' => 500,
               'data' => [
                    'error_detail' => $e->getMessage(), // tambahkan ini
                ],

            ];
        }
    }



    public function logout(): array
    {
        $user = auth()->user();
        if ($user) {
                $user->currentAccessToken()->delete();

            return [
                'success' => true,
                'message' => 'Logout successful',
                'status_code' => 200,
                'data' => []
            ];
        }
    }
}
