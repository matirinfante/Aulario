<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['assignment_name'];
    
    //ORM referencia bidireccional 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //ORM una materia referencia a una coleccion de reservas
    public function bookings(): hasMany
    {
        $colbooking=$this->hasMany(booking::class);
        return $colbooking;
    }
}
