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

        $this->data['uri'] = 'hola';

        //$data = file_get_html('http://elcomercio.pe');
        //echo $data;

        return view('home.home',$this->data);

    }
}