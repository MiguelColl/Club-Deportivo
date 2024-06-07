<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\FieldResource;
use App\Http\Resources\v1\FieldResourceCollection;
use App\Models\Field;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return FieldResourceCollection
     */
    public function index(): FieldResourceCollection
    {
        return new FieldResourceCollection(Field::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return FieldResource
     */
    public function store(Request $request): FieldResource
    {
        $request->validate([
            'sport_id' => 'required|numeric|exists:sports,id',
        ]);

        $field = Field::create($request->all());

        return new FieldResource($field);
    }

    /**
     * Display the specified resource.
     *
     * @param Field $field
     * @return FieldResource
     */
    public function show(Field $field): FieldResource
    {
        return new FieldResource($field);
    }

    /**
     * Display the specified resource.
     *
     * @param Field $field
     * @return FieldResource
     */
    public function update(Request $request, Field $field): FieldResource
    {
        $request->validate([
            'sport_id' => 'numeric|exists:sports,id',
        ]);

        $field->update($request->all());

        return new FieldResource($field);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Field $field
     * @return JsonResponse
     */
    public function destroy(Field $field): JsonResponse
    {
        $field->delete();

        return response()->json([], 204);
    }
}
