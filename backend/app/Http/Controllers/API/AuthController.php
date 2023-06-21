<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User as ModelUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    CONST DEFAULT_PASSWORD = "password" ;

    /**
     * Store a newly created user in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {

        $data = $request->all();
        $validatedData = $request->validate([
            //'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = Hash::make(self::DEFAULT_PASSWORD);
        $user = ModelUser::create($validatedData);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json(['user' => $user, 'access_token' => $accessToken], Response::HTTP_CREATED);
    }


    /**
     * Login user and  generate token
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response()->json(['message' => 'Invalid Credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response()->json([ 'user' => auth()->user(), 'access_token' => $accessToken], Response::HTTP_OK);
    }

    /**
     * Get information about user logged
     *
     * @return JsonResponse
     */
    public function loginUserDetail(): JsonResponse
    {
        return response()->json(['user' => auth()->user()], Response::HTTP_OK);
    }

    /**
     * Logout
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        dd(Auth::user());
        if($user = Auth::user()->token()) {
            $user->revoke();
            return response()->json(['message' => 'Logged out successfully'], Response::HTTP_OK);
        }
        else{
            return response()->json(['message' => 'Unauthorisedxx'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
