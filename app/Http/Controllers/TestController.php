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
        $api = 'http://api.meaningcloud.com/topics-2.0';
        $key = 'ce455274fb5d1f85a2d6bca9df8758e9';
        $txt = 'El candidato presidencial de Todos por el Perú, Julio Guzmán, se pronunció sobre la tacha que presentó el ex juez Malzon Urbina contra la inscripción de su plancha.

“Estas elecciones están siendo las más sucias de los últimos 20 años […] Nos han agarrado de piñata”, indicó desde el distrito puneño de Desaguadero, en la frontera con Bolivia.

En el documento que presentó al Jurado Electoral Especial (JEE) Lima Centro 1, Malzon Urbina consideró que las observaciones hechas al partido de Julio Guzmán son insubsanables, por lo que debería quedar fuera de carrera.

“[El JEE] le ha perdonado la caída al partido Todos Por el Perú por la presión mediática por un lado [...] Los peruanos, comenzando por sus autoridades, continuamos navegando en contra corriente de la ley”, arguye Malzon Urbina en su escrito.

De otro lado, Julio Guzmán criticó a los candidatos presidenciales que ya gobernaron al país, es decir, Alejandro Toledo y Alan García. “Lo único que saben hacer es vivir de la política”, enfatizó.

Finalmente, el líder de Todos por el Perú aseguró que toma con tranquilidad la nueva encuesta de CPI, que lo ubica en el segundo lugar de las preferencias con 18.3%. "No vamos a confiarnos de lo que tenemos", refirió.';
        $lang = 'es';
        $response = $this->sendPost($api, $key, $lang, $txt);
        $json = json_decode($response, true);

        dd($json);
    }

    private function sendPost($api, $key, $lang, $txt) {
        $data = http_build_query(array('key'=>$key,
            'lang'=>$lang,
            'tt'=>'a',
            'txt'=>$txt,
            'src'=>'sdk-php-2.0')); // management internal parameter
        $context = stream_context_create(array('http'=>array(
            'method'=>'POST',
            'header'=>
                'Content-type: application/x-www-form-urlencoded'."\r\n".
                'Content-Length: '.strlen($data)."\r\n",
            'content'=>$data)));

        $fd = fopen($api, 'r', false, $context);
        $response = stream_get_contents($fd);
        fclose($fd);
        return $response;
    }
}