<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 02/11/15
 * Time: 02:04 PM
 */

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;

class TestController extends Controller
{

    # geocodign test
    # Api => http://maps.googleapis.com/maps/api/geocode/output?parameters
    # Clave del api  = AIzaSyDI1G5t3_HL8rXgGiK8HrpLu5yRWyTqPSo
    # Administrador de api de google => https://console.developers.google.com

    public function test(){
        echo "aca";
    }

    public function jade(){
        $this->data['uri'] = 'holas';
        return view('test.test',$this->data);
    }
}