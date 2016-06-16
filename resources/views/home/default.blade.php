@extends('app')
@section('content')
<style>
    #map {
        width: 950px;
        height: 700px;
    }
</style>
<link rel="stylesheet" href="/laravel16/css/bootstrap-datetimepicker.css" />

<script type="text/javascript" src="/laravel16/js/moment.js"></script>
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
            <h2>Mapa de noticias XD</h2>
        </div>
    </div>
    <div class="row"></div>
    <div class="row">
        <div class="col-md-2">
            {!! Form::open(['route' => 'home','method' => 'GET']) !!}
            <div class="form-group">
                {!! Form::label('desde', 'Fecha Desde') !!}
                {!! Form::text('dateDesde', $dateDesde, ["class" => "form-control" ,'id'=> 'dateDesde']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('hasta', 'Fecha Hasta') !!}
                {!! Form::text('dateHasta', $dateHasta, ["class" => "form-control" ,'id'=> 'dateHasta']) !!}
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
<script type="text/javascript">
    $(function () {
        $('#dateDesde').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#dateHasta').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: new Date()
        });
    });
</script>
@endsection