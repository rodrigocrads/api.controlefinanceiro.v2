<?php

namespace FinancialControl\Providers;

use FinancialControl\Models\Category;
use FinancialControl\Models\FinancialTransaction;
use Illuminate\Support\ServiceProvider;
use FinancialControl\Repositories\CategoryRepository;
use FinancialControl\Repositories\FinancialTransactionRepository;

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

        $this->app->bind(FinancialTransactionRepository::class, function() {
            return new FinancialTransactionRepository(new FinancialTransaction());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // fix: conflitos na funcionalidade Laravel Passport Problem in lcobucci/jwt package
        if (config('app.debug')) {
            error_reporting(E_ALL & ~E_USER_DEPRECATED);
        } else {
            error_reporting(0);
        }
    }
}
