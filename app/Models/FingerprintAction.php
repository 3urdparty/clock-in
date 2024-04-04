<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FingerprintAction extends Model
{
    use HasFactory;
    protected $fillable = ['fingerprint_id', 'action', 'employee_id', 'device_id'];
}
