<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'name',
        'last_name',
        'text',
        'email',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
