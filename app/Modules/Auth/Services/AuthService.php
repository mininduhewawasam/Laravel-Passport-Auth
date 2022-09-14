<?php

namespace App\Modules\Auth\Services;

use App\Http\Resources\AuthUserResource;
use App\Modules\Auth\Repositories\Interfaces\AuthRepositoryInterface as AuthRepository;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(protected AuthRepository $authRepository)
    {
    }

    public function register(array $data)
    {
        try {
            event(new Registered($user = $this->authRepository->create($data)));

            $this->guard()->login($user);

            return new AuthUserResource($user);
        } catch(Exception $e) {
            abort(500);
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
