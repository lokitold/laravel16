@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Noticias</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @if(!$noticias->isEmpty())
                <table class="table table-bordered">
                    <tr>
                        <th>Título</th>
                        <th>Fecha Publicacion</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    @foreach ($noticias as $noticia)
                        <tr>
                            <td width="500">{{ $noticia->titulo }}</td>
                            <td width="300">{{ $noticia->fecha_publicacion }}</td>
                            <td width="80">{{ $noticia->status }}</td>
                            <td width="60" align="center">
                                {!! Html::link(route('dashboard.noticia.edit', $noticia->id), 'Edit', array('class' => 'btn btn-success btn-md')) !!}
                            </td>
                            <td width="60" align="center">
                                {!! Form::open(array('route' => array('dashboard.noticia.destroy', $noticia->id), 'method' => 'DELETE')) !!}
                                <button type="submit" class="btn btn-danger btn-md">Delete</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <?php echo $noticias->render(); ?>
            @endif
        </div>
    </div>
@endsection

