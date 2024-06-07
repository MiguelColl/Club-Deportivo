<?php

namespace App\Models;

use App\Enums\SportType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sport extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get the fields of the sport
     *
     * @return HasMany
     */
    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'name' => SportType::class,
        ];
    }
}
