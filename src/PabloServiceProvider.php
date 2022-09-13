<?php

namespace Paulgiorgi\Laravelpablo;

use Illuminate\Support\ServiceProvider;
use Paulgiorgi\Laravelpablo\commands\MakeResources;
use Paulgiorgi\Laravelpablo\commands\ProjectInit;

class PabloServiceProvider extends ServiceProvider{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //publish js, css, fonts in public

        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeResources::class,
                ProjectInit::class,
            ]);
        }
    }


    public function register()
    {

    }
}
