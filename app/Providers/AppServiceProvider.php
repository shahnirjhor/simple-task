<?php

namespace App\Providers;

use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();

        view()->composer('*', function ($view) {
            if (Schema::hasTable('application_settings')) {
                $application = ApplicationSetting::first();
            } else {
                $application = NULL;
            }

            $view->with('applicationSetting', $application);
        });
    }
}
