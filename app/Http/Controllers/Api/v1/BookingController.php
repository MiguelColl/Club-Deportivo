<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\MultipleResourceCollection;
use App\Http\Resources\v1\SimpleResource;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return MultipleResourceCollection
     */
    public function index(): MultipleResourceCollection
    {
        return new MultipleResourceCollection(Booking::paginate());
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
            'date' => 'required|date_format:Y-m-d H:i',
            'member_id' => 'required|numeric|exists:members,id',
            'field_id' => 'required|numeric|exists:fields,id'
        ]);

        $bookingData = $request->all();
        $bookingData['date'] = Carbon::createFromFormat('Y-m-d H:i', $bookingData['date'], 'Europe/Madrid');

        dd(Carbon::now('Europe/Madrid')->hour);

        $booking = Booking::create($bookingData);

        return new SimpleResource($booking);
    }

    /**
     * Display the specified resource.
     *
     * @param Booking $booking
     * @return SimpleResource
     */
    public function show(Booking $booking): SimpleResource
    {
        return new SimpleResource($booking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Booking $booking
     * @return SimpleResource
     */
    public function update(Request $request, Booking $booking): SimpleResource
    {
        $booking->update($request->all());

        return new SimpleResource($booking);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Booking $booking
     * @return JsonResponse
     */
    public function destroy(Booking $booking): JsonResponse
    {
        $booking->delete();

        return response()->json([], 204);
    }
}
