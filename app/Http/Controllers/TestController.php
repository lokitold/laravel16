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

class TestController extends Controller
{

    public function test(){
        $var = new Utils();
        echo $var->test();
        //test git reset soft
    }
}