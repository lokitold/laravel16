<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 02/11/15
 * Time: 02:04 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests\GetFormHome;
use UWDOEM\CSRF\CSRF;
use Lokitold\Helper\Utils;

class HomeController extends Controller
{
    public function getIndex(GetFormHome $getForm){

        $dateDesde = \Request::input('dateDesde');
        $dateHasta = \Request::input('dateHasta');

        $carbon = new \Carbon\Carbon();

        if(empty($dateDesde)):
            $desdeDate = $carbon::now();
            $desdeDate = $desdeDate->subDay(1);
            $dateDesde = $desdeDate->format('Y-m-d H:i:s');
        endif;

        if(empty($dateHasta)):
            $date = $carbon::now();
            $dateHasta = $date->format('Y-m-d H:i:s');
        endif;

        $noticias = \App\Noticia::dateBetween($dateDesde,$dateHasta)->where('status',1)->get();


        $marcadores = array();

        foreach($noticias as $noticia):
            if(!empty($noticia->longitud) and !empty($noticia->latitud)):

                $imagenes = json_decode($noticia->imagen);
                $imagenContent = '';

                foreach($imagenes as $imagen ):
                    $imagenContent .= "<img src='$imagen'>";
                endforeach;


                $content = "<div>
                                <div>
                                    <h4><a href='$noticia->url' target='_blank'>$noticia->titulo</a></h4>
                                    <h5>$noticia->fecha_publicacion</h5>
                                </div>
                                <div>
                                    $imagenContent;
                                </div>
                                <div >
                                    $noticia->descripcion
                                </div>
                            </div>";

                $marcadores[]= array(
                    'latitud' => $noticia->latitud,
                    'longitud' => $noticia->longitud,
                    'content' => $content
                );
            endif;
        endforeach;

        $this->data['marcadoresJson'] = json_encode($marcadores);
        $this->data['dateDesde'] = $dateDesde;
        $this->data['dateHasta'] = $dateHasta;

        return view('home.default',$this->data);

    }

    public function test(){
        $var = new Utils();
        echo $var->test();
    }
}