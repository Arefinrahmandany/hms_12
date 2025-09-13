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
        'name',        // e.g., Hospital Name / Clinic Name
        'address',
        'city',
        'phone',
        'schedule',    // visiting hours
    ];

    // Chamber belongs to a doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
