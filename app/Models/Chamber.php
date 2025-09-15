<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chamber extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'name',
        'address',
        'phone',
        'city',
        'state',
        'country',
        'start_time',
        'end_time',
        'working_days',
        'consultation_fee',
        'status',
    ];

    // Chamber belongs to a doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
