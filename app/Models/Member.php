<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'dni'
    ];

    /**
     * Get the bookings of the member
     *
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Check if the member has less than 3 bookings for a day
     *
     * @param Carbon $date
     * @return boolean
     */
    public function checkMaxBookings(Carbon $date): bool
    {
        $bookings = $this->bookings()
            ->whereDate('date', $date)
            ->get();

        return count($bookings) < 3;
    }

    /**
     * Check if the member has a booking for an hour in a day
     *
     * @param Carbon $date
     * @return boolean
     */
    public function checkBookingsOfTheDay(Carbon $date): bool
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
}
