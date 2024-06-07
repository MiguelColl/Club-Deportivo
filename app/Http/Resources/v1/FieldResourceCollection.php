<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FieldResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'sport_id' => $item->sport_id,
                    'sport_name' => $item->sport->name,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            }),
        ];
    }
}
