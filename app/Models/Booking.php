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

}
