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
        $txt = 'La Segunda Fiscalía Provincial Penal Corporativa de Yarinacocha abrió investigación preliminar contra la administradora del centro comercial Real Plaza de Pucallpa, en Ucayali, tras la muerte de una niña por electrocución.

Los presuntos delitos son homicidio culposo y encubrimiento real. La denuncia también alcanza al propietario de la cabina fotográfica instantánea Enfókate, donde la menor recibió una fuerte descarga eléctrica luego de tocar una baranda conectada a la electricidad, según relataron testigos a las autoridades.

En un plazo de 60 días, el magistrado a cargo del caso, César Barrientos Grimaldo, tendrá que hallar las evidencias suficientes para determinar la culpabilidad.

En diálogo con El Comercio, el fiscal declaró que luego del fallecimiento de la niña se habría modificado la escena del accidente y que por eso se decidió investigar presunto encubrimiento real.

Entre las primeras diligencias realizadas, según precisó, se ha tomado las declaraciones de los padres de la pequeña. En los próximos días, los investigados también tendrán que rendir su manifestación. “También se ha solicitado la pericia de algunos ingenieros”, agregó. ';
        $lang = 'es';
        $response = $this->sendPost($api, $key, $lang, $txt);
        $json = json_decode($response, true);

        /*// Show the response
        echo "Response:\n";
        echo "==============\n";
        echo $response;
        echo "\n\n";

// Prints the specific fields in the response (entities)
        echo "Entities: \n";
        echo "=============\n";

        if(isset($json['entity_list']) && count($json['entity_list'])>0) {
            $type = '';
            foreach($json['entity_list'] as $entity) {
                echo '  - '.$entity['form'];
                if(isset($entity['sementity']['type']))
                    echo ' ('.$entity['sementity']['type'].')';
                echo "\n";
            }
        } else
            echo "Not found\n";

// Prints the specific fields in the response (concepts)
        echo "\n";
        echo "Concepts: \n";
        echo "=============\n";

        if(isset($json['concept_list']) && count($json['concept_list'])>0) {
            $type = '';
            foreach($json['concept_list'] as $concept) {
                echo '  - '.$concept['form'];
                if(isset($concept['sementity']['type']))
                    echo ' ('.$concept['sementity']['type'].')';
                echo "\n";
            }
        } else
            echo "Not found\n";

// Prints the specific fields in the response (time expressions)
        echo "\n";
        echo "Time expressions: \n";
        echo "===================\n";

        if(isset($json['time_expression_list']) && count($json['time_expression_list'])>0)
            foreach($json['time_expression_list'] as $timeExpression)
                echo '  - '.$timeExpression['form']."\n";
        else
            echo "Not found\n";

// Prints the specific fields in the response (money expressions)
        echo "\n";
        echo "Money expressions: \n";
        echo "====================\n";

        if(isset($json['money_expression_list']) && count($json['money_expression_list'])>0)
            foreach($json['money_expression_list'] as $moneyExpression)
                echo '  - '.$moneyExpression['form']."\n";
        else
            echo "Not found\n";

// Prints the specific fields in the response (quantity expressions)
        echo "\n";
        echo "Quantity expressions: \n";
        echo "======================\n";

        if(isset($json['quantity_expression_list']) && count($json['quantity_expression_list'])>0)
            foreach($json['quantity_expression_list'] as $quantityExpression)
                echo '  - '.$quantityExpression['form']."\n";
        else
            echo "Not found\n";

// Prints the specific fields in the response (other expressions)
        echo "\n";
        echo "Other expressions: \n";
        echo "====================\n";

        if(isset($json['other_expression_list']) && count($json['other_expression_list'])>0)
            foreach($json['other_expression_list'] as $otherExpression)
                echo '  - '.$otherExpression['form']."\n";
        else
            echo "Not found\n";

// Prints the specific fields in the response (quotes)
        echo "\n";
        echo "Quotations: \n";
        echo "================\n";

        if(isset($json['quotation_list']) && count($json['quotation_list'])>0)
            foreach($json['quotation_list'] as $quote) {
                echo '  - '.$quote['form']."\n";
                if(isset($quote['who']))
                    echo '    + who: '.$quote['who']['form'].(isset($quote['who']['lemma']) ? ' ('.$quote['who']['lemma'].')'."\n" : '');
                if(isset($quote['verb']))
                    echo '    + verb: '.$quote['verb']['form'].(isset($quote['verb']['lemma']) ? ' ('.$quote['verb']['lemma'].')'."\n" : '');
            }
        else
            echo "Not found\n";

// Prints the specific fields in the response (relations)
        echo "\n";
        echo "Relations: \n";
        echo "==============\n";

        if(isset($json['relation_list']) && count($json['relation_list'])>0)
            foreach($json['relation_list'] as $relation) {
                echo '  - '.$relation['form']."\n";
                if(isset($relation['subject'])) {
                    echo '   + subject: '.$relation['subject']['form'];
                    if(isset($relation['subject']['lemma_list'])){
                        $aux = implode('|', $relation['subject']['lemma_list']);
                        if(!empty($aux))
                            echo ' ('.$aux.')';
                    }
                    echo "\n";
                }
                if(isset($relation['verb'])) {
                    echo '   + verb: '.$relation['verb']['form'];
                    if(isset($relation['subject']['lemma_list'])){
                        $aux = implode('|', $relation['verb']['lemma_list']);
                        if(!empty($aux))
                            echo ' ('.$aux.')';
                    }
                    echo "\n";
                }
                if(isset($relation['complement_list'])) {
                    echo '   + complements: '."\n";
                    foreach($relation['complement_list'] as $complement)
                        echo '    * '.$complement['form'].' ('.$complement['type'].')'."\n";
                }
            }
        else
            echo "Not found\n";

        echo "\n";*/

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