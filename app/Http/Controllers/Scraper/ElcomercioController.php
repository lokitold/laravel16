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


        //test
        //

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

                $description = $link->find('p',0);
                $this->news[$id]['description'] = NULL;
                if(!empty($description)):
                    $this->news[$id]['description'] = $description->plaintext;
                endif;

                $titulo = $link->find('header h2',0);
                $this->news[$id]['titulo'] = NULL;
                if(!empty($titulo)):
                    $this->news[$id]['titulo'] = $titulo->plaintext;
                endif;

                $imagen = $link->find('figure a img');
                $this->news[$id]['imagen'] = json_encode(array());
                if(!empty($imagen)):
                    foreach($imagen as $img):
                       $ima[] = $img->getAttribute('data-src');
                    endforeach;
                    $this->news[$id]['imagen'] = json_encode($ima);
                    unset($ima);
                endif;

                $dateraw = $link->find('header ul li[class=f-fecha]',0)->plaintext;
                if(!empty($dateraw)):
                    $dateraw = str_replace("hace", "",strtolower($dateraw));
                    if (strpos($dateraw, 'segundo') or strpos($dateraw, 'segundos')) :
                        $dateraw = str_replace(array('segundos','segundo'), "",strtolower($dateraw));
                        $dateMenosSegundos = (int)trim($dateraw);
                    elseif(strpos($dateraw, 'minuto') or strpos($dateraw, 'minutos')):
                        $dateraw = str_replace(array('minutos','minuto'), "",strtolower($dateraw));
                        $dateMenosSegundos = (int)trim($dateraw) * 60;
                    elseif(strpos($dateraw, 'hora') or strpos($dateraw, 'horas')):
                        $dateraw = str_replace(array('horas','hora'), "",strtolower($dateraw));
                        $dateMenosSegundos = (int)trim($dateraw) * 60 * 60;
                    else:
                        $dateMenosSegundos = 0;
                    endif;
                else:
                    $dateMenosSegundos = 0;
                endif;
                $carbon = new \Carbon\Carbon();
                $date = $carbon::now();
                $endDate = $date->subSecond($dateMenosSegundos);
                $this->news[$id]['fecha_publicacion'] = $endDate->format('Y-m-d H:i:s');

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