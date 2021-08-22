<?php

namespace FinancialControl\Providers;

use FinancialControl\Models\Category;
use FinancialControl\Models\FixedExpense;
use FinancialControl\Models\FixedRevenue;
use Illuminate\Support\ServiceProvider;
use FinancialControl\Models\VariableRevenue;
use FinancialControl\Models\VariableExpense;
use FinancialControl\Repositories\CategoryRepository;
use FinancialControl\Repositories\FixedExpenseRepository;
use FinancialControl\Repositories\FixedRevenueRepository;
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

        $this->app->bind(FixedExpenseRepository::class, function() {
            return new FixedExpenseRepository(new FixedExpense());
        });

        $this->app->bind(FixedRevenueRepository::class, function() {
            return new FixedRevenueRepository(new FixedRevenue());
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
