<?php

namespace App\Http\Controllers;

use Owenoj\LaravelGetId3\GetId3;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Cover;
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
                        $result = $this->thumbGenerator($path, $file['filename'], $file['extension'], $fileConfig['fileSize']);
                        Cover::create($result);
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
        $saveFileType = self::saveFileType;
        $imagePath = $dir ;
        $image = new \Imagick();
        $image->readImage(realpath($imagePath));
        if ($fileType == "psd") {
            $image->setIteratorIndex(0);
            // doesn't work for multilayer psd files
            // but $image->setImageIndex(0) instead of $image->setIteratorIndex(0) does the work
        }
        $image->setImageCompressionQuality(80);//độ phân giải ảnh càng cao càng đẹp
        
        foreach ($size as $key => $value) {
            $maxWidth= $value['width'];
            $maxHeight= $value['height'];
            $url= $value['url'];

            $image->thumbnailImage($maxWidth, $maxHeight);//
            $image->writeImage($url . "/" . $tmpName . ".". $saveFileType);
        }
        $image_name = [];
        $image_name['url'] = $imagePath;
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
