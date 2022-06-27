<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['classroom_id', 'day', 'start_time', 'finish_time'];


    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    protected function startTime(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return Carbon::parse($value)->format('H:i');
            },
            set: function ($value) {
                return Carbon::parse($value)->format('H:i:s');
            }
        );
    }

    protected function finishTime(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return Carbon::parse($value)->format('H:i');
            },
            set: function ($value) {
                return Carbon::parse($value)->format('H:i:s');
            }
        );
    }
}
