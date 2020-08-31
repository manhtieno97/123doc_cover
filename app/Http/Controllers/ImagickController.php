<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Storage;
class ImagickController extends Controller
{
    public function index()
    {
        $data['items'] = Image::orderBy('id', 'desc')->paginate(20);
        return view('imagick', $data);
    }
    public function postImage(Request $request){
        $images = array();
        $im = new \Imagick();
        $im->setFormat("gif");
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                
                $name = $file->getClientOriginalName();
                $contents = file_get_contents($file->getRealPath());
                $frame = new \Imagick();
                $frame->readImageBlob($contents);
                $frame->setImageDispose(2);
                $frame->setImageDelay(10);
                $im->addImage($frame);
                
            }
            $im->writeImages('C:\VPN\training\laravel_getcover\public\test_image/'.time().'test.gif', true);
        }
        
        // Storage:: disk('local')->put(, $image->getImageBlob());
    }
    
    public function detailImage($id){

    }
}
