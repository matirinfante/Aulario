<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    use HasFactory;
    protected $fillable= [
        'day',
        'start_time',
        'finish_time',
        'classroom_id'
    ];

    //ORM relacion dia_horario a un salon
    public function classroom(){
        {
            $classroom = $this->hasOne(Classroom::class);
            return $classroom;
        }
    }
}
