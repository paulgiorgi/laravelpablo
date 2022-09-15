<?php

namespace Paulgiorgi\Laravelpablo\commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Str;

class MakeResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelpablo:resources
        {--model=Modelname : define model\'s name}
        {--option2: controller , model-view , model , all }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Made files for model my baby';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $model = $this->option['model'];
        $plural = Str::plural(strtolower($model));

        $views_path = resource_path('/views/'.$plural);
        $blade_index_path = $views_path.'/index.blade.php';
        $blade_form_path = $views_path.'/_form.blade.php';
        $js_folder_path = public_path('/js/views');
        $js_file_path = $js_folder_path.$plural.'.js';
        $controller_file_path = app_path('/Http/Controllers/'.$model.'Controller.php');

        //add edit section for fast-edit to Model


        // if(!(File::exists($model))){
            self::makeCoolerModel($model);
                die();
        // }

        //check if blade **folder** exists
        if(!file_exists($views_path)){
            mkdir(self::normalizePath(__DIR__ . '/../../../resources/views/'.$plural));
        };

        //check if index.blade.php exists in the folder.
        if(!file_exists($blade_index_path)){
            self::createBladeIndex($plural);
        }

        //check if _form.blade.php exists in the folder.
        if(!file_exists($blade_form_path)){
            self::createBladeForm($plural,$model);
        }

        //check if js folder exists
        if(!file_exists($js_folder_path)){
            mkdir(self::normalizePath(__DIR__ . '/../../../public/js/views'));
        }

        //check if js **file** exists
        if(!file_exists($js_file_path)){
            self::createJsFile($plural);
        };

        //check if Controller has been created yet
        if(!file_exists($controller_file_path)){
            self::createController($model);
        }


        $this->info('Files creati con successo');
    }

    private static function makeCoolerModel($model){
        //remove last } from Model.php in App\Models\
        File::put(app_path('/Models/'.$model.'.php'),str_replace("}", "", File::get(app_path('/Models/'.$model.'.php'))));

        //attach the cool custom appendix for model
        $cool = File::get(__DIR__ . '/../default/Model.php');

        //appending the coolness to the shortened model
        file_put_contents(app_path('/models/'.$model.'.php'), $cool, FILE_APPEND);
    }

    private static function createBladeIndex($folder){

        //for now just index.
        $index = self::normalizePath(__DIR__ . '/../../../resources/views/default/index.blade.php');

        //copy the template
        copy($index,resource_path(self::normalizePath('views/'.$folder.'/index.blade.php')));

    }

    private static function createBladeForm($folder,$model_string){
        $class = 'App\\Models\\'.$model_string;
        $model = new $class();

        //render a file from the template
        $html = view('default._form', compact('model'))->render();

        //try to save the render.
        file_put_contents(resource_path(self::normalizePath('views/'.$folder.'/_form.blade.php')), $html);
    }

    private static function createController($file_name){
        $Model__ = $file_name;

        //render a file from the template
        $html = view('default.Controller', compact('Model__'))->render();

        //try to save the render.
        file_put_contents(base_path(self::normalizePath('app/Http/Controllers/'.$file_name.'Controller.php')), $html);
    }

    private static function createJsFile($file_name){

        //find the controller template in resources
        $index = resource_path(self::normalizePath('views/default/view.js'));

        //copy the controller template
        copy($index, self::normalizePath(__DIR__ . '/../../../public/js/views/'.$file_name.'.js'));

    }


    private static function normalizePath($path){

        return str_replace(['/','\\'],DIRECTORY_SEPARATOR,$path);

    }

}
