<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{

    use HasFactory;

    const TYPES= [
        "fingerprint",
        "face",
        "card",
        "password",
        "key"
    ];
    const STATUSES= [
        "online", "offline"
    ];
    const CONNECTION_TYPES = [
        "wifi", "bluetooth", "USB"
    ];
    public function shifts(): HasMany{
        return $this->hasMany(Shift::class);
    }
}
