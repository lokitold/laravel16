@extends('app')
@section('content')
<style>
    #map {
        width: 950px;
        height: 700px;
    }
</style>
<script src="/sbadmin2/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
    var misPuntos = <?php echo $marcadoresJson ?>;
</script>
<script src="/laravel16/js/home.js"></script>
<div class="container">
    <div class="row">
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
    </div>
    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <h2>Mapa de noticias</h2>
        </div>
    </div>
    <div class="row"></div>
    <div class="row">
        <div class="col-md-2">
            {!! Form::open(['route' => 'home','method' => 'GET']) !!}
            <div class="form-group">
                {!! Form::label('desde', 'Fecha Desde') !!}
                {!! Form::text('dateDesde', $dateDesde, ["class" => "form-control" ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('hasta', 'Fecha Hasta') !!}
                {!! Form::text('dateHasta', $dateHasta, ["class" => "form-control" ]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Send', ["class" => "btn btn-success "]) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-10">
            <div id="map"></div>
        </div>
    </div>
</div>
@endsection