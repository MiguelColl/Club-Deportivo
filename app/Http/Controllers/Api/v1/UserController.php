<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\SimpleResource;
use App\Http\Resources\v1\MultipleResourceCollection;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return MultipleResourceCollection
     */
    public function index(): MultipleResourceCollection
    {
        return new MultipleResourceCollection(User::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return SimpleResource
     */
    public function store(Request $request): SimpleResource
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'surname' => 'required',
            'password' => 'required',
        ]);

        $userData = $request->all();
        $userData['password'] = Hash::make($userData['password']);

        $user = User::create($userData);

        return new SimpleResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return SimpleResource
     */
    public function show(User $user): SimpleResource
    {
        return new SimpleResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return SimpleResource
     */
    public function update(Request $request, User $user): SimpleResource
    {
        $request->validate([
            'email' => 'email|unique:users',
        ]);
        
        $userData = $request->all();

        if (array_key_exists('password', $userData)) {
            $userData['password'] = Hash::make($userData['password']);
        }

        $user->update($userData);
        
        return new SimpleResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json([], 204);
    }
}
