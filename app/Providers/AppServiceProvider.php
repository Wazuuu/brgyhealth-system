<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // <-- ADD THIS
use Illuminate\Support\Facades\Schema;

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
        Gate::define('admin-only', function ($user) {
            return in_array($user->role, ['admin', 'health_worker']);
        });

        Gate::define('manage-appointments', function ($user) {
            return in_array($user->role, ['admin', 'health_worker']);
        });
    }
}
