<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shift extends Model
{
    use HasFactory;

    protected $appends = ['duration', 'week_number', 'week_day'];
    protected $with = ['device', 'employee.user'];
    protected $casts = [
        'start' => 'float',
        'end' => 'float',
    ];

    protected $fillable = [
        'device_id',
        'employee_id',
        'start',
        'end',
        'date',
    ];
    public function device(): BelongsTo

    {
        return $this->belongsTo(Device::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    public function getDurationAttribute(): float
    {
        return $this->end - $this->start;
    }
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
    public function getWeekNumberAttribute(): int
    {
        return Carbon::parse($this->date)->weekOfYear;
    }

    public function getWeekDayAttribute(): int
    {
        return Carbon::parse($this->date)->dayOfWeek();
    }
}
