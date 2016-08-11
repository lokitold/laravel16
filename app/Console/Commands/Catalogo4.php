<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Test\ImageController as Image;
use DB;

class Catalogo4 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalogo4';

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



    public function handle()
    {


        #SELECT * FROM tabla ORDER BY RAND() LIMIT 3;

        #1240
        # -> 500;
        #zapatillas -> 500
        #mama-que-se-respta -> 240


//        $dataLookBD = DB::table('oc_promocion_descuento')
//            ->where('catalogo','botas-y-chompas')
//            ->where('nombres_apellidos',null)
//            ->get();

        $dataOtherBD = DB::table('oc_promocion_descuento')
            ->where('catalogo','dia-del-nino')
            ->whereNotNull('nombres_apellidos')
            ->skip(0)
            ->take(10)
            ->orderByRaw("RAND()")
            ->get();

        //$this->commentArray($dataOtherBD);
        $count = 0;

        foreach ($dataOtherBD as $dataLook):
            //$this->commentArray($dataLook->correo);
            $dataCuponOtro = DB::table('oc_promocion_descuento')
                ->where('catalogo','botas-y-chompas')
                ->where('correo',$dataLook->correo)
                ->whereNotNull('nombres_apellidos')
                ->first();

            if(empty($dataCuponOtro)):
                $this->commentArray($dataLook);
                $this->commentArray($dataCuponOtro);

                $dataOtherBD = DB::table('oc_promocion_descuento')
                    ->where('catalogo','botas-y-chompas')
                    ->where('nombres_apellidos',NULL)
                    ->orderByRaw("RAND()")
                    ->take(1)
                    ->first();

                $created_at = $dataOtherBD->created_at;
                $updated_at = $dataOtherBD->updated_at;

                //$this->commentArray($created_at);
                //$this->commentArray($updated_at);



                DB::table('oc_promocion_descuento')->insert(
                    [
                        'correo' => $dataLook->correo,
                        'nombres_apellidos' => $dataLook->nombres_apellidos,
                        'codigo' => '2800007540',
                        'sexo' => $dataLook->sexo,
                        'catalogo' => 'botas-y-chompas',
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                        'status' => 4
                    ]
                );
                $count ++;

            endif;

            $this->commentArray('---------------------------------------------------------------');
        endforeach;
        $this->commentArray('Cantidad registrados '.$count);
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
