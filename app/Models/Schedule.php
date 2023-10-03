<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'barber_shop',
        'client',
        'barber',
        'date',
        'hour',
        'status'
    ];

    function barberShop()
    {
        return $this->belongsTo(BarberShop::class, 'id', 'barber_shop');
    }

    function clientForeign()
    {
        return $this->hasOne(User::class, 'id', 'client');
    }

    function barberForeign()
    {
        return $this->hasOne(User::class, 'id', 'barber');
    }

    function statusForeign()
    {
        return $this->hasOne(ScheduleStatus::class, 'id', 'status');
    }
}
