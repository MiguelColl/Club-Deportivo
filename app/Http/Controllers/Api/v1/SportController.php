<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\SportType;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\SimpleResource;
use App\Http\Resources\v1\MultipleResourceCollection;
use App\Models\Sport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return MultipleResourceCollection
     */
    public function index(): MultipleResourceCollection
    {
        return new MultipleResourceCollection(Sport::paginate());
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
            'name' => ['required', Rule::enum(SportType::class), 'unique:sports'],
        ]);

        $sport = Sport::create($request->all());

        return new SimpleResource($sport);
    }

    /**
     * Display the specified resource.
     *
     * @param Sport $sport
     * @return SimpleResource
     */
    public function show(Sport $sport): SimpleResource
    {
        return new SimpleResource($sport);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Sport $sport
     * @return SimpleResource
     */
    public function update(Request $request, Sport $sport): SimpleResource
    {
        $request->validate([
            'name' => [Rule::enum(SportType::class), 'unique:sports'],
        ]);

        $sport->update($request->all());

        return new SimpleResource($sport);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sport $sport
     * @return JsonResponse
     */
    public function destroy(Sport $sport): JsonResponse
    {
        $sport->delete();

        return response()->json([], 204);
    }
}
