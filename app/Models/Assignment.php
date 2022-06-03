<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['assignment_name', 'user_id'];
    
    //ORM referencia bidireccional 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //ORM una materia referencia a una coleccion de reservas
    public function bookings()
    {
        $colbooking=$this->hasMany(Booking::class);
        return $colbooking;
    }
}
