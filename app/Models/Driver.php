<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Driver extends Model
{
    public function car(): HasOne
    {
        return $this->hasOne(Car::class);
    }
}
