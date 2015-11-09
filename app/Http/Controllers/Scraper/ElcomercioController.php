<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 02/11/15
 * Time: 02:04 PM
 */

namespace App\Http\Controllers\Scraper;

use App\Http\Controllers\Controller;
use App\Noticia;


class ElcomercioController extends Controller
{
    const LIST_ITEM = 'section[id=ec-ultimas] article header h2 a';

    private $limit = 5;

    public function getIndex(){


        $data = file_get_html('http://elcomercio.pe');$data = file_get_html('http://elcomercio.pe');
        $sectionUltimasNoticias = $data->find(self::LIST_ITEM);
        $count = 0;


        foreach($sectionUltimasNoticias as $link ):

            $url = $link->getAttribute('href');
            echo '<br>';echo $id = $this->_getid($url);

            $noticia = Noticia::find($id);

            //$test = file_get_html('http://elcomercio.pe/peru/ucayali/historica-creacion-parque-sierra-divisor-fotos-noticia-1854620?flsm=1&ref=portada_home');
            //echo $test;exit;
            
            if(empty($noticia)):

                echo '<br>'.$url;

                $interna = file_get_html($url);

                echo $interna;

                $count ++;
            endif;

            if ($count >= $this->limit):
                break;
            endif;

        endforeach;

    }

    private function _getid($url){

        $id = null;

        $path = parse_url($url, PHP_URL_PATH);

        if(!empty($path)):
            $pathExplode = explode('/',$path);
            $ultimoPath = array_pop($pathExplode);
            if(!empty($ultimoPath)):
                $partes = explode('-',$ultimoPath);
                $idRaw = array_pop($partes);
                if(is_numeric($idRaw)):
                    $id = $idRaw;
                endif;
            endif;
        endif;

        return $id;
    }
}