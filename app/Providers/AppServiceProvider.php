<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Company;
use App\Observers\CategoryObserver;
use App\Observers\CompanyObserve;
use Illuminate\Support\ServiceProvider;

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
        Category::observe(CategoryObserver::class);
        Company::observe(CompanyObserve::class);
    }
}
