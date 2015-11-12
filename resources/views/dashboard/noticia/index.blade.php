@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Noticias</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        {!! Form::open([ 'route' => 'dashboard.noticia.index','method' => 'GET','class' => 'navbar-form ']) !!}
        <div class="panel-body col-lg-3 col-md-offset-1">
            <div class="form-group">
                {!! Form::label('estado', 'Estado') !!}
                {!! Form::select('status', ['' => '', 0 => 'Sin Editar', 1 => 'Editado', 2 => 'Rechazado'], $status, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="panel-body col-lg-6">
        </div>
        <div class="panel-body col-lg-2">
            <div class="form-group">
                <button type="submit" class="btn btn-default">Buscar</button>
            </div>
        </div>
        {!! Form::close() !!}
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
                        <!--th>Eliminar</th-->
                    </tr>
                    @foreach ($noticias as $noticia)
                        <tr>
                            <td width="500">{{ $noticia->titulo }}</td>
                            <td width="300">{{ $noticia->fecha_publicacion }}</td>
                            <td width="80">{{ $noticia->status }}</td>
                            <td width="60" align="center">
                                {!! Html::link(route('dashboard.noticia.edit', $noticia->id), 'Edit', array('class' => 'btn btn-success btn-md')) !!}
                            </td>
                            <!--td width="60" align="center">
                                {!! Form::open(array('route' => array('dashboard.noticia.destroy', $noticia->id), 'method' => 'DELETE')) !!}
                                <button type="submit" class="btn btn-danger btn-md">Delete</button>
                                {!! Form::close() !!}
                            </td-->
                        </tr>
                    @endforeach
                </table>
                <?php echo $noticias->render(); ?>
            @endif
        </div>
    </div>
@endsection

