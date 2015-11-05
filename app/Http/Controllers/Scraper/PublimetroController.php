<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 02/11/15
 * Time: 02:04 PM
 */

namespace App\Http\Controllers\Scraper;

use App\Http\Controllers\Controller;


class PublimetroController extends Controller
{
    public function getIndex(){

        $data = file_get_html('http://publimetro.pe');

        echo $data;

    }
}