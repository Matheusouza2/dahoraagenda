<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarberShop extends Model
{
    use HasFactory;

    protected $table = 'barber_shops';

    protected $fillable = [
        'name',
        'phone',
        'whatsapp',
        'type',
        'logo',
        'owner'
    ];

    function responsavel()
    {
        return $this->belongsTo(User::class, 'id', 'owner');
    }
}
