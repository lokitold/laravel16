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
    const LIST_ITEM = 'section[id=ec-ultimas] article[class=ec-flujo]';

    private $limit = 5;

    public function getIndex(){


        $data = file_get_html('http://elcomercio.pe');
        $sectionUltimasNoticias = $data->find(self::LIST_ITEM);
        $count = 0;


        foreach($sectionUltimasNoticias as $link ):

            $url = $link->find('header h2 a');
            $url = $url[0]->getAttribute('href');

            $id = $this->_getid($url);
            echo '<br>';echo $id;

            $noticia = Noticia::find($id);

            if(empty($noticia)):
                $this->news[$id]['source_id'] = $id;
                $this->news[$id]['url'] = $url;

                $description = $link->find('p');
                $this->news[$id]['description'] = NULL;
                if(!empty($description[0])):
                    $this->news[$id]['description'] = $description[0]->plaintext;
                endif;

                $count ++;
            endif;

            if ($count >= $this->limit):
                break;
            endif;

        endforeach;

        dd($this->news);

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