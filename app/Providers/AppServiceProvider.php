<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        Schema::defaultStringLength(191);

        Blade::directive('rupiah', function ($money) {
            return "<?php echo number_format($money, 0, '.', '.'); ?>";
        });
    }
}
