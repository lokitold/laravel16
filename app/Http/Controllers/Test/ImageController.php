<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Catalogo;
use \Intervention\Image\Facades\Image;
use Storage;
use DB;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $secretkey = '81c7f11883b825a9663d8938dd183a0c';

    public function test(Request $request)
    {

        $fontFile = base_path('public/assets/fonts/glyphicons-halflings-regular.ttf');
        //echo file_exists($fontFile);
        //dd($fontFile);
        $image = 'http://comprabienprod.s3-website-us-east-1.amazonaws.com/catalog/view/theme/gec/client/oechsle/botas/img/catalogo_vencido.jpg';
        //$image = \Storage::disk('s3')->url('catalog/view/theme/gec/client/oechsle/botas/img/catalogo_vencido.jpg');
        //$size = Storage::disk('s3')->size('catalog/view/theme/gec/client/oechsle/botas/img/catalogo_vencido.jpg');


        //$bucket  = Storage::disk('s3')->getDriver()->getAdapter()->getBucket();
        //$storagePath =  Storage::disk('s3')->getDriver()->getAdapter()->getClient()->getObjectUrl($bucket, 'cxfndc');
        //dd($storagePath);
        //exit;
        $imageLookHombre = 'http://comprabienprod.s3-website-us-east-1.amazonaws.com/catalog/view/theme/gec/client/oechsle/botas/img/look_mujer.png';
        $imageLookMujer = 'http://comprabienprod.s3-website-us-east-1.amazonaws.com/catalog/view/theme/gec/client/oechsle/botas/img/look_hombre.png';

        $imageHombreEdit = Image::make($imageLookHombre)->resize(100, 100);
        $imageMujerEdit = Image::make($imageLookMujer)->resize(100, 100);


        $img = Image::make($image)
            ->insert($imageHombreEdit, 'left', 600, 100)
            ->insert($imageMujerEdit, 'left', 100, 100);

        $img->text('Victor Rojas Centeno', 400, 200, function ($font) use ($fontFile) {
            $font->file($fontFile);
            $font->size(24);
            $font->color('#2b2619');
            $font->align('center');
            $font->valign('top');
            //$font->angle(45);
        });

        return $img->response('jpg');
    }

    public function catalogo()
    {

        //echo storage_path('logs/catalogo.log');exit;
        $dataLook = DB::table('oc_promocion_descuento')
            ->where('catalogo', 'botas-y-chompas')
            ->where('nombres_apellidos', null)
            ->limit(500)
            ->get();

        $countLook = DB::table('oc_promocion_descuento')
            ->where('catalogo', 'botas-y-chompas')
            ->where('nombres_apellidos', null)
            //->wherein('nombres_apellidos',[null,''])
            ->count();

        $countLookNombre = DB::table('oc_promocion_descuento')
            ->where('catalogo', 'botas-y-chompas')
            ->whereNotNull('nombres_apellidos')
            ->get();


        //echo count($dataLook);
        dump($countLook);
        dump($countLookNombre);


        foreach ($dataLook as $data):

            $data->correo = strtolower($data->correo);

            $dataCatalogo = DB::table('oc_promocion_descuento')
                ->where('catalogo', '<>', 'botas-y-chompas')
                ->where(DB::raw('LOWER(`correo`)'), $data->correo)
                ->first();


            if (!empty($dataCatalogo->correo)):

                $dataCatalogo->correo = strtolower($dataCatalogo->correo);

                $dataUpdate = DB::table('oc_promocion_descuento')
                    ->where('catalogo', 'botas-y-chompas')
                    ->where(DB::raw('LOWER(`correo`)'), $dataCatalogo->correo)
                    ->update(['nombres_apellidos' => $dataCatalogo->nombres_apellidos]);

                $dataConfirm = DB::table('oc_promocion_descuento')
                    ->where('catalogo', 'botas-y-chompas')
                    ->where(DB::raw('LOWER(`correo`)'), $dataCatalogo->correo)
                    ->get();
                dump($dataConfirm);
            endif;

        endforeach;

        //dump($countLook);
        //dd($dataLook);
    }

    public function catalogoperuid($sites,$dataLook)
    {

        $output = [];

        foreach ($sites as $site):

            $params['apikey'] = $site['api-key'];
            $params['correo'] = $dataLook->correo;
            //$params['correo'] = 'javier.alarcon2014@gmail.com';


            //dump($site);
            if (!empty($site['secretkey'])):
                $params['secretkey'] = $site['secretkey'];
            endif;
            $data = $this->getSearch($params);


            //dump($data);
            $output[] = $data;
            if (!empty($data->data)):
                $dataID = $data->data[0];
                $nombres = $dataID->nombres . ' ' . $dataID->apellidos;

                $dataUpdate = DB::table('oc_promocion_descuento')
                    ->where('catalogo', 'botas-y-chompas')
                    ->where('correo', $dataLook->correo)
                    ->update(['nombres_apellidos' => $nombres]);

                $dataConfirm = DB::table('oc_promocion_descuento')
                    ->where('catalogo', 'botas-y-chompas')
                    ->where('correo', $dataLook->correo)
                    ->get();
                dump($dataConfirm);

                continue;
            endif;
            unset($site);
            unset($params);
        endforeach;
        unset($sites);

        return [
            'output' => $output
        ];

    }


    public function getSearch($params = null)
    {

        //$params_security = array('secretkey' => $this->secretkey);
        //$params = array_merge($params, $params_security);
        $this->base_url = 'http://peruid.pe/service/usuarios/rest_user/format/json/';
        $url = $this->base_url . '?' . http_build_query($params);
        //dump($url);

        return json_decode($this->cxsense_search($url));

    }

    function cxsense_search($url = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $response = curl_exec($ch);

        //ddump($response);

        return $response;

    }
}
