<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    use HasFactory;

    protected $fillable = ['user_id',
        'assignment_id',
        'estimated_people',
        'classroom_type',
        'start_time',
        'finish_time',
        'start_date',
        'finish_date',
        'days',
        'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

}
