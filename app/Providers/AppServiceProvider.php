<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \Blade::directive('money', function ($number) {
            return "<?php echo number_format($number, 0, ',', '.'); ?>";
        });
        \Blade::directive('echoIf', function ($params) {
            list($echo, $expression) = explode(',', $params);
            return "<?php echo ($expression ? $echo : '');  ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
