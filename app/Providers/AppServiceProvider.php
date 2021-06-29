<?php

namespace App\Providers;

use App\Models\Products;
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

        Products::updated(function($product){
            if($product->quantity == 0 && $product->isAvailable()){
                $product->status = Products::UNAVAILABLE_PRODUCT;
                $product->save();
            }
        });

    }
}
