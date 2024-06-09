<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\MultipleResourceCollection;
use App\Http\Resources\v1\SimpleResource;
use App\Models\Field;
use App\Models\Member;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    private const TIMEZONE = 'Europe/Madrid';
    private const FORMATTER = 'Y-m-d H:i';

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
     * @return SimpleResource|JsonResponse
     */
    public function store(Request $request): SimpleResource | JsonResponse
    {
        $request->validate([
            'date' => ['required', 'date_format:' . self::FORMATTER],
            'member_id' => 'required|numeric|exists:members,id',
            'field_id' => 'required|numeric|exists:fields,id'
        ], [
            'date.date_format' => 'Introduce una fecha válida con el formato 2024-06-08 08:00'
        ]);

        $bookingData = $request->all();
        $errors = [];

        $bookingData['date'] = Carbon::createFromFormat(self::FORMATTER, $bookingData['date'], self::TIMEZONE);
        if (!$this->checkValidDate($bookingData['date'])) {
            $nextValidDate = $this->getNextValidDate();

            $errors[] = 'La hora de reserva es de 08:00 - 22:00, cada hora, a partir del ' .
                $nextValidDate->format(self::FORMATTER);
        }
        
        $member = Member::find($bookingData['member_id']);
        if (!$member->checkMaxBookings($bookingData['date'])) {
            $errors[] = 'Ese socio ya ha reservado 3 pistas para ese día';
        } elseif (!$member->checkBookingsOfTheDay($bookingData['date'])) {
            $errors[] = 'Ese socio ya tiene reservada una pista para ese día y hora';
        }
        
        $field = Field::find($bookingData['field_id']);
        if (!$field->checkAvailability($bookingData['date'])) {
            $errors[] = 'Esa pista ya está reservada para ese día y hora';
        }

        if(!empty($errors)) {
            return response()->json([
                'errors' => $errors
            ], 400);
        }

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
     * @return SimpleResource|JsonResponse
     */
    public function update(Request $request, Booking $booking): SimpleResource | JsonResponse
    {
        $request->validate([
            'date' => ['date_format:' . self::FORMATTER],
            'member_id' => 'numeric|exists:members,id',
            'field_id' => 'numeric|exists:fields,id'
        ], [
            'date.date_format' => 'Introduce una fecha válida con el formato 2024-06-08 08:00'
        ]);

        $bookingData = $request->all();
        $errors = [];

        if (array_key_exists('date', $bookingData)) {
            $bookingData['date'] = Carbon::createFromFormat(self::FORMATTER, $bookingData['date'], self::TIMEZONE);

            if (!$this->checkValidDate($bookingData['date'])) {
                $nextValidDate = $this->getNextValidDate();
    
                $errors[] = 'La hora de reserva es de 08:00 - 22:00, cada hora, a partir del ' .
                    $nextValidDate->format(self::FORMATTER);
            }
        }
        
        if (array_key_exists('member_id', $bookingData)) {
            $member = Member::find($bookingData['member_id']);

            if (!$member->checkMaxBookings($bookingData['date'])) {
                $errors[] = 'Ese socio ya ha reservado 3 pistas para ese día';
            } elseif (!$member->checkBookingsOfTheDay($bookingData['date'])) {
                $errors[] = 'Ese socio ya tiene reservada una pista para ese día y hora';
            }
        }

        if (array_key_exists('field_id', $bookingData)) {
            $field = Field::find($bookingData['field_id']);
    
            if (!$field->checkAvailability($bookingData['date'])) {
                $errors[] = 'Esa pista ya está reservada para ese día y hora';
            }
        }

        if(!empty($errors)) {
            return response()->json([
                'errors' => $errors
            ], 400);
        }

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

    /**
     * Check if a date is valid, this must be after the current time,
     * between 8:00 - 22:00 and hourly (0 minutes)
     *
     * @param Carbon $date
     * @return boolean
     */
    private function checkValidDate(Carbon $date): bool
    {
        // Check date
        $now = Carbon::now(self::TIMEZONE);
        if($date->lessThan($now) || $date->isSameHour($now)) {
            return false;
        }

        // Check hour
        if ($date->minute != 0 ||
            $date->hour < 8 ||
            $date->hour > 21)
        {
            return false;
        }

        return true;
    }

    /**
     * Get the next valid date for booking
     *
     * @return Carbon
     */
    private function getNextValidDate(): Carbon
    {
        $nextValidDate = Carbon::now(self::TIMEZONE);

        if ($nextValidDate->hour < 8 || $nextValidDate->hour >= 21) {
            $nextValidDate->addDay();
            $nextValidDate->hour = 8;
            $nextValidDate->minute = 0;
        } else {
            $nextValidDate->hour = $nextValidDate->hour + 1;
            $nextValidDate->minute = 0;
        }

        return $nextValidDate;
    }

    /**
     * Get all the information about bookings on a day
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function infoOfDay(Request $request): JsonResponse
    {
        $errors = [];

        if (!$request->filled('date')) {
            $errors[] = 'El parametro \'date\' no puede estar vacío en la URL';
        }

        // Try to parse date
        $date = '';
        try {
            $date = $request->date('date', 'Y-m-d', self::TIMEZONE);
        } catch (Exception $e) {
            $errors[] = 'La fecha debe ser con formato Y-m-d: 2024-06-08';
        }

        if(!empty($errors)) {
            return response()->json([
                'errors' => $errors
            ], 400);
        }

        $bookings = Booking::whereDate('date', $date)->get();

        $bookingsInfo = [];

        foreach ($bookings as $booking) {
            $sport = Field::find($booking['field_id'])->sport;
            $member = Member::find($booking['member_id']);
            
            $bookingsInfo[] = [
                'id' => $booking['id'],
                'hour' => $booking['date']->format('H:i'),
                'field_id' => $booking['field_id'],
                'sport' => $sport->name->value,
                'member' => [
                    'name' => $member->name,
                    'surname' => $member->surname,
                    'email' => $member->email,
                    'dni' => $member->dni
                ],
                'created_at' => $booking['created_at'],
                'updated_at' => $booking['updated_at']
            ];
        }

        return response()->json([
            'date' => $date->format('Y-m-d'),
            'bookings' => $bookingsInfo
        ], 200);
    }
}
