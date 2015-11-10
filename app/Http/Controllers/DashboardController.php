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

    public function getPreview(){

        $this->data['uri'] = 'hola';

        return view('dashboard.preview',$this->data);

    }
}