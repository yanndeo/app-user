<?php

declare(strict_types=1);


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Groupe;
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $query = User::query();
        $query->orderByDesc('created_at');
        $users = $query->paginate(6);

        return  UserResource::collection($users);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'first_name' => 'required',
            'phone'      => 'required',
            'email'      => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()]);
        }

        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            $user->password =  Hash::make('password');
        }
        $user->email     = $data['email'] ;
        $user->name      = $data['first_name'];
        $user->groupe_id = $data['groupe'];
        $user->save();

        //profileData
        $embeddedProfile = array(
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'phone'      => $data['phone'],
            'address'    => $data['address']
        ) ;

        $user->profile()->create($embeddedProfile);

        return response()->json(['user' => new UserResource($user), 'message' => 'user Created Successfully'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        if($user) {
            return response(['user' => new UserResource($user), 'message' => 'Retrieved Successfully'], Response::HTTP_OK);
        }

        return response(['user' => new UserResource($user), 'message' => 'User not exist'], Response::HTTP_NOT_FOUND);
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

        return response(['user' => new UserResource($user), 'message' => 'user Updated Successfully'], Response::HTTP_OK);
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        if( auth()->user()->id !== $user->id) {
            $user->delete();
            return response()->json([ 'message' => 'User Deleted Successfully'], Response::HTTP_OK);
        } else {
            return response()->json([ 'message' => ''], Response::HTTP_UNAUTHORIZED);
        }

    }
}
