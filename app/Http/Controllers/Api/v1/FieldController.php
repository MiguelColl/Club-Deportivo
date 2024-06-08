<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\SportType;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\FieldResource;
use App\Http\Resources\v1\FieldResourceCollection;
use App\Models\Field;
use App\Models\Member;
use App\Models\Sport;
use Exception;
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

    /**
     * Search available fields for a sport, a member and a day
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $errors = [];
        $params = ['member', 'sport', 'date'];

        // Check if all params are included
        foreach ($params as $param) {
            if (!$request->filled($param)) {
                $errors[] = 'El parametro \'' . $param . '\' no puede estar vacío en la URL';
            }
        }

        // Try to parse params
        $date = '';
        try {
            $date = $request->date('date', 'Y-m-d', 'Europe/Madrid');
        } catch (Exception $e) {
            $errors[] = 'La fecha debe ser con formato Y-m-d: 2024-06-08';
        }

        $sport_name = $request->enum('sport', SportType::class);
        if (!$sport_name) {
            $types = [];
            foreach (SportType::cases() as $value) {
                $types[] = $value->value;
            }
            $errors[] = 'Los tipos admitidos de deporte son: ' . implode(', ', $types);
        }

        $member_id = $request->string('member');
        try {
            $member = Member::find($member_id);
            if (!$member) {
                $errors[] = 'El socio buscado no existe';
            } elseif ($date && !$member->checkMaxBookings($date)) {
                $errors[] = 'Ese socio ya ha reservado 3 pistas para ese día';
            }
        } catch (Exception $e) {
            $errors[] = "El valor del parámetro 'member' debe ser un número";
        }

        if(!empty($errors)) {
            return response()->json([
                'errors' => $errors
            ], 400);
        }

        $sport_id = Sport::where('name', $sport_name)->value('id');

        $field_ids = Field::where('sport_id', $sport_id)->get('id');
        $fields = [];

        // Get the available hours for each field
        foreach ($field_ids as $field_id) {
            $hours = Field::find($field_id['id'])->availableHoursOfDay($date);
            $fields[] = [
                'id' => $field_id['id'],
                'available_hours' => array_values($hours)
            ];
        }

        return response()->json([
            'sport' => $sport_name,
            'fields' => $fields
        ], 200);
    }
}
