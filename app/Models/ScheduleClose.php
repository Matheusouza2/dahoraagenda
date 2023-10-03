<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleClose extends Model
{
    use HasFactory;

    protected $table = 'schedule_closes';

    protected $fillable = [
        'barber_shop',
        'date',
        'reason'
    ];

    function barberShop()
    {
        return $this->belongsTo(BarberShop::class, 'id', 'barber_shop');
    }
}
