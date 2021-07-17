<?php

namespace FinancialControl\Providers;

use FinancialControl\Models\Category;
use Illuminate\Support\ServiceProvider;
use FinancialControl\Repositories\CategoryRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, function() {
            return new CategoryRepository(new Category());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
