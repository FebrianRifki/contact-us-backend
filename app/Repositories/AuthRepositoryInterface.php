<?php

namespace App\Repositories;

interface AuthRepositoryInterface
{
    public function login(array $credentials): array;
    public function logout(): array;
}
