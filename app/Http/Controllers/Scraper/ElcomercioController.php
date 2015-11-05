<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 02/11/15
 * Time: 02:04 PM
 */

namespace App\Http\Controllers\Scraper;

use App\Http\Controllers\Controller;


class ElcomercioController extends Controller
{
    const LIST_ITEM = 'section[id=ec-ultimas] article header h2 a';

    public function getIndex(){

        $data = file_get_html('http://elcomercio.pe');
        $sectionUltimasNoticias = $data->find(self::LIST_ITEM);


        foreach($sectionUltimasNoticias as $link ):
            echo '<br>'.$url = $link->getAttribute('href');

        endforeach;

    }
}