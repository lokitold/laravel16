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

        $fontFile = base_path('public/assets/fonts/glyphicons-halflings-regular.ttf');
        //echo file_exists($fontFile);
        //dd($fontFile);

        $image = 'http://comprabienprod.s3-website-us-east-1.amazonaws.com/catalog/view/theme/gec/client/oechsle/botas/img/catalogo_vencido.jpg';

        $imageLookHombre = 'http://comprabienprod.s3-website-us-east-1.amazonaws.com/catalog/view/theme/gec/client/oechsle/botas/img/look_mujer.png';
        $imageLookMujer = 'http://comprabienprod.s3-website-us-east-1.amazonaws.com/catalog/view/theme/gec/client/oechsle/botas/img/look_hombre.png';

        $imageHombreEdit = Image::make($imageLookHombre)->resize(100, 100);
        $imageMujerEdit = Image::make($imageLookMujer)->resize(100, 100);


        $img = Image::make($image)
            ->insert($imageHombreEdit,'left',600,100)
            ->insert($imageMujerEdit,'left',100,100);

        $img->text('Victor Rojas Centeno', 400,200, function($font) use ($fontFile){
            $font->file($fontFile);
            $font->size(24);
            $font->color('#2b2619');
            $font->align('center');
            $font->valign('top');
            //$font->angle(45);
        });

        return $img->response('jpg');
    }
}
