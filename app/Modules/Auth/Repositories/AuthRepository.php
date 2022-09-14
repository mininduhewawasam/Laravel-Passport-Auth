<?php

namespace App\Modules\Auth\Repositories;

use App\Models\User;
use App\Modules\Auth\Repositories\Interfaces\AuthRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    public function __construct(protected User $user)
    {
    }

    public function create(array $data): User
    {
        try {
            return $this->store($data);
        } catch (Exception $e) {
            return abort(500);
        }
    }

    protected function store(array $data): User
    {
        return $this->user::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
