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

    public function getIndex(){

        $noticia = Noticia::all();
        dd($noticia);exit;


        $data = file_get_html('http://elcomercio.pe');
        $sectionUltimasNoticias = $data->find(self::LIST_ITEM);


        foreach($sectionUltimasNoticias as $link ):
            $url = $link->getAttribute('href');
            echo '<br>';echo $id = $this->_getid($url);

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