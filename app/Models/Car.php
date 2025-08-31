<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function car_model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }
}
