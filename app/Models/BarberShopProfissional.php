<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarberShopProfissional extends Model
{
    use HasFactory;

    protected $table = 'barber_shop_profissional';

    protected $fillable = [
        'profissional',
        'barber_shop'
    ];

    function barberShop()
    {
        return $this->hasOne(BarberShop::class, 'id', 'barber_shop');
    }

    function profissionalForeign()
    {
        return $this->hasOne(User::class, 'id', 'profissional');
    }
}
