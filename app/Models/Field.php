<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sport_id'
    ];

    /**
     * Get the sport associated with this field
     *
     * @return BelongsTo
     */
    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    /**
     * Get the bookings of the field
     *
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Check if the field has a booking for an hour in a day
     *
     * @param Carbon $date
     * @return boolean
     */
    public function checkAvailability(Carbon $date): bool
    {
        $bookings = $this->bookings()
            ->whereDate('date', $date)
            ->get();

        foreach ($bookings as $booking) {
            if ($date->isSameHour($booking->date)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the available field hours for a day
     *
     * @param Carbon $date
     * @return array
     */
    public function availableHoursOfDay(Carbon $date): array
    {
        $bookingHours = [];
        
        $bookings = $this->bookings()
            ->whereDate('date', $date)
            ->get();

        foreach ($bookings as $booking) {
            $date = Carbon::createFromDate($booking['date'], 'Europe/Madrid');
            $bookingHours[] = $date->hour;
        }

        for ($i = 8; $i < 22; $i++) {
            $hours[] = $i;
        }

        return array_map(function ($num) {
            return $num . ':00';
        }, array_diff($hours, $bookingHours));
    }
}
