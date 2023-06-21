<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Entry;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\EntryRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\IEntryRepository;
use App\Repositories\Interfaces\IUserRepository;
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
        $this->app->bind(ICategoryRepository::class, function() {
            return new CategoryRepository(new Category());
        });

        $this->app->bind(IUserRepository::class, function() {
            return new UserRepository(new User());
        });

        $this->app->bind(IEntryRepository::class, function() {
            return new EntryRepository(new Entry());
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
