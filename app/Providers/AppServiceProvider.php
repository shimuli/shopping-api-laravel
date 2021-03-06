<?php

namespace App\Providers;

use App\Mail\UserCreated;
use App\Mail\UserEmailChanged;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        // Email sending event
        User::created(function ($user) {
            retry(5, function () use ($user) {
                Mail::to($user)->send(new UserCreated($user));

            }, 100);

        });

        User::updated(function ($user) {
            if ($user->isDirty('email')) {

                // retry after every 10 seconds five times before failing
                retry(5, function () use ($user) {
                    Mail::to($user)->send(new UserEmailChanged($user));
                }, 100);

            }

        });

        // check is product quantity is at 0 and update the available status
        Products::updated(function ($product) {
            if ($product->quantity == 0 && $product->isAvailable()) {
                $product->status = Products::UNAVAILABLE_PRODUCT;
                $product->save();
            }
        });

    }
}
