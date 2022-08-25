<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }

    public function register(Request $request)
    {
        $validator = $this->validateRegister($request->all());

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $response = $this->authService->register($request->all());

        return $this->sendResponse($response, 'User registered successfully.');
    }

    protected function validateRegister(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

}
