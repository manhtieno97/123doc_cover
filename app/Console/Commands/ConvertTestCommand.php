<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \CloudConvert\CloudConvert;
use \CloudConvert\Laravel\Facades\CloudConvert as Convert;
use \CloudConvert\Models\Job;
use \CloudConvert\Models\Task;

class ConvertTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:test {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
	    $cloudconvert = new CloudConvert(['api_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOWY1OWI1OGQ0MWYyMDlhZTc4YjlmMGM2NTQ4OTY5MjFlZjJkMWVmZDJlOTBkYTM2OTc2MWQwZDIwNjQwZTQ2M2Y1Y2FhOTY3OWY4NTEyY2IiLCJpYXQiOjE1OTg1ODQzNjcsIm5iZiI6MTU5ODU4NDM2NywiZXhwIjo0NzU0MjU3OTY3LCJzdWIiOiI0NDQ4MTI3MSIsInNjb3BlcyI6WyJ1c2VyLnJlYWQiLCJ1c2VyLndyaXRlIiwidGFzay5yZWFkIiwidGFzay53cml0ZSIsIndlYmhvb2sucmVhZCIsIndlYmhvb2sud3JpdGUiLCJwcmVzZXQucmVhZCIsInByZXNldC53cml0ZSJdfQ.TkDZy6uvEaDXnOtEIpJ4yURBNrCbHZ7OnNdSuSXwYWYhS1zcn_3mvONo6kbFuZJYjBSrxsGK1IWZ0Q6I6PGbuydLJR6Q7hWKYZzW0gYrwx_6XHfEWU8N8DbXCzDNvarAkjBeHd_N-bZNg5snThO4Ixvk3hwDI2FxDwmxJ8tdl7jLf4WxnxPBGOyhXSlX6dfW7R7fCgeBBiory_-M--oL8Ka1CVadicItknSdMEdclBL_jNvOU6Qmw3TTvKIa2kYURIxOQP2-JrJs9PsWpT6DzHC-v3eOQo-yeVyUTk8nWX5FT-LS8MOpxvfJWB62mfONL4Ekx3egaFN_oRmfblFT5aMolaF-jUPcfMq-sxyMgbfdPBtg1hqTJ_QyO9hbx50ClRkeuIMwO1lu4dykk1y13sM5JbbU0lCtcjl56vS-vk2v8DIXK96cvE432uHME-8SlLsQdvLdUhlxlXbZIOOpSmyeNUTbK2YB_YTPPe54d2CrcTmMS0d62kI4nb0sqPEn_lB-YZxXIRENhOwXdjtzPt33EvSAiC6czBVYZyVWo1mFmusQYUAS1_VsCT3D43hWGQoRH-mQb_aaTR9vflgrEMSQ0E9qM3pFq0cexElYeYg-CFXUmOwBQ5b4VBfcg8Rn-DMeJIFviJmvGdiMoiUmR957YkZPRRkZ5efl8bNFu1A']);
	    $job = (new Job())
            ->addTask(
                (new Task('import/upload', 'import-1'))
             )
           ->addTask(
                (new Task('convert', 'task-1'))
                    ->set('input_format', 'cdr')
                    ->set('output_format', 'png')
                    ->set('engine', 'inkscape')
                    ->set('input', ["import-1"])
                    ->set('pixel_density', 96)
             )
            ->addTask(
                (new Task('export/url', 'export-1'))
                ->set('input', ["task-1"])
            );
        $cloudconvert->jobs()->create($job);
        $uploadTask = $job->getTasks()->name('import-1')[0];
        $path = $this->argument("path");
        $inputStream = fopen($path, 'r');
        $cloudconvert->tasks()->upload($uploadTask, $inputStream);

        $cloudconvert->jobs()->wait($job); // Wait for job completion

        foreach ($job->getExportUrls() as $file) {
        
            $source = $cloudconvert->getHttpTransport()->download($file->url)->detach();
            $dest = fopen('C:/VPN/fontend/test/'. $file->filename, 'w');
            stream_copy_to_stream($source, $dest);
        }
        print_r('Convert thành công !');
    }
}
