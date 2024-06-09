<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\SimpleResource;
use App\Http\Resources\v1\MultipleResourceCollection;
use Illuminate\Http\JsonResponse;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return MultipleResourceCollection
     */
    public function index(): MultipleResourceCollection
    {
        return new MultipleResourceCollection(Member::paginate());
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
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:members',
            'dni' => ['required', 'regex:/^(\d{8})([A-Z])$/', 'unique:members']
        ], [
            'dni.regex' => 'El campo :attribute no es un DNI válido, se necesitan ocho dígitos y una letra de A-Z'
        ]);

        $member = Member::create($request->all());

        return new SimpleResource($member);
    }

    /**
     * Display the specified resource.
     *
     * @param Member $member
     * @return SimpleResource
     */
    public function show(Member $member): SimpleResource
    {
        return new SimpleResource($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Member $member
     * @return SimpleResource
     */
    public function update(Request $request, Member $member): SimpleResource
    {
        $request->validate([
            'email' => 'email|unique:members',
            'dni' => ['regex:/^(\d{8})([A-Z])$/', 'unique:members']
        ], [
            'dni.regex' => 'El campo :attribute no es un DNI válido, se necesitan ocho dígitos y una letra de A-Z'
        ]);

        $member->update($request->all());

        return new SimpleResource($member);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Member $member
     * @return JsonResponse
     */
    public function destroy(Member $member): JsonResponse
    {
        $member->delete();

        return response()->json([], 204);
    }
}
