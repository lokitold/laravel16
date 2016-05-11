<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 02/11/15
 * Time: 02:04 PM
 */

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Libraries\Jadeview as Jade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;

class TestController extends Controller
{

    # geocodign test
    # Api => http://maps.googleapis.com/maps/api/geocode/output?parameters
    # Clave del api  = AIzaSyDI1G5t3_HL8rXgGiK8HrpLu5yRWyTqPSo
    # Administrador de api de google => https://console.developers.google.com
    # example =
    #   https://maps.googleapis.com/maps/api/geocode/json?address=Ayacucho&key=AIzaSyDI1G5t3_HL8rXgGiK8HrpLu5yRWyTqPSo

    public function test()
    {
        echo "aca";
    }

    public function jade()
    {
        $this->data['saludos'] = 'hola mundommfd';
        $this->data['title'] = 'Jade is awesome!';
        $this->data['content'] = 'Oh yeah, it is.';
        $this->data['youAreUsingJade'] = TRUE;
        $this->data['list'] = ["Uno", "Dos", "Tres","Cuatro", "Cinco", "Seis"];

        $tiempo_inicio = microtime(true);

        $view = view('test.test', $this->data);


        $tiempo_fin = microtime(true);

        $tiempo = $tiempo_fin - $tiempo_inicio;

        echo "<br><br>Tiempo empleado: " . ($tiempo_fin - $tiempo_inicio);

        return $view;
    }

    public function jadeEngine()
    {
        $data = [
            "hello" => "You are welcome.",
            "welcome"=>true,
            "list"=>["item1,item2,item3"],
            "escapetxt"=>"<b>bold tags</b>",
            "title" => "Jade is awesome!",
            "youAreUsingJade" => TRUE,
        ];


        $tiempo_inicio = microtime(true);

        echo Jade::render("test/test2",$data);

        $tiempo_fin = microtime(true);

        $tiempo = $tiempo_fin - $tiempo_inicio;

        echo "<br><br>Tiempo empleado: " . ($tiempo_fin - $tiempo_inicio);
    }

    public function createFlash(){
        \Session::flash('flash-message','dgfdg'); //<--FLASH MESSAGE
        return redirect('receiver-flash');
    }

    public function receiverFlash(Request $request){

        $data = $request->session()->all();
        //debug_zval_dump($data);


        $request->session()->has('flash-message');
        if($request->session()->has('flash-message')):
            echo $request->session()->get('flash-message');
            //$request->session()->forget('flash-message');
        endif;

        //
    }

    public function queue(Request $request){
        $message = 'This is a test message that will be queued';
        //$job = (new \App\Jobs\SendSMSMessages($message))->delay(60);
        //$this->dispatch($job);

        Queue::push(new \App\Jobs\SendSMSMessages($message));
    }

}