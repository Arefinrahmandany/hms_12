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
        'specialization',
        'email',
        'phone',
    ];

    // One doctor can have many chambers
    public function chambers()
    {
        return $this->hasMany(Chamber::class);
    }
}
