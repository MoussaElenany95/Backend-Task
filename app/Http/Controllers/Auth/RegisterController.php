<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use App\Support\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use ApiResponse;

    /**
     * Handle an incoming registration request.
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        // create user
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
        ]);

        // create token
        $token = $user->createToken('auth_token')->plainTextToken;

        Auth::login($user);

        return $this->success('User created', [
            'token' => $token,
            'user'  => new UserResource($user)
        ], Response::HTTP_CREATED);
    }
}
