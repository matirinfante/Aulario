<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'participants'];
          //ORM bidireccion a reserva
    public function bookings()
    {
        $colbooking=$this->belongsTo(Booking::class);
        return $colbooking;
    }

}
