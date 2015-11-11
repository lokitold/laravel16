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
                        {!! Form::submit('Send', ["class" => "btn btn-success "]) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

