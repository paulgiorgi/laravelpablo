<?php

namespace Paulgiorgi\Laravelpablo;

use Illuminate\Support\ServiceProvider;
use Paulgiorgi\Laravelpablo\commands\ConvertScssToCss;
use Paulgiorgi\Laravelpablo\commands\MakeResources;
// use Paulgiorgi\Laravelpablo\commands\MakeController;
// use Paulgiorgi\Laravelpablo\commands\MakeModel;
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
                ConvertScssToCss::class,
                MakeResources::class,
                // MakeController::class,
                // MakeModel::class,
                ProjectInit::class,
            ]);
        }
    }


    public function register()
    {

    }
}
