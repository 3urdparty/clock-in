<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{

    use HasFactory;

    const TYPES = [
        "fingerprint",
        "face",
        "card",
        "password",
        "key"
    ];

    protected $fillable = [

        'name',
        'type',
        'description',
        'proximity',
        'image_url',
        'connection',
        'connection_strength',
        'battery',
        'last_online',
    ];
    const STATUSES = [
        "online", "offline"
    ];
    const CONNECTION_TYPES = [
        "wifi", "bluetooth", "USB"
    ];
    public function shifts(): HasMany
    {
        return $this->hasMany(Shift::class);
    }
    public function status(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->last_online && now()->parse($this->last_online)->diffInMinutes() < 5 ? "online" : "offline"
        );
    }
}
