<?php

namespace App\Providers;

use \Filament\Actions\CreateAction;
use \Filament\Resources\Pages\CreateRecord;
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
        CreateRecord::disableCreateAnother();
    }
}
