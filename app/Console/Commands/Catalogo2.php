<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Test\ImageController as Image;
use DB;

class Catalogo2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalogo2';

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
     * @return mixed
     */

    public $sites = [
        'depor' =>
            [
                'api-key' => '6d83b35ec628d33d0606bcd9083dc2a6',
                'secretkey' => null,
                'tienda' => 'depor',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=6d83b35ec628d33d0606bcd9083dc2a6
        'elcomercio' =>
            [
                'api-key' => 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',
                'secretkey' => '81c7f11883b825a9663d8938dd183a0c',
                'tienda' => 'elcomercio',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=a94a8fe5ccb19ba61c4c0873d391e987982fbbd3&secretkey=81c7f11883b825a9663d8938dd183a0c
        'trome' =>
            [
                'api-key' => '4895ff32853e4dd68b5bd63c6437d17c',
                'secretkey' => null,
                'tienda' => 'trome',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=4895ff32853e4dd68b5bd63c6437d17c
        'perucom' =>
            [
                'api-key' => '67d8d54bf6861b19e505687672529907',
                'secretkey' => null,
                'tienda' => 'perucom',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=67d8d54bf6861b19e505687672529907
        'america' =>
            [
                'api-key' => 'd8da46ee2c4d960d4dbd76e4cb2c7b8e',
                'secretkey' => '7aa4724a1759222beff06378ba547996',
                'tienda' => 'america',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=d8da46ee2c4d960d4dbd76e4cb2c7b8e&secretkey=7aa4724a1759222beff06378ba547996
        'appcomercio' =>
            [
                'api-key' => 'eb1062b6e9e5aa6690fb3feb790ccd92',
                'secretkey' => null,
                'tienda' => 'appcomercio',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=eb1062b6e9e5aa6690fb3feb790ccd92


    ];

    public $list = [
        'AmericaTv' =>
            [
                'secretkey' => 11,
                'tienda' => 'AmericaTv',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=6d83b35ec628d33d0606bcd9083dc2a6
        'Clubsuscriptores.pe' =>
            [
                'secretkey' => 10,
                'tienda' => 'Clubsuscriptores.pe',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=a94a8fe5ccb19ba61c4c0873d391e987982fbbd3&secretkey=81c7f11883b825a9663d8938dd183a0c
        'DEPOR.PE' =>
            [
                'secretkey' => 7,
                'tienda' => 'DEPOR.PE',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=4895ff32853e4dd68b5bd63c6437d17c
        'Diario Correo' =>
            [
                'secretkey' => 12,
                'tienda' => 'Diario Correo',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=67d8d54bf6861b19e505687672529907
        'EL COMERCIO' =>
            [
                'secretkey' => 1,
                'tienda' => 'EL COMERCIO',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=d8da46ee2c4d960d4dbd76e4cb2c7b8e&secretkey=7aa4724a1759222beff06378ba547996
        'Gestión' =>
            [
                'secretkey' => 14,
                'tienda' => 'Gestión',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=eb1062b6e9e5aa6690fb3feb790ccd92
        'Optativos' =>
            [
                'secretkey' => 4,
                'tienda' => 'Optativos',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=eb1062b6e9e5aa6690fb3feb790ccd92
        'Peru21' =>
            [
                'secretkey' => 6,
                'tienda' => 'Peru21',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=eb1062b6e9e5aa6690fb3feb790ccd92
        'PeruCOM' =>
            [
                'secretkey' => 13,
                'tienda' => 'PeruCOM',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=eb1062b6e9e5aa6690fb3feb790ccd92
        'PeruQuiosco' =>
            [
                'secretkey' => 9,
                'tienda' => 'PeruQuiosco',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=eb1062b6e9e5aa6690fb3feb790ccd92
        'Prensmart' =>
            [
                'secretkey' => 2,
                'tienda' => 'Prensmart',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=eb1062b6e9e5aa6690fb3feb790ccd92
        'Revistas' =>
            [
                'secretkey' => 5,
                'tienda' => 'Revistas',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=eb1062b6e9e5aa6690fb3feb790ccd92
        'TROME' =>
            [
                'secretkey' => 3,
                'tienda' => 'TROME',
            ],
        //http://peruid.pe/service/usuarios/rest_user/format/json?correo=javier.alarcon2014@gmail.com&apikey=eb1062b6e9e5aa6690fb3feb790ccd92


    ];

    /**
    11	AmericaTv

    10	Clubsuscriptores.pe

    7	DEPOR.PE

    12	Diario Correo

    1	EL COMERCIO

    14	Gestión

    4	Optativos


    6	Peru21


    13	PeruCOM

    9	PeruQuiosco

    2	Prensmart


    5	Revistas


    3	TROME
     */

    public function handle2()
    {
        //$start = $this->argument('start');
        //$limit = $this->argument('limit');

        $countLook = DB::table('oc_promocion_descuento')
            ->where('catalogo','botas-y-chompas')
            ->where('nombres_apellidos',null)
            //->wherein('nombres_apellidos',[null,''])
            ->count();

        $cantlimit = $countLook - 50 ;
        $numeroRandom = rand ( 0 , $cantlimit);
        $this->comment(PHP_EOL.'start -> '.$numeroRandom.PHP_EOL);
        $this->comment(PHP_EOL.'limit -> 50'.PHP_EOL);


        $countLook = DB::table('oc_promocion_descuento')
            ->where('catalogo','botas-y-chompas')
            ->where('nombres_apellidos',null)
            //->wherein('nombres_apellidos',[null,''])
            ->count();
        $this->comment(PHP_EOL.'sin nombre cantidad -> '.$countLook.PHP_EOL);

        $countLookNombre = DB::table('oc_promocion_descuento')
            ->where('catalogo','botas-y-chompas')
            ->whereNotNull('nombres_apellidos')
            ->count();
        $this->comment(PHP_EOL.'con nombre cantidad -> '.$countLookNombre.PHP_EOL);

        #
        $class = new Image();

        $dataLookBD = DB::table('oc_promocion_descuento')
            ->where('catalogo','botas-y-chompas')
            ->where('nombres_apellidos',null)
            //->limit($limit)
            ->skip(0)
            ->where('status',1)
            ->take(1993)
            ->get();

        foreach ($dataLookBD as $dataLook):

            #$this->commentArray($dataLook);

            //$procc = $class->catalogoperuid($this->sites,$dataLook);

            $noRegistrado = 0;

            foreach ($this->sites as $site):

                $this->commentArray($site);

                $params['apikey'] = $site['api-key'];
                $params['correo'] = $dataLook->correo;

                if (!empty($site['secretkey'])):
                    $params['secretkey'] = $site['secretkey'];
                endif;

                $data = $this->getSearch($params);
                $this->commentArray($data);


                //dump($data);
                $output[] = $data;
                if (!empty($data->data)):
                    $dataID = $data->data[0];
                    $this->commentArray($dataID);
                    $nombres = $dataID->nombres . ' ' . $dataID->apellidos;

                    $dataUpdate = DB::table('oc_promocion_descuento')
                        ->where('catalogo', 'botas-y-chompas')
                        ->where('correo', $dataLook->correo)
                        ->update(['nombres_apellidos' => $nombres]);

                    $dataConfirm = DB::table('oc_promocion_descuento')
                        ->where('catalogo', 'botas-y-chompas')
                        ->where('correo', $dataLook->correo)
                        ->get();



                    unset($site);
                    unset($params);
                    continue;
                endif;

                if ($data->message == 'El correo no esta registrado!'):
                    $noRegistrado =$noRegistrado+1;
                endif;


                unset($site);
                unset($params);
            endforeach;

        if($noRegistrado == 6):
            $this->commentArray($noRegistrado);
            $dataUpdate = DB::table('oc_promocion_descuento')
                ->where('catalogo', 'botas-y-chompas')
                ->where('correo', $dataLook->correo)
                ->update(['status' => 2]);
        endif;

        endforeach;



//        ob_start();
//        foreach($procc as $proc):
//            echo PHP_EOL;
//            print_r($proc);
//            echo PHP_EOL;
//        endforeach;
//        $contenido = ob_get_contents();
//        ob_end_clean();
//        $this->comment(PHP_EOL.$contenido.PHP_EOL);

        //
    }


    public function handle()
    {
        //$start = $this->argument('start');
        //$limit = $this->argument('limit');

        $countLook = DB::table('oc_promocion_descuento')
            ->where('catalogo','botas-y-chompas')
            ->where('nombres_apellidos',null)
            //->wherein('nombres_apellidos',[null,''])
            ->count();

        $cantlimit = $countLook - 50 ;
        $numeroRandom = rand ( 0 , $cantlimit);
        $this->comment(PHP_EOL.'start -> '.$numeroRandom.PHP_EOL);
        $this->comment(PHP_EOL.'limit -> 50'.PHP_EOL);


        $countLook = DB::table('oc_promocion_descuento')
            ->where('catalogo','botas-y-chompas')
            ->where('nombres_apellidos',null)
            //->wherein('nombres_apellidos',[null,''])
            ->count();
        $this->comment(PHP_EOL.'sin nombre cantidad -> '.$countLook.PHP_EOL);

        $countLookNombre = DB::table('oc_promocion_descuento')
            ->where('catalogo','botas-y-chompas')
            ->whereNotNull('nombres_apellidos')
            ->count();
        $this->comment(PHP_EOL.'con nombre cantidad -> '.$countLookNombre.PHP_EOL);

        #
        $class = new Image();

        $dataLookBD = DB::table('oc_promocion_descuento')
            ->where('catalogo','botas-y-chompas')
            ->where('nombres_apellidos',null)
            //->limit($limit)
            ->skip(10)
            ->where('status',2)
            ->take(15)
            ->get();

        foreach ($dataLookBD as $dataLook):

            #$this->commentArray($dataLook);

            //$procc = $class->catalogoperuid($this->sites,$dataLook);

            $noRegistrado = 0;

            foreach ($this->list as $site):



                $params['email'] = $dataLook->correo;
                $this->commentArray($dataLook->correo);
                //$params['email'] = 'javier.alarcon2014@gmail.com';

                $params['list_id'] = $site['secretkey'];
               // $params['list_id'] = 1;
                $data = $this->getSearchNews($params);
                //$this->commentArray($data);


                //dump($data);
                $output[] = $data;
                if (!empty($data->name)):
                    $dataID = $data;
                    $nombres = $dataID->name;
                     $this->comment(PHP_EOL.'regisrado'.PHP_EOL);
                    $this->commentArray($nombres);

                    $dataUpdate = DB::table('oc_promocion_descuento')
                        ->where('catalogo', 'botas-y-chompas')
                        ->where('correo', $dataLook->correo)
                        ->update(['nombres_apellidos' => $nombres]);

                    $dataConfirm = DB::table('oc_promocion_descuento')
                        ->where('catalogo', 'botas-y-chompas')
                        ->where('correo', $dataLook->correo)
                        ->get();



                    unset($site);
                    unset($params);
                    continue;
                else:
                    $noRegistrado =$noRegistrado+1;
                endif;


                unset($site);
                unset($params);
            endforeach;

            if($noRegistrado == 13):
                $this->commentArray('Nore gistrado '.$dataLook->correo,$noRegistrado);
                $dataUpdate = DB::table('oc_promocion_descuento')
                    ->where('catalogo', 'botas-y-chompas')
                    ->where('correo', $dataLook->correo)
                    ->update(['status' => 3]);
            endif;

        endforeach;



//        ob_start();
//        foreach($procc as $proc):
//            echo PHP_EOL;
//            print_r($proc);
//            echo PHP_EOL;
//        endforeach;
//        $contenido = ob_get_contents();
//        ob_end_clean();
//        $this->comment(PHP_EOL.$contenido.PHP_EOL);

        //
    }

    public function getSearch($params = null)
    {

        //$params_security = array('secretkey' => $this->secretkey);
        //$params = array_merge($params, $params_security);
        $this->base_url = 'http://peruid.pe/service/usuarios/rest_user/format/json/';
        $url = $this->base_url . '?' . http_build_query($params);
        $this->commentArray($url);
        //dump($url);

        return json_decode($this->cxsense_search($url));

    }

    public function getSearchNews($params = null)
    {

        $params_security = array('api_key' => 'FruX5hSEVgN5fAYkLuBH');
        $params = array_merge($params, $params_security);
        $this->base_url = 'http://newsletter.peruid.pe/api/subscribers/subscription-data.php';
        $url = $this->base_url ;
        //$data = http_build_query($params);


        //$this->commentArray($url);
        //$this->commentArray($params);
        //$this->commentArray($data);
        $data = $this->cxsense_searchPost($url,$params);


        return json_decode($data);

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

    function cxsense_searchPost($url = null,$data)
    {

        $postUri = 'email='.$data['email'].'&api_key=FruX5hSEVgN5fAYkLuBH&list_id='.$data['list_id'];
        $this->commentArray($postUri);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_POST, 3);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$postUri);
        $response = curl_exec($ch);
        curl_close($ch);
        /*iF(empty($response)):
            $this->comment(PHP_EOL.'nada'.PHP_EOL);
        endif;*/
        //$this->comment(PHP_EOL.$response.PHP_EOL);

        return $response;

    }

    function commentArray($array){
        #comment
        ob_start();
        print_r($array);
        $contenido = ob_get_contents();
        ob_end_clean();
        $this->comment(PHP_EOL.$contenido.PHP_EOL);

    }
}
