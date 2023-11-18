<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Support\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{   
    use ApiResponse;
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        // take email and password from request
        $email      = $request->email;
        $password   = $request->password;

        // get user by email
        $user = User::where('email', $email)->first();

        // check if user not found
        if (!$user) {
            return $this->response('Email not found', Response::HTTP_UNAUTHORIZED, true);
        }
        // check if password not match
        if (!Hash::check($password, $user->password)) {
            return $this->response('Password not match', Response::HTTP_UNAUTHORIZED, true);
        }
        // create token for user
        $token = $user->createToken('auth_token')->plainTextToken;
        Auth::login($user);
        // return response with token and user data
        return $this->response(
            'Login success', 
            Response::HTTP_OK, false,
            [
                'token' => $token,
                'user'  => new UserResource($user)
            ]
        );


    }
}
