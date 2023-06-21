<?php

declare(strict_types=1);


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $query = User::query();
        $users = $query->paginate(6);

        return  UserResource::collection($users);

        // return response([ 'user' => UserResource::collection($users), 'message' => 'Retrieved successfully'], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'profile.first_name' => 'required',
            'profile.phone' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $user = User::firstOrNew(['email' => $data['email']]);
        $user->password = $user->password ?? Hash::make('password');
        $user->save();

        $profile = $user->profile()->firstOrNew([]);
        $profile->fill($data['profile']);
        $profile->save();

        return response(['user' => new UserResource($user), 'message' => 'user Created Successfully'], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return response(['user' => new UserResource($user), 'message' => 'Retrieved Successfully'], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request,  User $user)
    {
        $user->update($request->all());

        return response(['user' => new UserResource($user), 'message' => 'user Updated Successfully'], 200);
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json([ 'message' => 'User Deleted Successfully'], 200);
    }
}
