<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Repositories\Interfaces\AuthRepositoryInterface as AuthRepository;

class AuthService
{
    public function __construct(protected AuthRepository $authRepository)
    {
        
    }

}