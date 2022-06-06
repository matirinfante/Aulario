<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
    'classroom_name',
    'location',
    'capacity',
    'type'];

    //ORM bidireccion a reserva
    public function bookings()
    {
        $colbooking=$this->hasMany(Booking::class);
        return $colbooking;
    }
}
