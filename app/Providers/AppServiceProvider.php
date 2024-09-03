<?php

namespace App\Providers;

use App\Models\ContactUs;
use App\Models\Setting;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $settings = Setting::first();
        $contact_us = ContactUs::first();
        view()->share(compact('settings','contact_us'));
        RateLimiter::for('reset-password',function(Request $request){
           return Limit::perMinute(3,30)
               ->by($request->ip());
        });
    }
}
