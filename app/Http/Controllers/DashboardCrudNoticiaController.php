<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 02/11/15
 * Time: 02:04 PM
 */

namespace App\Http\Controllers;

use App\Noticia;


class DashboardCrudNoticiaController extends Controller
{
    public function index(){

        $noticias = Noticia::paginate(30);
        $noticias->setPath('/dashboard/noticia');

        $this->data['uri'] = 'hola';
        $this->data['noticias'] = $noticias;

        return view('dashboard.noticia_list',$this->data);


    }

}