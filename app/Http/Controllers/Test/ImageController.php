<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Catalogo;
use \Intervention\Image\Facades\Image;
use Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(Request $request)
    {

        $fontFile = base_path('catalog/view/theme/gec/font/prelo-bold.ttf');
        //echo file_exists($fontFile);
        //dd($fontFile);

        $image = 'http://dev.catalogodigital.s3-website-us-east-1.amazonaws.com/catalog/view/theme/gec/client/oechsle/botas/img/catalogo_vencido.jpg';
        $image2 = 'http://dev.catalogodigital.s3-website-us-east-1.amazonaws.com/catalog/view/theme/gec/client/oechsle/botas/img/icon_vermas.png';
        //$image = \Storage::disk('s3')->url('catalog/view/theme/gec/client/oechsle/botas/img/catalogo_vencido.jpg');
        //$image2 = \Storage::disk('s3')->url('catalog/view/theme/gec/client/oechsle/botas/img/icon_vermas.png');
        //$fonts = \Storage::disk('s3')->url('catalog/view/theme/gec/font/prelo-bold.ttf');
        //$contents = Storage::disk('local')->get('file.jpg');

        $img = Image::make($image)->insert($image2);

        $img->text('foo', 0, 0, function($font) use ($fontFile){
            $font->file($fontFile);
            $font->size(24);
            $font->color('#fdf6e3');
            $font->align('center');
            $font->valign('top');
            $font->angle(45);
        });

        $img->text('The quick brown fox jumps over the lazy dog.', 120, 100);


        return $img->response('jpg');
    }
}
