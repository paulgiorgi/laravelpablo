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

        if($option['public'] || $option['all']){
            self::makePublic();
            $this->info('Aaaal right ;-)');
        }

        if($option['helpers'] || $option['all']){
            self::makeHelpers();
            $this->info('Aaaal right. Remember to add new helpers to your composer and then run dump-autoload ;-)');
        }

        if($option['layouts'] || $option['all']){
            self::makeLayouts();
            $this->info('Aaaal right ;-)');
        }

        if($option['all']){
            $this->info('Aaaal right. Remember to add new helpers to your composer and then run dump-autoload ;-)');
        }

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
