<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 02/11/15
 * Time: 02:04 PM
 */

namespace App\Http\Controllers;

use App\Noticia;
use App\Http\Requests\PostFormNoticia;
use Illuminate\Http\Request;


class DashboardCrudNoticiaController extends Controller
{
    public function index(Request $request){

        $noticias = Noticia::with('locations')
                    ->status($request->status)
                    ->orderBy('id', 'desc')
                    ->paginate(30);

        $noticias->appends(['status' => $request->status]);
        $noticias->setPath('/dashboard/noticia');

        $this->data['status'] = $request->status;
        $this->data['noticias'] = $noticias;

        return view('dashboard.noticia.index',$this->data);

    }

    private function store(PostFormNoticia $postForm)
    {
        $post = new \App\Post;
        $post->title = \Request::input('title');
        $post->body = \Request::input('body');
        $post->save();

        return redirect('dashboard/noticia/create')->with('message', 'Post saved');
    }

    public function update($id, PostFormNoticia $postForm)
    {
        $input = \Request::all();
        //dd($input);

        #delete locations notice
        if(!empty(\Request::input('delelete-locations'))):
            foreach(\Request::input('locations-delete') as $idLocation):
                $locationDelete = \App\Location::find($idLocation);
                $locationDelete->delete();
            endforeach;
            return redirect()->route('dashboard.noticia.edit', ['noticia' => $id])->with('message', 'Post updated');
        endif;

        #notice save
        $noticia = \App\Noticia::find($id);
        $noticia->longitud = \Request::input('longitud');
        $noticia->latitud = \Request::input('latitud');
        $noticia->status = \Request::input('status');

        #new locations notice
        $location = new  \App\Location();
        $location->longitud = \Request::input('longitud');
        $location->latitud = \Request::input('latitud');
        $noticia->locations()->save($location);

        # notice save
        $noticia->save();

        if(\Request::input('location')== 'home'):
            return redirect()->route('dashboard.noticia.index', null)->with('message', 'Post updated');    
        endif;

        return redirect()->route('dashboard.noticia.edit', ['noticia' => $id])->with('message', 'Post updated');
    }

    private function create()
    {
        return view("dashboard.noticia.create");
    }


    public function edit($id)
    {

        $noticia = \App\Noticia::find($id);
        $this->data['noticia'] = $noticia;

        # marcadores location notice
        $marcadores = array();
        foreach($noticia->locations as $location):
            $marcadores[]= array(
                'latitud' => $location->latitud,
                'longitud' => $location->longitud
            );
        endforeach;
        $this->data['marcadoresJson'] = json_encode($marcadores);

        return view('dashboard.noticia.createUpdate',$this->data);
    }

}