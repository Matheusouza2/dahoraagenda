<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleConfig extends Model
{
    use HasFactory;

    protected $table = 'schedule_configs';

    protected $fillable = [
        'barber_shop',
        'day',
        'hour_1',
        'hour_2',
        'hour_3',
        'hour_4',
        'hour_5',
        'hour_6',
    ];
}
