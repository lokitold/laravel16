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


class DashboardCrudNoticiaController extends Controller
{
    public function index(){

        $noticias = Noticia::paginate(30);
        $noticias->setPath('/dashboard/noticia');

        $this->data['uri'] = 'hola';
        $this->data['noticias'] = $noticias;

        return view('dashboard.noticia.index',$this->data);

    }

    public function store(PostFormNoticia $postForm)
    {
        $post = new \App\Post;
        $post->title = \Request::input('title');
        $post->body = \Request::input('body');
        $post->save();

        return redirect('dashboard/noticia/create')->with('message', 'Post saved');
    }

    public function create()
    {
        return view("dashboard.noticia.create");
    }

}