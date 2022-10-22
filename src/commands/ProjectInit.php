<?php

namespace Paulgiorgi\Laravelpablo\commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ProjectInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelpablo:init
        {--public : Install js css and fonts}
        {--helpers : Install helpers like cache_bs}
        {--layouts : Install and overwrite app and guest.blade.php}
        {--provider : Install only the macro functions like whereLike}
        {--all : Run all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Laravel like Paul\'s like';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $option = $this->option();

        if($option['help'] || empty($option)){
            $this->info('
            {--public : Install js css and fonts}
            {--helpers : Install helpers like cache_bs}
            {--layouts : Install and overwrite app and guest.blade.php}
            {--provider : Install only the macro functions like whereLike}
            {--all : Run all}
            ');
        }

        if($option['public'] || $option['all']){
            self::makePublic();
            $this->info('Public folder stuff yo.');
        }

        if($option['helpers'] || $option['all']){
            self::makeHelpers();
            $this->info('Helpers, remember to add their dependencies onto your composer and run a dump-autoload.');
        }

        if($option['layouts'] || $option['all']){
            self::makeLayouts();
            $this->info('Layouts.');
        }

        if($option['provider'] || $option['all']){
            self::makeProvider();
            $this->info('Okok, AppServiceProvider boosted with goodness :D');
        }

        if($option['all']){
            $this->info('ALL MEANS: Big power -> big responsabilities');
        }

    }

    public function makeProvider()
    {
        File::copyDirectory(__DIR__ . '/../providers',app_path('/Providers'));
    }

    public function makePublic()
    {
        File::copyDirectory(__DIR__ . '/../public', public_path());
    }


    public function makeHelpers()
    {
        File::copyDirectory(__DIR__ . '/../helpers', app_path('/Helpers'));
    }

    public function makeLayouts()
    {
        File::copyDirectory(__DIR__ . '/../resources/views/layouts', resource_path('/views/layouts'));
    }
}
