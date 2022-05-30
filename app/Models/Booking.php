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
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'foreign_key', 'local_key');
    }

   //ORM una reserva tiene un evento
    public function event(): HasOne
    {
        return $this->hasOne(event::class, 'foreign_key', 'local_key');
    }

    //ORM una reserva tiene un aula
    public function classroom(): HasOne
    {
        return $this->hasOne(classroom::class, 'foreign_key', 'local_key');
    }

    //ORM se marca bidireccionalidad (chequear si es correcto)
    public function assignment():belongsTo {
        return $this->belongsTo(assignment::class, 'foreign_key', 'local_key');
    }

}
