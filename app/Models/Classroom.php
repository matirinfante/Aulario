<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
    'classroom_name', 
    'location', 
    'capacity', 
    'type'];

    public function bookings(): belongsTo
    {
        $colbooking=$this->belongsTo(booking::class);
        return $colbooking;
    }
}
