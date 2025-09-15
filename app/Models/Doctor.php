<?php

namespace App\Models;

use App\Models\Chamber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'dob',
        'gender',
        'photo',
        'specialization',
        'qualification',
        'experience',
        'degree',
        'registration_number',
        'department',
        'address',
        'bio',
        'languages',
        'status',
    ];

    // One doctor can have many chambers
    public function chambers()
    {
        return $this->hasMany(Chamber::class);
    }
}
