<?php

namespace App\Http\Controllers;

use Owenoj\LaravelGetId3\GetId3;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Cover;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
class GetCoverController extends Controller
{
    const saveFileType='jpg';
    public function index()
    {
        return view('getCover');
    }
    public function postCover(Request $request)
    {
        $results = [];
        $fileConfig = config('filecover');
        if(!empty($fileConfig['fileSize']))
        {
            $results = $this->getDirContents($request->ulr);
            if (!empty($results)) {
                foreach ($results as $key => $path) {
                    if (!Cover::where('url', $path)->first()) {
                        $file = pathinfo($path);
                        try {
                            $result = $this->thumbGenerator($path, $file['filename'], $file['extension'], $fileConfig['fileSize']);
                        } catch (\Exception $e) {
                            $result = [];
                        }
                        if (!empty($result)) {
                            Cover::create($result);
                        }
                    }
                }
            }
        }
        return view('getCover');
    }
    function getDirContents($dir, &$results = array())
    {
        $fileConfig = config('filecover');
        if(!empty($fileConfig['fileTypes']))
        {
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
        $saveFileType = self::saveFileType;
        $imagePath = $dir ;
        $image = new \Imagick();
        
        switch ($fileType) {
            case 'psd':
                $imagePath = $imagePath . '[0]'; //lấy layout đầu tiên
                $image->readImage($imagePath);
                break;
            case 'cdr':
                //$image->readImage($imagePath);
                $cdr = file_get_contents($imagePath);
                $image->pingImageBlob($cdr);
                $image->setImageFormat("jpeg");
                
                break;  
            case 'pdf':
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
            $image->setImageFormat("jpeg");
            Storage::disk('local')->put($url . "/" . $tmpName . "." . $saveFileType, $image->getImageBlob());
        }
        $image->clear();
        $image->destroy();

        $image_name['url'] = $dir;
        $image_name['image_cover'] = $tmpName;
        return $image_name;
        
        
    }
















// $dimensions = $image->getImageGeometry();
        // $width = $dimensions['width'];
        // $height = $dimensions['height'];
// if ($height > $width) {
//     //Portrait
//     if ($height > $maxHeight)
//         $image->thumbnailImage(0, $maxHeight);
//     $dimensions = $image->getImageGeometry();
//     if ($dimensions['width'] > $maxWidth) {
//         $image->thumbnailImage($maxWidth, 0);
//     }
// } elseif ($height < $width) {
//     //Landscape
//     $image->thumbnailImage($maxWidth, 0);
// } else {
//     //square
//     $image->thumbnailImage($maxWidth, 0);
// }

}
