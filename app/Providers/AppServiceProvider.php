<?php

namespace App\Providers;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV', 'APP_DEBUG') == true) {

            DB::listen(function ($sql, $bindings, $time) {
                foreach ($bindings as $index => $param) {
                    if ($param instanceof DateTime) {
                        $bindings[$index] = $param->format('Y-m-d H:i:s');
                    }
                }
                $sql = str_replace("?", "'%s'", $sql);
                array_unshift($bindings, $sql);
                //Log::info(call_user_func_array('sprintf', $bindings));
                // dump($sql);
            });
        }
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
