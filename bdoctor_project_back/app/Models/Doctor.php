<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_photo',
        'cv',
        'phone_number',
        'address',
        'performances',
        'description',
    ];


    public function specializations()
    {
        return $this->belongsToMany(Specialization::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function ratings()
    {
        return $this->belongsToMany(Rating::class)->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class)->withTimestamps();
    }
}
