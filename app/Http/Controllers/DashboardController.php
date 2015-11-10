<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 02/11/15
 * Time: 02:04 PM
 */

namespace App\Http\Controllers;

use App\Noticia;


class DashboardController extends Controller
{
    public function getIndex(){

        $this->data['uri'] = 'hola';

        return view('dashboard.home',$this->data);

    }

    public function getListNoticia(){

        $noticias = Noticia::paginate();
        $noticias->setPath('/dashboard/noticia');


        $this->data['uri'] = 'hola';
        $this->data['noticias'] = $noticias;

        return view('dashboard.noticia_list',$this->data);

    }

    public function getPreview(){

        $this->data['uri'] = 'hola';

        return view('dashboard.preview',$this->data);

    }
}