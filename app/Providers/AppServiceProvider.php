<?php

namespace App\Providers;

use App\Models\BarberShop;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Request::is('barbearias')) {
            $barbearias = BarberShop::all();

            view()->share('barbearias', $barbearias);
        }
    }
}
