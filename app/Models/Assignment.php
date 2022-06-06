<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['assignment_name', 'user_id'];

    //ORM referencia bidireccional
    public function users()
    {
        return $this->belongsToMany(User::class, 'assignment_user', 'assignment_id', 'user_id');
    }

    //ORM una materia referencia a una coleccion de reservas
    public function bookings()
    {
        $colbooking = $this->hasMany(Booking::class);
        return $colbooking;
    }
}
