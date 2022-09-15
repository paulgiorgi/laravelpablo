<?php

namespace Paulgiorgi\Laravelpablo\commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class ConvertScssToCss extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelpablo:scss {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert scss to css. Use the base_path. For convenience you can put your scss file inside resources/css. Ex: laravelpablo:scss resources/css/test.scss';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pathinfo = pathinfo($this->argument('url'));
        $filename = $pathinfo['filename'];
        $url= 'https://json2csharp.com/api/Default';
        $html = File::get($this->argument('url'));
        $response = json_decode(Http::post($url, [
            'input' => $html,
            'operationid' => 'scsstocss',
            'settings' => [
                'Minify' => false
            ]
        ]));
        File::put(public_path('/css/'.$filename.'.css'),$response);

        $this->info('OOOOOkkkk !! :-)');
    }

}
