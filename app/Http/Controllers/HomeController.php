<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 02/11/15
 * Time: 02:04 PM
 */

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function getIndex(){

        $noticias = \App\Noticia::where('status',1)->get();

        $marcadores = array();

        foreach($noticias as $noticia):
            if(!empty($noticia->longitud) and !empty($noticia->latitud)):

                $content = "<div>
                                <div>
                                    <h4><a href='$noticia->url' target='_blank'>$noticia->titulo</a></h4>
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

        return view('home.default',$this->data);

    }
}