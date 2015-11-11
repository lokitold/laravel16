@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Editar Noticia </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{!! $noticia->url !!}}">Acceder a Noticia</a></div>

                @if($errors->has())
                    <div class='alert alert-danger'>
                        @foreach ($errors->all('<p>:message</p>') as $message)
                            {!! $message !!}
                        @endforeach
                    </div>
                @endif

                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif

                <div class="panel-body">
                    {!! Form::model($noticia,['route' => 'dashboard.noticia.update','method' => 'PUT']) !!}

                    <div class="form-group">
                        {!! Form::text('titulo', null, ["class" => "form-control" , 'disabled' => 'disabled']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::textarea('descripcion', null,
                                ['class'=>'form-control', 'placeholder'=>'Body', 'disabled' => 'disabled'])
                        !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('fecha_publicacion', null, ["class" => "form-control" , 'disabled' => 'disabled']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('url', null, ["class" => "form-control" , 'disabled' => 'disabled']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('estado', 'Estado') !!}
                        {!! Form::select('status', ['' => '', 0 => 'Sin Editar', 1 => 'Editado', 2 => 'Rechazado'], null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group pull-right">
                        <p class="text-left"><a href="{!! $noticia->url !!}}" target="_blank">Acceder a Noticia</a></p>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Send', ["class" => "btn btn-success "]) !!}
                    </div>



                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

