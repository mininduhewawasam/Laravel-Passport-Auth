<?php

namespace App\Modules\Auth\Repositories\Interfaces;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function create(array $data): User;
}