<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'dni',
        'email',
        'password',
        'user_uuid'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];


    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'assignment_user', 'user_id', 'assignment_id');
    }

    //ORM bidireccion a reserva
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    //ORM bidireccion a eventos
    public function events()
    {
        $colEvents = $this->hasMany(Event::class);
        return $colEvents;
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }

    //Mutador para nombre
    protected function name(): Attribute
    {
        return new Attribute(
            set: function ($value) {
                $value = strtolower($value);
                return ucwords($value);
            }
        );
    }

    //Mutador para apellido
    protected function surname(): Attribute
    {
        return new Attribute(
            set: function ($value) {
                $value = strtolower($value);
                return ucwords($value);
            }
        );
    }
}
