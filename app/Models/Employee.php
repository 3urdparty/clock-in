<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['image_url', 'role', 'description', 'user_id', 'username'];

    protected $with = [
        'user',
    ];
    protected $casts = [
        'status' => 'string',
    ];

    public const STATUS_TYPES = ['clocked-in', 'clocked-out'];
    public const ROLES = ['admin', 'employee'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fingerprints(): HasMany
    {
        return $this->hasMany(Fingerprint::class);
    }


    public function shifts(): HasMany
    {
        return $this->hasMany(Shift::class);
    }


    public function recentShift(): HasOne
    {
        return $this->hasOne(Shift::class)->latestOfMany();
    }

    public function getStatusAttribute()
    {
        return (!$this->recentShift || ($this->recentShift && $this->recentShift->end)) ? 'offline' : 'online';
    }

    public function completeCurrentShift()
    {
        $this->recentShift()->update(['end' => now()->hour + now()->minute / 60]);
    }

    public function startNewShift()
    {
        $this->shifts()->create(['start' => now()->hour(), 'date' =>  today()->toDateString(), 'device_id' => 1]);
    }
}
