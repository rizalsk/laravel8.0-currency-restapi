<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use NascentAfrica\Jetstrap\JetstrapFacade;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //JsonResource::withoutWrapping();
        Schema::defaultstringLength(191);
        //Paginator::useBootstrap();
        //JetstrapFacade::useAdminLte3();
    }
}
