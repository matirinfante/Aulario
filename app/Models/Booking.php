<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'classroom_id',
        'event_id',
        'assignment_id',
        'description',
        'status',
        'week_day',
        'booking_date',
        'start_time',
        'finish_time',
        'booking_uuid'];

    //ORM una reserva tiene un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //ORM una reserva tiene un evento
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    //ORM una reserva tiene un aula
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    //ORM se marca bidireccionalidad
    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

}
