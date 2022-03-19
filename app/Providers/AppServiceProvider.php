<?php

namespace FinancialControl\Providers;

use FinancialControl\Models\Category;
use FinancialControl\Models\FinancialTransaction;
use Illuminate\Support\ServiceProvider;
use FinancialControl\Repositories\CategoryRepository;
use FinancialControl\Repositories\FinancialTransactionRepository;
use FinancialControl\Repositories\UserRepository;
use FinancialControl\User;
use Illuminate\Support\Facades\Validator;

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

        $this->app->bind(UserRepository::class, function() {
            return new UserRepository(new User());
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
        Validator::extend('is_valid_current_password', '\FinancialControl\Custom\Validation\IsValidCurrentPassword@validate');
        Validator::extend('new_password_is_not_equal_to_current_password', '\FinancialControl\Custom\Validation\NewPasswordIsNotEqualToCurrentPassword@validate');

        // fix: conflitos na funcionalidade Laravel Passport Problem in lcobucci/jwt package
        if (config('app.debug')) {
            error_reporting(E_ALL & ~E_USER_DEPRECATED);
        } else {
            error_reporting(0);
        }
    }
}
