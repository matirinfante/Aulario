<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'event_name',
        'participants'];

    //ORM bidireccion a reserva

    public function bookings()
    {
        $colbooking = $this->hasMany(Booking::class);
        return $colbooking;
    }

}
