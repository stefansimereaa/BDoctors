<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'cost',
        'name',
    ];
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class)->withTimestamps();
    }
}
