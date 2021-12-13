<?php

namespace App\Providers;

use App\Channel\FirebaseChannel;
use App\ORM_Model\Fld_Event\EventInterface;
use App\ORM_Model\Fld_Event\EventRepository;
use App\ORM_Model\Fld_Product\ProductInterface;
use App\ORM_Model\Fld_Product\ProductRepository;
use App\ORM_Model\Fld_User\UserInterface;
use App\ORM_Model\Fld_User\UserRepository;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
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
        $this->app->bind(
            ProductInterface::class,
            ProductRepository::class
        );
        $this->app->bind(
            UserInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            EventInterface::class,
            EventRepository::class
        );
        Notification::extend('firebase', function () {
            return new FirebaseChannel();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Validation and Others

        Validator::extend('mobile', function ($attribute, $value) {
            return preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $value) && strlen($value) == 10;
        });
    }
}
