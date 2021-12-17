<?php

namespace FinancialControl\Providers;

use FinancialControl\Models\Category;
use Illuminate\Support\ServiceProvider;
use FinancialControl\Models\VariableRevenue;
use FinancialControl\Models\VariableExpense;
use FinancialControl\Repositories\CategoryRepository;
use FinancialControl\Repositories\VariableExpenseRepository;
use FinancialControl\Repositories\VariableRevenueRepository;

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

        $this->app->bind(VariableExpenseRepository::class, function() {
            return new VariableExpenseRepository(new VariableExpense());
        });

        $this->app->bind(VariableRevenueRepository::class, function() {
            return new VariableRevenueRepository(new VariableRevenue());
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
