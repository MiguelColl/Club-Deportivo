<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
