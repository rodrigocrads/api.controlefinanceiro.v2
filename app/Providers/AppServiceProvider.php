<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\FinancialTransaction;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\FinancialTransactionRepository;
use App\Repositories\UserRepository;
use App\User;
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
        Validator::extend('is_valid_current_password', '\App\Custom\Validation\IsValidCurrentPassword@validate');
        Validator::extend('new_password_is_not_equal_to_current_password', '\App\Custom\Validation\NewPasswordIsNotEqualToCurrentPassword@validate');

        // fix: conflitos na funcionalidade Laravel Passport Problem in lcobucci/jwt package
        if (config('app.debug')) {
            error_reporting(E_ALL & ~E_USER_DEPRECATED);
        } else {
            error_reporting(0);
        }
    }
}
