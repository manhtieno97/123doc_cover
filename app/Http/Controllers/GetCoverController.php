<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cover;
use Illuminate\Support\Facades\Storage;
use \CloudConvert\CloudConvert;
use \CloudConvert\Models\Job;
use \CloudConvert\Models\Task;

class GetCoverController extends Controller
{
    const saveFileType = 'jpg';
    public function index()
    {
        $data['items'] = Cover::orderBy('id', 'desc')->paginate(20);
        return view('getCover', $data);
    }
    public function postCover(Request $request)
    {
        $results = [];
        $fileConfig = config('filecover');
        if (!empty($fileConfig['fileSize'])) {
            $results = $this->getDirContents($request->ulr);
            if (!empty($results)) {
                foreach ($results as $key => $path) {
                    if (!Cover::where('url', $path)->first()) {
                        $file = pathinfo($path);
                        try {
                            $result = $this->thumbGenerator($path, $file['filename'], $file['extension'], $fileConfig['fileSize']);
                        } catch (\Exception $e) {
                        
                            dd($e->getMessage());
                            $result = [];
                        }
                        if (!empty($result)) {
                            Cover::create($result);
                        }
                    }
                }
            }
        }
        return redirect('/')->with('success', 'Cover thành công');
    }
    function getDirContents($dir, &$results = array())
    {
        $fileConfig = config('filecover');
        if (!empty($fileConfig['fileTypes'])) {
            $files = scandir($dir);

            foreach ($files as $key => $value) {
                $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
                if (!is_dir($path)) {
                    foreach ($fileConfig['fileTypes'] as $key1 => $val) {
                        if (preg_match('/\.' . $val . '$/', $path)) {
                            $results[] = $path;
                        }
                    }
                } elseif ($value != "." && $value != "..") {
                    $this->getDirContents($path, $results);
                }
            }
        }
        return  $results;
    }
    function thumbGenerator($dir, $tmpName, $fileType, $size)
    {
        $image_name = [];
        $tmpName=time(). $tmpName;
        $saveFileType = self::saveFileType;
        $imagePath = $dir;
        $image = new \Imagick();

        switch ($fileType) {
            case 'psd': 
                $imagePath = $imagePath . '[0]'; //lấy layout đầu tiên
                $image->readImage($imagePath);
                break;
            case 'cdr':
                $output = trim(preg_replace('/(.+).cdr/', ' $1', $imagePath) . '.svg', ' ');
                //$this->convertFile($imagePath,$output);
                exec('uniconvertor ' . $imagePath . ' ' . $output);
                if(!empty(file_get_contents($output))){
                    $image->readImageBlob(file_get_contents($output));
                }
                
                break;
            case 'pdf':
                $imagePath = $imagePath . '[0]'; //lấy layout đầu tiên
                $image->readImage($imagePath);
                break;
            case 'ai':
                $imagePath = $imagePath . '[0]'; //lấy layout đầu tiên
                $image->readImage($imagePath);
                break;
            case 'eps':
                $imagePath = $imagePath . '[0]'; //lấy layout đầu tiên
                $image->readImage($imagePath);
                break;
            default:
                $image->readImage($imagePath);
                break;
        }
        $image->setImageCompressionQuality(90); //độ phân giải ảnh càng cao càng đẹp
        foreach ($size as $key => $value) {
            $maxWidth = $value['width'];
            $maxHeight = $value['height'];
            $url = $value['url'];
            $image->thumbnailImage($maxWidth, $maxHeight); //
            $image->setImageFormat($saveFileType);
            Storage::disk('local')->put($url . "/" . $tmpName . "." . $saveFileType, $image->getImageBlob());
        }
        $image->clear();
        $image->destroy();
        if (!empty($output)  && file_exists($output)) {
            unlink($output);
        }
        $image_name['url'] = $dir;
        $image_name['image_cover'] = $tmpName;
        return $image_name;
    }

    public function detail($id)
    {
        $data['image'] = Cover::find($id);
        return view('detail', $data);
    }
    public function convertFile($imagePath, $output)
    {
        $cloudconvert = new CloudConvert(['api_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOWY1OWI1OGQ0MWYyMDlhZTc4YjlmMGM2NTQ4OTY5MjFlZjJkMWVmZDJlOTBkYTM2OTc2MWQwZDIwNjQwZTQ2M2Y1Y2FhOTY3OWY4NTEyY2IiLCJpYXQiOjE1OTg1ODQzNjcsIm5iZiI6MTU5ODU4NDM2NywiZXhwIjo0NzU0MjU3OTY3LCJzdWIiOiI0NDQ4MTI3MSIsInNjb3BlcyI6WyJ1c2VyLnJlYWQiLCJ1c2VyLndyaXRlIiwidGFzay5yZWFkIiwidGFzay53cml0ZSIsIndlYmhvb2sucmVhZCIsIndlYmhvb2sud3JpdGUiLCJwcmVzZXQucmVhZCIsInByZXNldC53cml0ZSJdfQ.TkDZy6uvEaDXnOtEIpJ4yURBNrCbHZ7OnNdSuSXwYWYhS1zcn_3mvONo6kbFuZJYjBSrxsGK1IWZ0Q6I6PGbuydLJR6Q7hWKYZzW0gYrwx_6XHfEWU8N8DbXCzDNvarAkjBeHd_N-bZNg5snThO4Ixvk3hwDI2FxDwmxJ8tdl7jLf4WxnxPBGOyhXSlX6dfW7R7fCgeBBiory_-M--oL8Ka1CVadicItknSdMEdclBL_jNvOU6Qmw3TTvKIa2kYURIxOQP2-JrJs9PsWpT6DzHC-v3eOQo-yeVyUTk8nWX5FT-LS8MOpxvfJWB62mfONL4Ekx3egaFN_oRmfblFT5aMolaF-jUPcfMq-sxyMgbfdPBtg1hqTJ_QyO9hbx50ClRkeuIMwO1lu4dykk1y13sM5JbbU0lCtcjl56vS-vk2v8DIXK96cvE432uHME-8SlLsQdvLdUhlxlXbZIOOpSmyeNUTbK2YB_YTPPe54d2CrcTmMS0d62kI4nb0sqPEn_lB-YZxXIRENhOwXdjtzPt33EvSAiC6czBVYZyVWo1mFmusQYUAS1_VsCT3D43hWGQoRH-mQb_aaTR9vflgrEMSQ0E9qM3pFq0cexElYeYg-CFXUmOwBQ5b4VBfcg8Rn-DMeJIFviJmvGdiMoiUmR957YkZPRRkZ5efl8bNFu1A']);
        $job = (new Job())
            ->addTask(
                (new Task('import/upload', 'import-1'))
            )
            ->addTask(
                (new Task('convert', 'task-1'))
                ->set('input_format', 'cdr')
                ->set('output_format', 'svg')
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
        $inputStream = fopen($imagePath, 'r');
        $cloudconvert->tasks()->upload($uploadTask, $inputStream);
        $cloudconvert->jobs()->wait($job); // Wait for job completion
        foreach ($job->getExportUrls() as $file) {
            $source = $cloudconvert->getHttpTransport()->download($file->url)->detach();
            $dest = fopen($output, 'w');
            stream_copy_to_stream($source, $dest);
        }
        
    }
}
