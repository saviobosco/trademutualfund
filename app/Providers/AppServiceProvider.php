<?php

namespace App\Providers;

use App\MakePayment;
use App\User;
use App\Observers\UserObserver;
use App\Observers\MakePaymentObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        MakePayment::observe(MakePaymentObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
