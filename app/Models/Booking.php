<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'status',
        'week_day',
        'booking_date',
        'start_time',
        'finish_time'];

    //ORM una reserva tiene un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //ORM una reserva tiene un evento
    public function event()
    {
        return $this->hasOne(Event::class);
    }

    //ORM una reserva tiene un aula
    public function classroom()
    {
        return $this->hasOne(Classroom::class);
    }

    //ORM se marca bidireccionalidad
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

}
